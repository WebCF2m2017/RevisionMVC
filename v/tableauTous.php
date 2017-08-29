<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Les tableaux</title>
        <?php
        require_once 'v/bootstrap.php';
        ?>
    </head>
    <body>
        <h1>Les tableaux</h1>
        <div><?php require_once 'v/formAccueil.php'; ?></div>
        <?php
        foreach($obj as $valeur){
            ?>
        <h2><a href="?idtab=<?=$valeur->getId()?>"><?=$valeur->getTitre()?></a></h2>
        <h3>Par <a href="?idartiste=<?=$valeur->getArtiste_idArtiste()?>"><?=$valeur->getLenom()?> <?=$valeur->getLeprenom()?></a></h3>
        <p>En <?=date("Y",strtotime($valeur->getCreation()))?></p>
        <hr/>
        <?php
        }
        ?>
    </body>
</html>
