<?php

/**
 * Description of TableauManager.class
 *
 * @author webform
 */
class TableauManager {
    // Attributs
    private $db;
    // Constantes
    // méthodes
    public function __construct(myPDO $connection) {
        $this->db = $connection;
    }

    public function selectAll(){
        $sql = "SELECT t.*, a.lenom, a.leprenom 
                FROM tableau t
                    INNER JOIN artiste a 
                    ON a.idArtiste = t.artiste_idArtiste
                ORDER BY t.creation DESC";
        $req = $this->db->query($sql);

        if($req->rowCount()){
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public function selectUn($id){
        $id = (int)$id;
        $sql = "SELECT t.*, a.lenom, a.leprenom 
                FROM tableau t
                    INNER JOIN artiste a 
                    ON a.idArtiste = t.artiste_idArtiste
                    WHERE t.id = ?
                ORDER BY t.creation DESC";
        $req = $this->db->prepare($sql);
        $req->bindValue(1,$id,PDO::PARAM_INT);
        $req->execute();

        if($req->rowCount()){
            return $req->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }  
    }
    public function insertTab(Tableau $a){
        $sql = "INSERT INTO tableau (titre,image,creation,artiste_idArtiste) VALUE (?,?,?,?)";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1, $a->getTitre(), PDO::PARAM_STR);
        $prepare->bindValue(2, $a->getImage(), PDO::PARAM_STR);
        $prepare->bindValue(3, $a->getCreation(), PDO::PARAM_STR);
        $prepare->bindValue(4, $a->getArtiste_idArtiste(), PDO::PARAM_INT);
        $prepare->execute();
        if($prepare->rowCount()){
            return true;
        }else{
            return false;
        }
    }
}
