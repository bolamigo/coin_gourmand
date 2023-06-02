close_search_button();

function close_search_button() {
    $("#search_button").html("<ion-icon class='clickable' name='search'></ion-icon>");
    $("#search_button").one("click", function () {
        $(this).html(
            "<form action='search_results.php' method='get'>"+
                "<input type='text' name='keywords' placeholder='Rechercher une recette...' required>"+
                "<ion-icon name='search'></ion-icon>"+
            "</form>"+
            "<ion-icon id='close_search' class='clickable' name='close-circle-outline'></ion-icon>"
        );
        $(this).css("top", "0");
        $(this).css("left", "0");
        $("input:text:visible:first").focus();
    });

    // TODO marche pas ?
    $("#close_search").on("click", function () {
        close_search_button();
    });
}
