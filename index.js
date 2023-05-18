// TODO for each result (SQL), add an element with class "item" and id="<recipe.title>" (SQL, sans les espaces)
// TODO for each element with class "item" :
//          image : image/<id>.jpg
//          title(h2) : format_fr(<id>)

// At page load
$(document).ready(function() {
    $('.item').each(function () {
        $(this).addClass('clickable');
        const id = $(this).attr('id');
        $(this).append(`<div class='flex-container'><h2>${format_fr(id)}</h2></div>`)
        $(this).prop('title', format_fr(id));
        $(this).click(function(){
            open_link_new_tab(`${window.location.href}recipe/${id}.html`);
        });
    })
});