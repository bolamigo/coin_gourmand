// At page load
$(document).ready(function() {
	$('.item').each(function() {
		// each item gets the clickable class
		$(this).addClass('clickable');

		// get item id and other data
		const id = $(this).attr('id');
		const title = $(this).attr('data-title');
		const author = $(this).attr('data-author');

		// search results are DIVs, auto-generate img, title & link with id
		if($(this)[0].tagName === 'DIV') {
			$(this).append(`<img src="recipe/image/${id}.jpg">`);
			if(window.location.href.includes('profile')) {
				$(this).append(`<div class='flex-container' style='justify-content: center;'>`+
					`<span class='recipe_preview_title'>${format_fr(title)}</span>`+
				`</div>`);
			}
			else {
				$(this).append(`<div class='flex-container'>`+
					`<h2>${format_fr(title)}</h2>`+
					`<h3>${author}</h3>`+
				`</div>`);
			}
		}
		$(this).prop('title', format_fr(title));
		$(this).click(function() { // When user clicks on the recipe (either image or title)
			open_link_new_tab(`https://bolamigo.fr/coin_gourmand/recipe.php?r_id=${id}`); // Open the recipe page in a new tab
		});
	});

	const homepage = `https://bolamigo.fr/coin_gourmand/`;

	if (window.location.href !== homepage) {
		// Logo = home button
		$('body').append(`<div id='logo' class='clickable'><img src='logo.png' class='unselectable'/><span>Accueil</span></div>`);
		$('#logo').click(function() {
			window.location.href = homepage;
		});
		$('#logo').prop('title', homepage);

		$('.data button').css('display', 'none');
	
		$("#change_mail, #change_nickname, #change_gender, #change_age").on("click", function(){
			$(this).after(`<textarea name='value' rows='4' cols='100' required></textarea>`);
			$(this).next().next().css('display', 'inline-block');
			$(this).remove();
		});
	}
});
