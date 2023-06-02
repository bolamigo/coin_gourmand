<?php
include_once "functions.php"; // Inclure les fonctions PHP

// Vérifier si les données ont été envoyées en utilisant la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs email, password et confirmPassword
  $email = test_input($_POST["email"]);
  $age = test_input($_POST["age"]);
  $nickname = test_input($_POST["nickname"]);
  $password = test_input($_POST["password"]);

  $time = time();
  $date = date("Y/m/d", $time);

  try {
    // Hasher le mot de passe pour des raisons de sécurité
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
  
    // Insérer l'utilisateur dans la table user
    $request = "INSERT INTO user (mail, password, age, nickname, date_creation) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($request);
    $stmt->execute([$email, $password_hash, $age, $nickname, $date]);

    // Envoyer une réponse JSON indiquant que l'inscription a réussi
    $response = array(
      "success" => true,
      "message" => "Inscription reussie !"
    );
    echo json_encode($response);

    $valid = true;
  } 
  catch(PDOException $e) {
    $valid = false;
    alert("Erreur : ".$e->getMessage());
  }
}

if (!$valid) {
  // Envoyer une réponse JSON indiquant que l'inscription a échoué
  $response = array(
    "success" => false,
    "message" => "Veuillez remplir tous les champs et vérifier que les mots de passe correspondent."
  );
  echo json_encode($response);
}
?>