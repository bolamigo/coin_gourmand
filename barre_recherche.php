<?php
    include 'sql.php';
    @$keywords=$_GET["keywords"]; //récupérer le mots clés
    @$valider=$_GET["valider"]; //rechercher
    $afficher=""; 
    if (isset($valider) && !empty(trim($keywords))){
            $res=$conn->prepare("SELECT title FROM recipe WHERE title LIKE '%$keywords%'");
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $res->execute();
            $tab=$res->fetchAll();
            $afficher="exists";
    }
?>

<!DOCTYPE html>
<html>
    <body>
        <form name="search_bar" method="get" action="">
            <input type="text" name="keywords" placeholder="exemple: cake..." />
            <input type="submit" name="valider" value="Rechercher" />
        </form>
        <?php if (@$afficher=="exists") { ?>
            <div id='nbr'><?=count($tab) ?></div>
            <!-- il faut afficher les recettes qui sont dans la base de données -->
            <ol>
                <?php for($i=0;$i<count($tab);$i++){ ?>
                <li><?php echo $tab[i]["title"] ?></li>
                <?php } ?>
            </ol>
        <?php
        }else{
        ?>
            <p>Aucune recette</p>

        <?php } ?>
        
    </body>
</html>