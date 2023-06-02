<?php
include_once "functions.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Coin Gourmand</title>
    <link rel="stylesheet" href="index.css?2">
</head>
<body>
	<header id="header">
		<h1 id="main_title" class="unselectable">Le Coin Gourmand</h1>
		<form action="search_results.php" method="get">
				<input type="text" name="keywords" placeholder="Rechercher une recette..." required>
				<ion-icon name="search"></ion-icon>
			</form>
		<div>
			<?php
			if ($_COOKIE["user_id"]) {
				echo "<a href='profile.php'>".
						"<button class='unselectable glow-on-hover' type='button'>".
							$_COOKIE["user_id"].
						"</button>".
					"</a>";
				// TODO onclick disconnect, destroy cookie
				echo "<button class='unselectable glow-on-hover' type='button'>".
						"Se déconnecter".
					"</button>";
			}
			else {
				echo "<a href='page_login.html'>".
						"<button class='unselectable glow-on-hover' type='button'>".
							"Se connecter".
						"</button>".
					"</a>";
				echo "<a href='page_inscription.html'>".
						"<button class='unselectable glow-on-hover' type='button'>".
							"S'inscrire".
						"</button>".
					"</a>";
			}
			?>
		</div>
	</header>

	<div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
	  <img class="item image" id='4' src="recipe/image/4.jpg" draggable="false" data-title='tarte_aux_pommes'/>
	  <img class="item image" id='5' src="recipe/image/5.jpg" draggable="false" data-title='donuts'/>
	  <img class="item image" id='7' src="recipe/image/7.jpg" draggable="false" data-title='gâteau_arc-en-ciel'/>
	  <img class="item image" id='8' src="recipe/image/8.jpg" draggable="false" data-title='pancakes'/>
    </div>
	<script src="defilleImage.js"></script>

	<section>
	<div class="container">
		<h1 id="slogan" class="unselectable">Succombez au délice : salé ou sucré, enchantez vos sens et égayez vos journées</h1>
	</div>
	</section>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?2"></script>
	<script src="index.js?2"></script>
</body>
</html>