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

    public function selectAll($parPage=NULL,$page_actu=1){
        if(is_null($parPage)){
            $strLimit="";
        }else{
            $debutLimit = ($page_actu-1)*$parPage;
            $strLimit="LIMIT $debutLimit,$parPage";
        }
        $sql = "SELECT t.*, a.lenom, a.leprenom 
                FROM tableau t
                    INNER JOIN artiste a 
                    ON a.idArtiste = t.artiste_idArtiste
                ORDER BY t.creation DESC $strLimit";
        $req = $this->db->query($sql);

        if($req->rowCount()){
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    // pour compter le nombre total de tableaux
    public function nombreTotalTableau(){
        $req = $this->db->query("SELECT COUNT(*) AS nb FROM tableau");
        $sortie = $req->fetch(PDO::FETCH_OBJ);
        return $sortie->nb;
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
    // pour insertion
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
    // pour suppression
    public function deletetab($id) {
        $sql = "DELETE FROM tableau WHERE id = ?";
        $prepare=$this->db->prepare($sql);
        $prepare->bindValue(1, $id, PDO::PARAM_INT);
        $prepare->execute();
        if($prepare->rowCount()){
            return true;
        }else{
            return false;
        }
    }
    // pour update
    public function updateTab(Tableau $tab) {
        // requête
        $sql="UPDATE tableau SET titre=?, image=?, creation=?, artiste_idArtiste=? WHERE id=?";
        $req = $this->db->prepare($sql);
        $req->bindValue(1, $tab->getTitre(),PDO::PARAM_STR);
        $req->bindValue(2, $tab->getImage(),PDO::PARAM_STR);
        $req->bindValue(3, $tab->getCreation(),PDO::PARAM_STR);
        $req->bindValue(4, $tab->getArtiste_idArtiste(),PDO::PARAM_INT);
        $req->bindValue(5, $tab->getId(),PDO::PARAM_INT);
        $req->execute();
        // si modification ok
        if($req->rowCount()){
            return true;
        }else{
            return false;
        }
    }
}
