<?php
include_once "sql.php"; // Connection to the database.

// This function formats the string to be displayed as French text and read by French users.
function format_fr($string) {
    $string = str_replace('_', ' ', $string); // Replace all underscores (_) with spaces (' ').
    $string = ucfirst($string); // Capitalize the first character.
    return $string; // Return the formatted string.
}

// This function formats the sql datetime for a french sentence.
function datetime_fr($datetime) {

    $year = substr($datetime, 0, 4);

    switch(substr($datetime, 5, 2)){
        case '01':
            $month = 'janvier';
            break;
        case '02':
            $month = 'février';
            break;
        case '03':
            $month = 'mars';
            break;
        case '04':
            $month = 'avril';
            break;
        case '05':
            $month = 'mai';
            break;
        case '06':
            $month = 'juin';
            break;
        case '07':
            $month = 'juillet';
            break;
        case '08':
            $month = 'août';
            break;
        case '09':
            $month = 'septembre';
            break;
        case '10':
            $month = 'octobre';
            break;
        case '11':
            $month = 'novembre';
            break;
        case '12':
            $month = 'décembre';
    }

    $day = ltrim(substr($datetime, 8, 2), "0");
    if($day == '1')
        $day .= '<sup>er</sup>';

    $hours = ""; // in case $datetime is in fact a date

    // if $datetime is sql datetime type, not date.
    if(strlen($datetime) > 10) {
        $hour = substr($datetime, 11, 2);
        $minute = substr($datetime, 14, 2);
        $second = substr($datetime, 17, 2);

        $hours = " à $hour h $minute et $second s";
    }

    return "le $day $month $year$hours.";
}

function get_genre ($genre_id) {
    switch($genre_id) {
        case 0:
            $genre = "autre";
            break;
        case 1:
            $genre = "femme";
            break;
        case 2:
            $genre = "homme";
    }
    return $genre;
}

function get_user_id($nickname) {
    global $conn;
	$res = $conn->prepare(
        "SELECT id FROM user WHERE nickname = :query;"
    );
    $res->bindParam(':query', $nickname);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll();
	return $tab[0]['id']; // Directly return the ID.
}

// This function searches for a user's information.
function search_user($id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT id, mail, nickname, gender, age, date_creation as date FROM `user` u WHERE nickname = :query;"
    );
    $res->bindParam(':query', $id);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put the user into in a table.
	return $tab[0]; // Return the first and only element of the table, the user.
}

function get_user_recipes($user_id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT id, title FROM `recipe` WHERE author = :query LIMIT 10;"
    );
    $res->bindParam(':query', $user_id);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll(); // Put the recipes into in a table.
	return $tab; // Return all the results.
}

// This function searches for a given recipe ID in the database and returns the unique result.
function search_recipe($id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT r.*, u.nickname as nickname FROM recipe r JOIN user u ON r.author = u.id WHERE r.id = :query;"
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
	$tab = $res->fetchAll(); // Put all the ustensils into in a table.
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

// This function gets all the comments on a given recipe.
function get_recipe_comments($recipe_id) {
    global $conn;
	$res = $conn->prepare(
        "SELECT u.nickname, c.content, c.date, c.parent, c.id FROM comment c INNER JOIN user u ON c.user = u.id WHERE recipe = $recipe_id ORDER BY parent, date;"
    );
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
	$tab = $res->fetchAll();
	return $tab;
}

function insert_comment($userId, $recipeID, $content, $parentCommentId){
    global $conn;
    if($parentCommentId === 0) { // New comment
        $res = $conn->prepare(
            "INSERT INTO comment (user, recipe, content, date, parent) VALUES ($userId, $recipeID, :content, NOW(), NULL);"
        );
    }
	else { // New reply
        $res = $conn->prepare(
            "INSERT INTO comment (user, recipe, content, date, parent) VALUES ($userId, $recipeID, :content, NOW(), $parentCommentId);"
        );
    }
    $res->bindParam(':content', $content);
	$res->setFetchMode(PDO::FETCH_ASSOC);
	$res->execute();
}

// Utility function for debug, displays the content of a variable
function echovar($var) {
    echo "<pre>"; // <pre> tag is used to display tables with multiple lines
    print_r($var);
    echo "</pre>";
}

// Fonction utilitaire pour nettoyer les données d'entrée
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// This function creates a JS alert in PHP
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
