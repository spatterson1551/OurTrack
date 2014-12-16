$(document).ready( function () {
	var selectedGenre;

	$( '.categoryListItem' ).click(function() {

		var newCategory = $(this);
		var prevCategory = $('#categorySelected');

		prevCategory.prop('id','' );
		newCategory.prop('id','categorySelected' );
		selectedGenre = newCategory.text();

		var method = $("#sortDropDown option:selected").val();

		var searchQuery = $("#searchInput").val();

		var data = {
			genre: selectedGenre,
			sortBy: method,
			searchQuery: searchQuery
		}

		$.ajax({
			type: 'POST',
			url: 'changeBrowseMethod.php', //script that will return new tracks based on new selected category
			data: data,
			success: function(data) { 
				if (data.length) {
					$("#trackSection").html(data);
				} else {
					$("#trackSection").html('No results match your criteria');
				}
			}
		})
	});

	$('#searchInput').tooltip('hide');
});