$("#search_button").one("click", function () {
    $(this).html(
        "<form action='search_results.php' method='get'>"+
            "<input type='text' name='keywords' placeholder='Rechercher une recette...' required>"+
            "<ion-icon name='search'></ion-icon>"+
        "</form>"
    );
});