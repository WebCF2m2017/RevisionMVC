<?php

// on est connecté en tant qu'admin
// dépendances pour le CRUD des tableaux
require_once 'm/Tableau.class.php';
require_once 'm/TableauManager.class.php';
require_once 'm/Artiste.class.php';
require_once 'm/ArtisteManager.class.php';
require_once 'm/Pagination.class.php';

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
    
    
// si on veut updater un tableau    
}elseif(isset($_GET['updatetab'])&& ctype_digit($_GET['updatetab'])){
    // si on a envoyé le formulaire
    if(!empty($_POST)){
        // si on a pas chipoté l'id
        if($_POST['id']==$_SESSION['pourUpdateTab']){
            // création d'un objet de type tableau
            $tabobj = new Tableau($_POST);
            // mise à jour du tableau
            $modifie = $manageTableau->updateTab($tabobj);
            // si la modification est bonne
            if($modifie){
                header("Location: ./");
            }else{
                echo "<h3 onclick='history.go(-1)'>Erreur lors de la modification, vérifiez tous les champs!<br/><button>Complétez le formulaire</button></h3>";
            }
        }
    
    // sinon affiche le formulaire    
    }else{
        // création d'une variable pour ne pas pouvoir modifier un autre tableau que celui affiché, le plus sécurisé étant invisible pour l'utilisateur: la session
        $_SESSION['pourUpdateTab'] = $_GET['updatetab'];
        // on récupère les artistes pour le formulaire
        $artistes = $manageArtiste->listeArtiste();
        // on récupère les champs du tableau
        $tableau = $manageTableau->selectUn($_GET['updatetab']);
        if(!$tableau){
            echo "<h3 onclick='history.go(-1)'>Ce tableau n'existe plus<br/><button>Retour en arrière</button></h3>";
        }else{
        // on transforme la réponse en objet tableau
        $tab = new Tableau($tableau);
        // Appel de la vue
        echo $twig->render("update.html.twig",array("listeArtistes"=>$artistes, "tab"=>$tab));
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
    
    if(isset($_GET[VAR_GET])&& ctype_digit($_GET[VAR_GET])){
        $pageActu = $_GET[VAR_GET];
    }else{
        $pageActu = 1;
    }
    
    $nb_tot = $manageTableau->nombreTotalTableau();

    $recupTous = $manageTableau->selectAll(NB_PG,$pageActu);
    
    // $recupTous = $manageTableau->selectAll();
    $pagination = Pagination::affiche($nb_tot,$pageActu,"pg",NB_PG);

    if ($recupTous) {
        foreach ($recupTous as $key => $value) {
            $obj[] = new Tableau($value);
        }
        // Appel de la vue
    echo $twig->render("base.html.twig",array('affiche' => $obj,"pagi"=>$pagination));
    } else {
        echo "soucis !";
    }
}


    

