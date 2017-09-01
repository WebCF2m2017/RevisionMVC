<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Les tableaux</title>
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
        /*// affichage constante
        echo Pagination::TITRE."<br/>";
        // affichage méthode statique publique
        $a = Pagination::affiche(2,1,VAR_GET,NB_PG); // affiche page 4
        echo $a;
        echo "<hr/>---<hr/>";
        $b = Pagination::affiche(100,$pageActu); // simulation grand nombre de page
        echo $b;
        echo "<hr/>---<hr/>";*/
        $c = Pagination::affiche($nb_tot,$pageActu,"pg",NB_PG);
        echo $c;
        /*
        echo "<hr/>---<hr/>";
        echo $nb_tot;
         * 
         */
        ?>
    </body>
</html>
