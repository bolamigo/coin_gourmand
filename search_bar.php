<?php
include "sql.php"; // connect to the database
$keywords = $_GET["keywords"]; // retrieve keywords
$valid = preg_match('/^[a-zA-Z0-9 àâçéèêëîïôùûüÀÂÇÉÈÊËÎÏÔÙÛÜ\"\'\-]+$/', $keywords); // ensure the user input is coherent and avoid sql injection
function strtosqlregex($string){
    $search = array(' ', '\'', 'À', 'Â', 'Ç', 'É', 'È', 'Ê', 'Ë', 'Î', 'Ï', 'Ô', 'Ù', 'Û', 'Ü');
    $replace = array('%', '\'\'', 'à', 'â', 'ç', 'é', 'è', 'ê', 'ë', 'î', 'ï', 'ô', 'ù', 'û', 'ü');
    return str_replace($search, $replace, strtolower($string));
}
if($valid) {
    $keywords_regex = strtosqlregex($keywords); // format the keywords for sql regex
    $res = $conn->prepare(
        "SELECT title FROM recipe WHERE title LIKE '%$keywords_regex%';" // find corresponding recipes
    );
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $tab = $res->fetchAll(); // put results in a table
}
else $tab = [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - Le Coin Gourmand</title>
    <link rel="stylesheet" href="index.css?2">
</head>
<body>
	<section>
		<div class="container">
			<h1 id="main_title">Résultats de recherche</h1>
			<form action="search_bar.php" method="get">
				<input type="text" name="keywords" value="<?php echo str_replace('"', '&quot;', $keywords); ?>" required>
				<ion-icon name="search"></ion-icon>
			</form>
			<div id="search_results">
                <?php
                for ($i = 0; $i < count($tab); $i++) {
                    echo "<div class='item' id='".$tab[$i]["title"]."'></div>";
                }
                if(!$valid){
                    echo "<p id='no_result'>Caractères invalides."."<br>".
                    "Caractères autorisés : lettres, chiffres, espace, lettre accentuées françaises, tiret, apostrophe, guillemets.</p>";
                }
                else if (count($tab) == 0) {
                    echo "<p id='no_result'>Aucun résultat.</p>";
                }
                ?>
            </div>
	</section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="functions.js?2"></script>
    <script src="index.js?2"></script>
</body>
</html>