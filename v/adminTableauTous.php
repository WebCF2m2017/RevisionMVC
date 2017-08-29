<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin : Les tableaux</title>
        <?php
        require_once 'v/bootstrap.php';
        ?>
    </head>
    <body>
        <h1>Admin : Les tableaux</h1>
        <h2>Bienvenue <?=$_SESSION['nom']?></h2>
        <div><a href="?insert=tab">Ajouter un tableau</a><?php require_once 'v/formDeco.php'; ?></div>
        <?php
        foreach($obj as $valeur){
            ?>
        <h2><a href="?idtab=<?=$valeur->getId()?>"><?=$valeur->getTitre()?></a></h2>
        <div><img src="v/img/icon_edit.png" alt=""/> <img src="v/img/delete_doc.jpg" alt=""/></div>
        <h3>Par <a href="?idartiste=<?=$valeur->getArtiste_idArtiste()?>"><?=$valeur->getLenom()?> <?=$valeur->getLeprenom()?></a></h3>
        <p>En <?=date("Y",strtotime($valeur->getCreation()))?></p>
        <hr/>
        <?php
        }
        ?>
    </body>
</html>
