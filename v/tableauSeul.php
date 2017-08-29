<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Le tableau</title>
        <?php
        require_once 'v/bootstrap.php';
        ?>
    </head>
    <body>
        <h1>Le tableau</h1>
        <div><?php require_once 'v/formAccueil.php'; ?></div>
        <?php

            ?>
        <h2><a href="?idtab=<?=$obj->getId()?>"><?=$obj->getTitre()?></a></h2>
        <img src="<?=$obj->getImage()?>" width="150" height="150" alt=""/>
        <h3>Par <a href="?idartiste=<?=$obj->getArtiste_idArtiste()?>"><?=$obj->getLenom()?> <?=$obj->getLeprenom()?></a></h3>
        <p>En <?=date("Y",strtotime($obj->getCreation()))?></p>
        <h4><a href="./">Retour à l'accueil</a></h4>
        
    </body>
</html>
