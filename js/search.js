$(document).ready( function () {
	var selectedGenre;

	$( '.categoryListItem' ).click(function() {
		var newCategory = $(this);
		var prevCategory = $('#categorySelected');

		prevCategory.prop('id','' );
		newCategory.prop('id','categorySelected' );
		selectedGenre = newCategory.text();
	});
});