<?php
include_once "functions.php";

if (isset($_COOKIE['user_id'])){
	$nickname_cookie = $_COOKIE['user_id'];
	// Ensure the user input is coherent (alphanumeric) and avoid sql injection.
	$valid_query = preg_match('/^[a-z-A-Z0-9]+$/', $nickname_cookie);
	if($valid_query) {
		$user = search_user($nickname_cookie);
		if(count($user) == 0)
			$valid_query = false; // Invalid if there is no result.
	}
}

if(!isset($valid_query) || !$valid_query || !isset($_COOKIE['user_id'])) {
	$nickname_cookie = 1; // display bolamigo by default.
	$user = search_user($nickname_cookie);
}

echo '<br>get<br>';
echovar($_GET);
echo '<br>isset(get field)<br>';
echovar(isset($_GET['field']));
echo '<br>isset(get value)<br>';
echovar(isset($_GET['value']));

// Check if the form has been submitted
if (isset($_GET['field']) && isset($_GET['value'])) {
	$id = $user['id'];
	echo "<br>id<br>";
	echovar($id);
    $field = $_GET['field'];
	echo "<br>field<br>";
	echovar($field);
    $value = $_GET['value'];
	echo "<br>value<br>";
	echovar($value);

    if ($field == 'gender') {
        if ($value == 'homme') {
            $value = 0;
        } elseif ($value == 'femme') {
            $value = 1;
        } elseif ($value == 'autre') {
            $value = 2;
        }
    }

    // Update the user information in the database
//    update_user($id, $field, $value);

    header("Location: profile.php");
	exit();
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
            <div id='information'>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
                    <div class='data'>
                        Adresse email: <span id="change_mail"><?php echo $mail; ?></span>
                        <button type="submit" name="field" value="mail">Modifier</button>
                    </div>
                </form>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
                    <div class='data'>
                        Pseudonyme: <span id="change_nickname"><?php echo $nickname; ?></span>
                        <button type="submit" name="field" value="nickname">Modifier</button>
                    </div>
                </form>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
                    <div class='data'>
                        Genre: <span id="change_gender"><?php echo $gender; ?></span>
                        <button type="submit" name="field" value="gender">Modifier</button>
                    </div>
                </form>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
                    <div class='data'>
                        Âge: <span id="change_age"><?php echo $age; ?></span> ans
                        <button type="submit" name="field" value="age">Modifier</button>
                    </div>
                </form>
                <div class='data'>Inscrit depuis <?php echo $date_creation; ?></div>
            </div>
			<h2>Recettes partagées</h2>
            <div id='search_results'>
                <?php
                foreach($shared_recipes as $recipe_id => $recipe_title) {
                    echo "<div class='item clickable' id='$recipe_id' src='recipe/image/$recipe_id.jpg' data-title='$recipe_title'></div>";
                }
                ?>
            </div>
		</div>
	</section>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?1"></script>
	<script src="index.js?1"></script>
</body>
</html>