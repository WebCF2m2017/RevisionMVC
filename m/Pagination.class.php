<?php

/**
 * Description of Pagination.class
 *
 * @author webform
 */
class Pagination {
// Attributs
    static private $nbTotElement;
    static private $pgActu;
    static private $varGet;
    static private $nbParPg;
    static private $nbPg;

// Constantes
    const TITRE="Pagination";
// méthodes
    
    // une méthode static peut être appelée sans instanciation de la classe Pagination::Affiche(5)
    public static function affiche($nbtot=50,$pgactu=1,$get="pg",$nbpg=5){
        // on remplit les attributs
        self::$nbTotElement = $nbtot;
        self::$pgActu = $pgactu;
        self::$varGet = $get;
        self::$nbParPg = $nbpg;
        // on récupère le nombre de pages à afficher
        self::$nbPg = self::nombreDePage(self::$nbTotElement, self::$nbParPg);
        // on a moins qu'une page
        if (self::$nbPg < 2) {
            // on affiche page 1 en arrêtant la méthode
            return "<div>page 1</div>";
        }
        return self::remplissage();
    }
    
    private static function nombreDePage($nombre_elements_total,$nb_elements_par_pg){
        $nb_pg = ceil($nombre_elements_total / $nb_elements_par_pg);
        return $nb_pg;
    }
    private static function remplissage() {
         // ouverture de la variable de sortie (string)
    $sortie = "<div>";
    // tant qu'on a des pages 
    for ($i = 1; $i <= self::$nbPg; $i++) {
        // si on est au premier tour de boucle 
        if ($i == 1) {
            // si c'est la page actuelle
            if (self::$pgActu == $i) {
                $sortie .= "|<< ";
                $sortie .= "<<&nbsp;&nbsp; ";
                $sortie .= "$i ";
            // retour en arrière pour page 2      
            } elseif(self::$pgActu == 2) {
                $sortie .= "<a href='./' title='First'>|<<</a> ";
                $sortie .= "<a href='./'><<</a>&nbsp;&nbsp; ";
                // pas de variable GET de pagination sur l'accueil
                $sortie .= "<a href='./'>$i</a> ";
            // on est sur une autre page  
            }else {
                $sortie .= "<a href='./' title='First'>|<<</a> ";
                $sortie .= "<a href='?".self::$varGet."=" . (self::$pgActu - 1) . "'><<</a>&nbsp;&nbsp; ";
                // pas de variable GET de pagination sur l'accueil
                $sortie .= "<a href='./'>$i</a> ";
            }
            // sinon si on est au dernier tour    
        } elseif ($i == self::$nbPg) {
            // si c'est la page actuelle
            if (self::$pgActu == $i) {
                $sortie .= "$i ";
                $sortie .= "&nbsp;&nbsp; >> ";
                $sortie .= " >>|";
                // on est sur une autre page    
            } else {
                $sortie .= "<a href='?".self::$varGet."=$i'>$i</a> ";
                $sortie .= "&nbsp;&nbsp;<a href='?".self::$varGet."=" . (self::$pgActu + 1) . "'>>></a> ";
                $sortie .= " <a href='?".self::$varGet."=".self::$nbPg."' title='Final'>>>|</a>";
            }
            // sinon (tous les autres tours)    
        } else {
            if (self::$pgActu == $i) {
                $sortie .= " $i ";
            } else {
                // affichage de la variable GET et de sa valeur en lien
                $sortie .= "<a href='?".self::$varGet."=$i'>$i</a> ";
            }
        }
    }
    $sortie .= "</div>";
    return $sortie;
    }

}
