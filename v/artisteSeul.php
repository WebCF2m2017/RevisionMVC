<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>L'artiste</title>
        <?php
        require_once 'v/bootstrap.php';
        ?>
    </head>
    <body>
        <?php
        if(isset($erreur)){
            echo "<h2>$erreur</h2>";
        }else{
            //var_dump($art);
            ?>
        <h1>L'artiste <?=$art->getLeprenom()?> <?=$art->getLenom()?></h1>
        <div><?php require_once 'v/formAccueil.php'; ?></div>
        <h2>Né en <?=$art->getNaissance()?></h2>
        <?php
            //var_dump($art->getTitre());
        if(!empty($art->getTitre()[0])){
            foreach($art->getTitre() AS $c=>$v){
            ?>
        <a href="?idtab=<?=$art->getId()[$c]?>"><img width="20" height="20" src='<?=$art->getImage()[$c]?>' alt='' /><?=$v?></a><hr/>
        <?php
            }
        }else{
        ?>
        <h3>Pas encore de tableaux</h3>
        <?php
        }
        }
        ?>
        <h4><a href="./">Retour à l'accueil</a></h4>
    </body>
</html>
