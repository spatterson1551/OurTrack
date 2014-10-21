$(document).ready( function () {
	var selectedGenre;

	$( '.categoryListItem' ).click(function() {
		var newCategory = $(this);
		var prevCategory = $('#categorySelected');

		prevCategory.prop('id','' );
		newCategory.prop('id','categorySelected' );
		selectedGenre = newCategory.text();

		var data = {
			category: selectedGenre,
		}

		$.ajax({
			type: 'POST',
			url: 'dummyPHP.php', //script that will return new tracks based on new selected category
			data: data,
			success: function(data) { //event wont work until back end in place, then it will return all the tracks based on category
				//output results from server
			}
		})
	});
});