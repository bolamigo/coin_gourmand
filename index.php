<?php
include "functions.php";
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
		<h1 id="main_title">Le Coin Gourmand</h1>
		<form action="search_bar.php" method="get">
				<input type="text" name="keywords" placeholder="Rechercher une recette..." required>
				<ion-icon name="search"></ion-icon>
			</form>
		<div>
			<?php
			if ($_COOKIE["user_id"]) {
				echo "<a href='profile.php'>".
						"<button class='glow-on-hover' type='button'>".
							$_COOKIE["user_id"].
						"</button>".
					"</a>";
				// TODO onclick disconnect
				echo "<button class='glow-on-hover' type='button'>".
						"Se déconnecter".
					"</button>";
			}
			else {
				echo "<a href='page_login.html'>".
						"<button class='glow-on-hover' type='button'>".
							"Se connecter".
						"</button>".
					"</a>";
				echo "<a href='page_inscription.html'>".
						"<button class='glow-on-hover' type='button'>".
							"S'inscrire".
						"</button>".
					"</a>";
			}
			?>
		</div>
	</header>


	<!-- <section>
		<div class="container">
			<h1 id="main_title">Le Coin Gourmand</h1>
			<form action="search_bar.php" method="get">
				<input type="text" name="keywords" placeholder="Rechercher une recette..." required>
				<ion-icon name="search"></ion-icon>
			</form>
			<div id="search_results">
				<div class="item" id='4' data-title='tarte_aux_pommes'></div>
				<div class="item" id='5' data-title='donuts'></div>
				<div class="item" id='7' data-title='gâteau_arc-en-ciel'></div>
				<div class="item" id='8' data-title='pancakes'></div>
			</div>
		</div>
	</section>
	-->


	<div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
	  <img class="image" src="recipe/image/4.jpg" draggable="false" />
	  <img class="image" src="recipe/image/5.jpg" draggable="false" />
	  <img class="image" src="recipe/image/7.jpg" draggable="false" />
	  <img class="image" src="recipe/image/8.jpg" draggable="false" />
    </div>
	<script src="defilleImage.js"></script>

	<section>
	<div class="container">
		<h1 id="slogan">"Succombez aux délices en souriant : votre site, l'épicurieux de la cuisine !"</h1>
	</div>
	</section>

	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script src="jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/validate-js/2.0.1/validate.min.js" integrity="sha512-8GLIg5ayTvD6F9ML/cSRMD19nHqaLPWxISikfc5hsMJyX7Pm+IIbHlhBDY2slGisYLBqiVNVll+71CYDD5RBqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="functions.js?2"></script>
	<script src="index.js?2"></script>
</body>
</html>