<?php
include "sql.php"; // Connection to the database.

// This function formats the string to be displayed as French text and read by French users.
function format_fr($string) {
    $string = str_replace('_', ' ', $string); // Replace all underscores (_) with spaces (' ').
    $string = ucfirst($string); // Capitalize the first character.
    return $string; // Return the formatted string.
}

// This function searches for a given recipe in the database and returns the first result in a fields tab.
function search_recipe($db, $query) {
	// Get the recipe info, take the first result. Should be only 1.
	$res = $db->prepare(
        "SELECT * FROM recipe WHERE title = :query LIMIT 1;"
    );
    $res->bindParam(':query', $query);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put all the recipe info in a table.
	return $tab;
}
?>