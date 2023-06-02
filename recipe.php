<?php
include "functions.php";
$xml = new XMLReader;

$id = 4; // display Apple Pie by default.

if (isset($_GET['r_id'])){
	$id = $_GET['r_id'];
	// Ensure the user input is coherent (only digits) and avoid sql injection.
	$valid_query = preg_match('/^[0-9]+$/', $id);
	if($valid_query) {
		$recipe_db = search_recipe($id);
		if(count($recipe_db) == 0)
			$valid_query = false; // Invalid if there is no result.
		else
			$xml->open("recipe/$id.xml");
	}
}

if(!isset($valid_query) || !$valid_query || !isset($_GET['r_id']) || !file_exists("recipe/$id.xml")) {
	$id = 4; // display Apple Pie by default.
	$recipe_db = search_recipe(4);
	$xml->open("recipe/4.xml");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (isset($_COOKIE['user_id'])) {
        $userID = get_user_id($_COOKIE["user_id"]);
        $content = $_POST['comment'];
        $parentCommentID = $_POST['parent_comment_id'] ?? 0;

        insert_comment($userID, $id, $content, $parentCommentID);

		// Refresh the page to show the newly posted comment
		header('Location: '.$_SERVER['REQUEST_URI']);
		exit();
	}
}

$title = format_fr($recipe_db["title"]);
$ingredients = array();
$ustensils = array();
$steps = array();

while($xml->read()) { // Go through the XML tree

	// Filter only opening tags
	if($xml->nodeType !== 1)
		continue;

	// Filter by tag name
	switch($xml->name) {
		case 'id': // Ingredient IDs
			$ingredient = $xml->readString();

			// Fetch the corresponding amount
			while($xml->name !== 'amount')
				$xml->next();

			$ingredients[$ingredient] = $xml->readString();

			break;
		case 'ustensil': // Ustensil IDs
			array_push($ustensils, $xml->readString());
			break;
		case 'step': // The recipe steps
			array_push($steps, $xml->readString());
	}
}

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
			<h1 id="main_title"><?php echo $title?></h1> <div id="search_button"></div>
			<img id="main_img" src="<?php echo "recipe/image/$id.jpg"?>" class="unselectable"/>
			<h2>Ingrédients</h2>
			<?php
				ksort($ingredients);
				$ingredients_db = search_ingredients($ingredients);
				$ingredients_values = array_values($ingredients);
				echo "<div id='ingredients'>";
					foreach ($ingredients_db as $ingredient) {
						$name = $ingredient['name'];
						$value = current($ingredients_values);
						$unit = $ingredient['unit'] ?? '';
						$image = get_media($ingredient['media_id']) ?? '';

						echo "<div class='ingredient'>$name : $value $unit</div>";

						next($ingredients_values);
					}
				echo "</div>";
			?>
			<h2>Ustensiles</h2>
			<?php
				$ustensils = search_ustensils($ustensils);
				echo "<div id='ustensils'>";
					foreach ($ustensils as $ustensil) {
						$name = $ustensil['name'];
						$image = get_media($ustensil['media_id']) ?? '';

						echo "<div class='ustensil'>$name</div>";
					}
				echo "</div>";
			?>
			<h2>Préparation</h2>
			<?php
				echo "<div id='steps'>".
						"<div id='parchment'></div>".
						"<div id='parchment_content'>";
							$step_number = 0;
							foreach ($steps as $step) {
								echo "<div class='step'><span class='step_number'>".++$step_number."</span>  - $step</div>";
							}
							echo "<div id='signature'>".
									$recipe_db['nickname'].
							"</div>".
						"</div>".
					"</div>";
			?>
			<h2>Commentaires</h2>
			<?php
				echo "<div id='comment-box'>".
						"<form method='post' action='".$_SERVER['REQUEST_URI']."'>" .
							"<textarea name='comment' rows='4' cols='100' required></textarea><br>" .
							"<input type='submit' value='Commenter'>".
						"</form>".
					"</div>";
				$comments = get_recipe_comments($id);
				foreach($comments as $comment) {
					if(!$comment['parent']) {
						echo "<div class='comment' id='" . $comment['id'] . "'>".
								"<span class='user'>".
									$comment['nickname'].
								"</span>".
								"<span class='date'>".
								" - " . datetime_fr($comment['date']) . "&nbsp;: " .
								"</span>".
								"<span class='content'>".
									$comment['content'].
								"</span>";
						foreach($comments as $child) {
							if(($child['parent'] ?? 0) == $comment['id']) {
								echo "<div class='child' id='" . $child['id'] . "'>".
										"<span class='user'>".
											$child['nickname'].
										"</span>".
										"<span class='date'>".
											" - " . datetime_fr($child['date']) . "&nbsp;: " .
										"</span>".
										"<span class='content'>".
											$child['content'].
										"</span>".
									"</div>";
							}
						}
						echo "<div class='reply'>".
								"<form method='post' action='".$_SERVER['REQUEST_URI']."'>" .
									"<input type='hidden' name='parent_comment_id' value='" . $comment['id'] ."'>" .
									"<textarea name='comment' rows='4' cols='100' required></textarea><br>" .
									"<input type='submit' value='Répondre'>" .
								"</form>" .
							"</div>".
						"</div>"; // closing .comment
					}
				}
			?>
		</div>
	</section>
	<svg>
		<filter id="wavy">
			<feTurbulence x="0" y="0" baseFrequency="0.02" numOctaves="6" seed="2" />
			<feDisplacementMap in="SourceGraphic" scale="20" />
		</filter>
	</svg>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?1"></script>
	<script src="recipe/recipe.js?1"></script>
</body>
</html>