<?php
// Connexion à la base de données
$servername = "zikosfnprojetweb.mysql.db";
$username = "zikosfnprojetweb";
$password = "bJZGZgrQz2h5";
$dbname = "zikosfnprojetweb";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Configurer PDO pour générer des exceptions en cas d'erreur
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connexion réussie à la base de données.";

  // Récupérer les valeurs des champs email et password
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);

  // Récupérer l'utilisateur correspondant à l'adresse email
  $sql = "SELECT * FROM user WHERE mail = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Vérifier si l'utilisateur a été trouvé et si le mot de passe est correct
  if ($user && password_verify($password, $user["password_hash"])) {
    // Les informations d'identification sont valides, démarrer une session
    session_start();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_email"] = $user["email"];
    echo "Vous êtes maintenant connecté !";
  } else {
    // Les informations d'identification sont incorrectes
    echo "Adresse email ou mot de passe incorrect !";
  }
} catch(PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}

// Fonction utilitaire pour nettoyer les données d'entrée
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
