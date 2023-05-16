<?php require "sql.php"; ?>




<?php
// Vérifier si les données ont été envoyées en utilisant la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs des champs email, password et confirmPassword
  $email = test_input($_POST["email"]);
  $age = test_input($_POST["age"]);
  $nickname = test_input($_POST["nickname"]);
  $password = test_input($_POST["password"]);

  $time=time();
  $date =date( "Y/m/d", $time );

  try {
    // Configurer PDO pour générer des exceptions en cas d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";


    // Hasher le mot de passe pour des raisons de sécurité
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
  
    // Insérer l'utilisateur dans la table users
    $sql = "INSERT INTO user (mail, password, age, nickname,date_creation) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $password_hash, $age, $nickname, $date]);

    echo "L'utilisateur a été enregistré avec succès !";
  } 
  catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }


    // Envoyer une réponse JSON indiquant que l'inscription a réussi
    $response = array(
      "success" => true,
      "message" => "Inscription reussie !"
    );
    echo json_encode($response);
  }
  
  else {
    // Envoyer une réponse JSON indiquant que l'inscription a échoué
    $response = array(
      "success" => false,
      "message" => "Veuillez remplir tous les champs et vérifier que les mots de passe correspondent."
    );
    echo json_encode($response);
  }



// Fonction utilitaire pour nettoyer les données d'entrée
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

