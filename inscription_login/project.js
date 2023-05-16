// Récupérer le formulaire et écouter l'événement submit
const form = document.getElementById("login-form");
form.addEventListener("submit", function(event) {
  event.preventDefault(); // Empêcher l'envoi du formulaire par défaut
  const data = new FormData(form); // Récupérer les données du formulaire
  const xhr = new XMLHttpRequest(); // Créer une requête AJAX
  xhr.open(form.method, form.action, true); // Configurer la requête
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Configurer l'en-tête HTTP
  xhr.onload = function() {
    if (xhr.status === 200) { // Vérifier si la requête s'est terminée avec succès
      alert(xhr.responseText); // Afficher la réponse du serveur
    } else {
      alert("Erreur lors de la connexion !");
    }
  };
  xhr.onerror = function() {
    alert("Erreur réseau !");
  };
  xhr.send(new URLSearchParams(data)); // Envoyer les données du formulaire
});



function inscription() {
  // Récupérer les valeurs des champs email, password et confirmPassword
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  // Vérifier si les champs ne sont pas vides et que les mots de passe correspondent
  if (email && password && confirmPassword && password === confirmPassword) {
    // Créer une instance de XMLHttpRequest
    
  } else {
    alert("Veuillez remplir tous les champs et vérifier que les mots de passe correspondent.");
  }
}


