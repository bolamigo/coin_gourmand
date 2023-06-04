$(document).ready(async function() {

    // activating enter-to-sumbit in comment textareas. SHIFT + Enter is needed for a new line
    $("form textarea").keypress(function (e) {
        if(e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            $(this).closest("form").submit();
        }
    });

    close_search_button();

    await sleep(256); // #steps is changing size

    // Adjusting the size of the parchment
    $("#parchment").css('height', $("#steps").height() - 64);
    $("#parchment").css('width', $("#steps").width() - 64);
});

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
        $(this).css("right", "0");
        $("input:text:visible:first").focus();
    });

    // TODO marche pas ?
    $("#close_search").on("click", function () {
        close_search_button();
    });
}
