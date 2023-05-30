// At page load
$(document).ready(function() {
	$('.item').each(function() {
		// each item gets the clickable class
		$(this).addClass('clickable');

		// get item id
		const id = $(this).attr('id');

		// auto-generate img/title/link with id
		$(this).append(`<img src="image/${id}.jpg">`);
		$(this).append(`<div class='flex-container'><h2>${format_fr(id)}</h2></div>`);
		$(this).prop('title', format_fr(id));
		$(this).click(function() { // When user clicks on the recipe (either image or title)
			console.log(id);
			open_link_new_tab(`${window.location.href}recipe.php?t=${id}`); // Open the recipe page in a new tab
		});
	})
});
