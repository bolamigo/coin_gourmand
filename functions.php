<?php
include "sql.php"; // Connection to the database.

// This function formats the string to be displayed as French text and read by French users.
function format_fr($string) {
    $string = str_replace('_', ' ', $string); // Replace all underscores (_) with spaces (' ').
    $string = ucfirst($string); // Capitalize the first character.
    return $string; // Return the formatted string.
}

// This function searches for a given recipe ID in the database and returns the unique result.
function search_recipe($id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT * FROM recipe WHERE id = :query;"
    );
    $res->bindParam(':query', $id);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put the recipe into in a table.
	return $tab[0]; // Return the first and only element of the table, the recipe.
}

// This function searches for one or more given ingredient ID in the database and returns the results in a tab.
function search_ingredients($IDs) {
    global $conn;
    $IDs = implode(',', array_keys($IDs));
	$res = $conn->prepare(
        "SELECT `name`, `unit`, `media_id` FROM ingredient WHERE id in ($IDs) order by id;"
    );
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put all the ingredients into in a table.
	return $tab;
}

// This function searches for one or more given ustensil ID in the database and returns the results in a tab.
function search_ustensils($IDs) {
    global $conn;
    $IDs = implode(',', $IDs);
	$res = $conn->prepare(
        "SELECT `name`, `media_id` FROM ustensil WHERE id in ($IDs);"
    );
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put all the ingredients into in a table.
	return $tab;
}

// This function gets the URL of a media object from its ID.
function get_media($id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT `url` FROM media WHERE id = :query;"
    );
    $res->bindParam(':query', $id);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll();
	return $tab[0];
}

// Utility function for debug, displays the content of a variable
function echovar($var) {
    echo "<pre>"; // <pre> tag is used to display tables with multiple lines
    print_r($var);
    echo "</pre>";
}
?>
