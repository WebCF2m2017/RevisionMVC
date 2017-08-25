<?php

/**
 * Description of ArtisteManager.class
 *
 * @author webform
 */
class ArtisteManager {
    // Attributs
    private $db;
    // Constantes
    // méthodes
    public function __construct(myPDO $c) {
        $this->db = $c;
    }
    
    // on affiche l'artiste et on prend tous les tableaux de celui-ci
    public function afficheArtiste($ida) {
        $sql = "SELECT a.*, GROUP_CONCAT(t.id) AS id, GROUP_CONCAT(t.titre SEPARATOR '@||@') AS titre, 
GROUP_CONCAT(t.image SEPARATOR '|@@|') AS image   
                    FROM artiste a
                        LEFT JOIN tableau t
                        ON a.idArtiste = t.artiste_idArtiste
                    WHERE a.idArtiste = ?
                    GROUP BY a.idArtiste;
            ";
        $req = $this->db->prepare($sql);
        $req->bindValue(1, $ida, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}
