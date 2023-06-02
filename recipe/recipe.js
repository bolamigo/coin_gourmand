$("#search_button").one("click", function () {
    $(this).html(
        "<form action='search_results.php' method='get'>"+
            "<input type='text' name='keywords' placeholder='Rechercher une recette...' required>"+
            "<ion-icon name='search'></ion-icon>"+
        "</form>"
    );
    $(this).css("top", "0");
    $(this).css("left", "0");
    $("input:text:visible:first").focus();
});