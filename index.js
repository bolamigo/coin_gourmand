// At page load
$(document).ready(function() {
	$('.item').each(function() {
		// each item gets the clickable class
		$(this).addClass('clickable');

		// get item id and other data
		const id = $(this).attr('id');
		const title = $(this).attr('data-title');
		const author = $(this).attr('data-author');//TODO show author name

		// search results are DIVs, auto-generate img, title & link with id
		if($(this)[0].tagName === 'DIV') {
			$(this).append(`<img src="recipe/image/${id}.jpg">`);
			$(this).append(`<div class='flex-container'><h2>${format_fr(title)}</h2></div>`);
		}
		$(this).prop('title', format_fr(title));
		$(this).click(function() { // When user clicks on the recipe (either image or title)
			open_link_new_tab(`https://bolamigo.fr/coin_gourmand/recipe.php?r_id=${id}`); // Open the recipe page in a new tab
		});
	})
});
