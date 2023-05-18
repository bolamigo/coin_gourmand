// TODO for each result (SQL), add an element with class "item" and id="<recipe.title>" (SQL, sans les espaces)
// TODO for each element with class "item" :
//        onclick -> recipe/<recipe.title sans espaces>.html
//        image = image/<recipe.title sans espaces>.jpg
//        title(h2) -> <recipe.title> (SQL)

// At page load
$(document).ready(function() {
    $('.item').click(function() {
        let id = $(this).attr('id');
        open_link_new_tab(`recipe/${id}.html`);
    });
    $('.item').hover(function() {
        let id = $(this).attr('id');
        $(this).prop('title', id);
    });
});