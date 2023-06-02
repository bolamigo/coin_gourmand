const regex = {
	url: /^((([A-Za-z]{3,9}:(?:\/\/)?)(?:[\-;:&=\+\$,\w]+@)?[A-Za-z0-9\.\-]+|(?:www\.|[\-;:&=\+\$,\w]+@)[A-Za-z0-9\.\-]+)((?:\/[\+~%\/\.\w\-_]*)?\??(?:[\-\+=&;%@\.\w_]*)#?(?:[\.\!\/\\\wàâçéèêëîïôùûüÀÂÇÉÈÊËÎÏÔÙÛÜ\-'"]*))?)$/,
	mail: /^([a-z0-9_\.\+-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
};

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// This function returns the next element in the DOM hierarchy that matches the given selector
function nextInDOM(_selector, _subject) {
	let next = getNext(_subject); // Get the next element after the subject element

	// Loop until a matching element is found or there are no more next elements
	while (next.length > 0) {
		var found = searchFor(_selector, next); // Search for the selector within the next element
		if (found != null)
			return found; // If a matching element is found, return it
		next = getNext(next); // Get the next element after the current next element
	}
	return null; // Return null if no matching element is found
}

// This function returns the next sibling element or the parent's next sibling element if there are no more next siblings
function getNext(_subject) {
	if (_subject.next().length > 0)
		return _subject.next(); // If there is a next sibling element, return it
	return getNext(_subject.parent()); // If there are no more next siblings, recursively get the parent's next sibling
}

// This function recursively searches for an element that matches the given selector within the given subject element and its children
function searchFor(_selector, _subject) {
	if (_subject.is(_selector))
		return _subject; // If the subject element matches the selector, return it
	let found = null;

	// Iterate over each child element of the subject element
	_subject.children().each(function() {
		found = searchFor(_selector, $(this)); // Recursively search for the selector within each child element
		if (found != null)
			return false; // If a matching element is found, stop iterating by returning false
	});
	return found; // Return the matching element, or null if no matching element is found
}

// This function alerts an error with its code to the user
function error(error_code) {
	return alert(`Error ${error_code}.\nPlease contact the support at support@lena-cries.eu and provide them with the error code ${error_code}.`);
}

// This function opens a given link in a new browser tab
function open_link_new_tab(link) {
	if (!link.match(regex.url)) // Check if the link matches the regex pattern for a valid URL.
		return error(531); // If not, return an error code 531. Error is hidden because it's a code error.

	const opened = window.open(link, '_blank'); // Open the link in a new tab using the window.open() function with the '_blank' target.
	if (opened) return opened.focus(); // If the link was successfully opened in a new tab, focus on that tab.
	return alert("Ouverture d'onglet bloquée par le navigateur. Lien : " + link); // If the link opening is blocked by the browser, display an alert with the blocked link.
}

// This function formats the string to be displayed as French text and read by French users
function format_fr(string) {
	string = string.replaceAll('_', ' '); // Replace all underscores (_) with spaces (' ')
	string = string.replaceAll('%27', "'"); // Replace all url-formatted single quotes (%27) to single quotes (')
	string = string.charAt(0).toUpperCase() + string.slice(1); // Capitalize the first character
	return string; // Return the formatted string
}

function inscription() {
	// Récupérer les valeurs des champs email, password et confirmPassword
	let email = document.getElementById("email").value;
	let password = document.getElementById("password").value;
	let confirmPassword = document.getElementById("confirmPassword").value;

	// Vérifier si les champs ne sont pas vides et que les mots de passe correspondent
	if (email && password && confirmPassword && password === confirmPassword) {
		// Créer une instance de XMLHttpRequest

	} else {
		alert("Veuillez remplir tous les champs et vérifier que les mots de passe correspondent.");
	}
}

function login() {
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
        window.location.href = "https://bolamigo.fr/coin_gourmand/"; // Redirection to homepage
    });
}