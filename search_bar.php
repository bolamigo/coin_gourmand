<?php
include "sql.php";
@$keywords = $_GET["keywords"]; // récupérer les mots clés
// TODO check $keywords to avoid SQL injection
$res = $conn->prepare(
    "SELECT title FROM recipe WHERE title LIKE '%$keywords%'"
);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();
$tab = $res->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - Le Coin Gourmand</title>
    <link rel="stylesheet" href="index.css?1">
</head>
<body>
	<section>
		<div class="container">
			<h1 id="main_title">Résultats de recherche</h1>
			<form action="search_bar.php" method="get">
				<input type="text" name="keywords" value=<?php echo $keywords; ?> required>
				<ion-icon name="search"></ion-icon>
			</form>
			<div id="search_results">
                <?php
                for ($i = 0; $i < count($tab); $i++) {
                    echo "<div class='item' id='" .
                        $tab[$i]["title"] .
                        "'></div>";
                }
                if (count($tab) == 0) {
                    echo "<p>Aucun résultat.</p>";
                }
                ?>
            </div>
	</section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="functions.js?1"></script>
    <script src="index.js?1"></script>
</body>
</html>