<!DOCTYPE html>
<html>
<head>
  <title>Recette</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
	<header id="header">
		<h1>Les recettes facile</h1>
		<div>

			<button> <a href="log.php"> login </a></button>
			<script src="project.js"></script>

		</div>
	</header>

	<h2>Inscription</h2>

	<form id="register-form" action="inscription.php" method="POST">
		<label for="email">Email :</label>
		<input type="email" id="email" name="email" required>
		<br>

		<label for="age">Age :</label>
		<input type="age" id="age" name="age" required>
		<br>
		
		<label for="nickname">Nickname :</label>
		<input type="nickname" id="nickname" name="nickname" required>
		<br>
		
		<label for="gender">Choisissez votre genre :</label>
		<select id="gender" name="gender">
			<option value="male">Homme</option>
			<option value="female">Femme</option>
			<option value="autre">Autre</option>
		</select>
		<br>
		
		<label for="password">Mot de passe :</label>
		<input type="password" id="password" name="password" required>
		<br>
		
		<label for="confirmPassword">Confirmer le mot de passe :</label>
		<input type="password" id="confirmPassword" name="confirmPassword" required>
		<br>
		<button type="submit" onclick="inscription()">S'inscrire</button>
	</form>

</body>
</html>

