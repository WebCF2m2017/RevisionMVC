<?php

/*
 * Contrôleur secondaire
 */

require_once 'm/Tableau.class.php';
require_once 'm/TableauManager.class.php';
require_once 'm/Pagination.class.php';


$manageTableau = new TableauManager($connect);


if (isset($_GET['idtab']) && ctype_digit($_GET['idtab'])) {
    $recupOne = $manageTableau->selectUn($_GET['idtab']);

    if ($recupOne) {
            $obj = new Tableau($recupOne);
        

    } else {
        echo "soucis !";
    }
    
    require_once 'v/tableauSeul.php';
    
} else {
    
    if(isset($_GET[VAR_GET])&& ctype_digit($_GET[VAR_GET])){
        $pageActu = $_GET[VAR_GET];
    }else{
        $pageActu = 1;
    }
    
    $nb_tot = $manageTableau->nombreTotalTableau();

    $recupTous = $manageTableau->selectAll(NB_PG,$pageActu);
    //var_dump($recupTous);
    

    if ($recupTous) {
        foreach ($recupTous as $key => $value) {
            $obj[] = new Tableau($value);
        }
        //var_dump($obj);
    } else {
        echo "soucis !";
    }

    require_once 'v/tableauTous.php';
}