<?php
include 'functions.php';

try {

  // Récupérer les valeurs des champs email et password
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);

  // Récupérer l'utilisateur correspondant à l'adresse email
  $sql = "SELECT `nickname`,`password` FROM user WHERE mail = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Vérifier si l'utilisateur a été trouvé et si le mot de passe est correct
  if ($user && password_verify($password, $user["password"])) {
    // Les informations d'identification sont valides, on enregistre le pseudonyme de l'utilisateur dans un cookie valable pour 30 jours.
    setcookie("user_id", $user["nickname"], time()+60*60*24*30);
  } else {
    // Les informations d'identification sont incorrectes
    alert("Adresse email ou mot de passe incorrect !");
  }
} catch(PDOException $e) {
  alert("Erreur : " . $e->getMessage());
}
?>
