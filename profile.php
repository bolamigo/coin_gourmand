<?php
include_once "functions.php";

if (isset($_COOKIE['user_id'])){
	$id = $_COOKIE['user_id'];
	// Ensure the user input is coherent (alphanumeric) and avoid sql injection.
	$valid_query = preg_match('/^[a-z-A-Z0-9]+$/', $id);
	if($valid_query) {
		$user = search_user($id);
		if(count($user) == 0)
			$valid_query = false; // Invalid if there is no result.
	}
}

if(!isset($valid_query) || !$valid_query || !isset($_COOKIE['user_id'])) {
	$id = 1; // display bolamigo by default.
	$user = search_user($id);
}

$mail = $user['mail'];
$nickname = $user['nickname'];
$gender = get_genre($user['gender']);
$age = $user['age'];
$date_creation = datetime_fr($user['date']);

$shared_recipes_db = get_user_recipes($user['id']);
$shared_recipes = array();
foreach($shared_recipes_db as $recipe) {
    $shared_recipes[$recipe['id']] = $recipe['title'];
}

// <img class="item" id='4' src="recipe/image/4.jpg" draggable="false" data-title='tarte_aux_pommes'/>

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-language" content="fr" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $nickname?> - Le Coin Gourmand</title>
	<link rel="stylesheet" href="index.css?1">
	<link rel="stylesheet" href="recipe/recipe.css?1">
</head>
<body>
	<section>
		<div class="container">
			<h1 id="main_title"><?php echo $nickname?> - Profil</h1>
			<h2>Informations</h2>
            <?php
            echo "<div id='information'>".
                    "<div class='data'>Adresse email : $mail</div>".
                    "<div class='data'>Pseudonyme : $nickname</div>".
                    "<div class='data'>Genre : $gender</div>".
                    "<div class='data'>Âge : $age ans</div>".
                    "<div class='data'>Inscrit depuis $date_creation</div>".
                "</div>";
            ?>
			<h2>Recettes partagées</h2> <a id="new_recipe_button" href="new_recipe.php"><ion-icon class="clickable" name="add" role="img"></a>
            <?php
            echo "<div id='search_results'>";
                foreach($shared_recipes as $recipe_id => $recipe_title) {
                    echo "<div class='item clickable' id='$recipe_id' src='recipe/image/$recipe_id.jpg' data-title='$recipe_title'></div>";
                }
            echo "</div>";
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