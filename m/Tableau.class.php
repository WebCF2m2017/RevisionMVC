<?php

/**
 * Description of Tableau
 *
 * @author webform
 */
class Tableau {
    // Attributs de mapping de la table
    private $id;
    private $titre;
    private $image;
    private $creation;
    private $artiste_idArtiste;
    // attributs liés à la jointure
    private $lenom;
    private $leprenom;
    // Constantes
    // méthodes
    public function __construct(Array $datas) {
        $this->hydrate($datas);
    }
    
    // hydratation
    private function hydrate(Array $a) {
        foreach ($a AS $clef => $valeur){
            $maMethode = "set".ucfirst($clef);
            if(method_exists($this, $maMethode)){
                $this->$maMethode($valeur);
            }
        }
    }
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getArtiste_idArtiste() {
        return $this->artiste_idArtiste;
    }

    public function getLenom() {
        return $this->lenom;
    }

    public function getLeprenom() {
        return $this->leprenom;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setImage($image) {
        // extensions permises
        $permission = [".jpg","jpeg",".gif",".png"];
        // on la récupère de l'url envoyée et on la met en minuscule
        $der4 = strtolower(substr($image,-4));
        // si c'est une extension permise
        if(in_array($der4, $permission)){
            $this->image = $image;
        }else{
            $this->image = "https://domainedesforges.net/wp-content/themes/domainedesforges/img/facebook-forges.png";
        }
    }

    public function setCreation($creation) {
        $this->creation = $creation;
    }

    public function setArtiste_idArtiste($artiste_idArtiste) {
        $this->artiste_idArtiste = $artiste_idArtiste;
    }

    public function setLenom($lenom) {
        $this->lenom = $lenom;
    }

    public function setLeprenom($leprenom) {
        $this->leprenom = $leprenom;
    }


}
