<?php
header('Content-type: text/html; charset=UTF-8');
include "functions.php"; // Connect to the database.

if(!isset($_GET['t'])){ // If there is no input
	$recipe = search_recipe($conn, 'tarte_aux_pommes'); // display Apple Pie by default.
}
else {
	$id = $_GET['t'];
	// Ensure the user input is coherent ('_' and no space) and avoid sql injection.
	$valid = preg_match('/^[\w\pL\pMàâçéèêëîïôùûüÀÂÇÉÈÊËÎÏÔÙÛÜ\"\'\-]+$/', $id);
	if($valid) {
		$recipe = search_recipe($conn, $id);
		if(count($recipe) == 0) {
			$valid = false; // Invalid if there is no result.
		}
	}
	if(!$valid) { // Not "else" because valid can be set false in the if block.
		$recipe = search_recipe($conn, 'tarte_aux_pommes'); // display Apple Pie by default.
	}
}

$recipe = $recipe[0]; // 1 result, simplify syntax.
$title = format_fr($recipe["title"]);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-language" content="fr" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title?> - Le Coin Gourmand</title>
	<link rel="stylesheet" href="index.css?1">
	<link rel="stylesheet" href="recipe/recipe.css?1">
</head>
<body>
	<section>
		<div class="container">
			<h1 id="main_title"><?php echo $title?></h1> <div id="search_button"><ion-icon name="search"></ion-icon></div>
			<h2>Recette</h2>
		</div>
	</section>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?1"></script>
	<script src="recipe/recipe.js?1"></script>
</body>
</html>