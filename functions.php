<?php
include "sql.php"; // Connection to the database.

// This function formats the string to be displayed as French text and read by French users.
function format_fr($string) {
    $string = str_replace('_', ' ', $string); // Replace all underscores (_) with spaces (' ').
    $string = ucfirst($string); // Capitalize the first character.
    return $string; // Return the formatted string.
}

// This function searches for a given id_recipe in the database and returns the unique result .
function search_recipe($db, $query) {
	$res = $db->prepare(
        "SELECT * FROM recipe WHERE id = :query ;"
    );
    $res->bindParam(':query', $query);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put all the recipe info in a table.
	return $tab;
}
?>


