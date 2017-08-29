<?php

/*
 * Contrôleur frontal
 */

// ouverture de la session
session_start();

// dépendances
require_once 'config.php';
require_once 'm/myPDO.php';
// dépendances composer
require_once 'vendor/autoload.php';

// connexion
$connect = new myPDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD);


// routage de base

// on veut se connecter
if(isset($_POST["login"])&&isset($_POST["pwd"])){
    require_once 'c/formAccueilController.php';
// si on est connecté
}elseif(isset($_SESSION['laclef'])&& $_SESSION['laclef']==session_id()){
    // on va sur le contrôleur de l'admin
    require_once 'c/adminController.php';
// on veut afficher un artiste grâce à son id
}elseif(isset($_GET['idartiste'])&& ctype_digit($_GET['idartiste'])){
    require_once 'c/artisteController.php';
}else{
    require_once 'c/tableauController.php';
}