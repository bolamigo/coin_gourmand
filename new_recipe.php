<?php
include_once "functions.php";

$ingredients = array();
$ustensils = array();
$steps = array();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-language" content="fr" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nouvelle recette - Le Coin Gourmand</title>
	<link rel="stylesheet" href="index.css?1">
	<link rel="stylesheet" href="recipe/recipe.css?1">
</head>
<body>
	<section>
		<div class="container">
			<h1 id="main_title">Nom de la recette<ion-icon class="clickable" name="pencil-sharp"></ion-icon></h1>
			<img id="main_img" src="" class="unselectable"/>
			<h2>Ingrédients</h2>
            <div id='ingredients'>
                <div class='ingredient'><ion-icon class='clickable new_ingredient' name='add' role='img'></ion-icon></div>
            </div>
			<h2>Ustensiles</h2>
            <div id='ustensils'>
                <div class='ustensil'><ion-icon class='clickable new_ustensil' name='add' role='img'></ion-icon></div>
            </div>
			<h2>Préparation</h2>
            <div id='new_steps'>
                <div class='new_step_div'><ion-icon class='clickable new_step' name='add' role='img'></ion-icon></div>
            </div>
		</div>
	</section>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?1"></script>
	<script src="index.js?1"></script>
	<script src="recipe/new_recipe.js?1"></script>
</body>
</html>