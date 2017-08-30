<?php

// on est connecté en tant qu'admin
// dépendances pour le CRUD des tableaux
require_once 'm/Tableau.class.php';
require_once 'm/TableauManager.class.php';
require_once 'm/Artiste.class.php';
require_once 'm/ArtisteManager.class.php';

$manageArtiste = new ArtisteManager($connect);
$manageTableau = new TableauManager($connect);

// appel des dépendances twig
$loader = new Twig_Loader_Filesystem('v/twig'); // chemin vers nos templates
$twig = new Twig_Environment($loader, array(
    'debug' => true)); // charhement d'un environement de template
$twig->addExtension(new Twig_Extension_Debug());
// on veut se déconnecter
if (isset($_GET['deco'])) {
    // destruction complète de session
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
    }
    session_destroy();   
    // redirection
    header("Location: ./");
}elseif(isset($_GET['insert'])){
    if(empty($_POST)){
    // on récupère les artistes pour le formulaire
    $artistes = $manageArtiste->listeArtiste();
    // Appel de la vue
    echo $twig->render("insert.html.twig",array("listeArtistes"=>$artistes));
    }else{
        $tableau = new Tableau($_POST);
        // var_dump ($tableau);
        // insertion dans la db
        $insert = $manageTableau->insertTab($tableau);
        // si l'insertion est réussie
        if($insert){
            // redirection vers l'accueil
            header("Location: ./");
        }else{
            // erreur et lien de redirection
            echo "<h3 onclick='history.go(-1)'>Erreur lors de l'insertion, vérifiez tous les champs!<br/><button>Complétez le formulaire</button></h3>";
        }
    }
    // si on veut supprimer
}elseif(isset($_GET['del'])&& ctype_digit($_GET['del'])){
    $delete = $manageTableau->deletetab($_GET['del']);
    if($delete){
        // redirection vers l'accueil
        header("Location: ./");
    }else{
        echo "not succesfull";
    }
}else{
    $recupTous = $manageTableau->selectAll();

    if ($recupTous) {
        foreach ($recupTous as $key => $value) {
            $obj[] = new Tableau($value);
        }
        // Appel de la vue
    echo $twig->render("base.html.twig",array('affiche' => $obj));
    } else {
        echo "soucis !";
    }
}


    

