<?php
include 'functions.php';

try {

  // Récupérer les valeurs des champs email et password
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);

  // Récupérer l'utilisateur correspondant à l'adresse email
  $sql = "SELECT * FROM user WHERE mail = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Vérifier si l'utilisateur a été trouvé et si le mot de passe est correct
  if ($user && password_verify($password, $user["password"])) {
    // Les informations d'identification sont valides, démarrer une session
    session_start();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["user_email"] = $user["email"];
  } else {
    // Les informations d'identification sont incorrectes
    alert("Adresse email ou mot de passe incorrect !");
  }
} catch(PDOException $e) {
  alert("Erreur : " . $e->getMessage());
}

// Fonction utilitaire pour nettoyer les données d'entrée
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

