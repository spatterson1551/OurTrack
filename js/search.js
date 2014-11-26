$(document).ready( function () {
	var selectedGenre;

	$( '.categoryListItem' ).click(function() {
		var newCategory = $(this);
		var prevCategory = $('#categorySelected');

		prevCategory.prop('id','' );
		newCategory.prop('id','categorySelected' );
		selectedGenre = newCategory.text();

		var data = {
			genre: selectedGenre,
		}

		$.ajax({
			type: 'POST',
			url: 'changeCategory.php', //script that will return new tracks based on new selected category
			data: data,
			success: function(data) { 
				$("#trackSectin").html(data);
			}
		})
	});
});