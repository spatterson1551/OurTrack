$(document).ready( function() {

	$("#sortDropDown").change( function(event) {

		var method = $("#sortDropDown option:selected").val();
		var genre = $("#categorySelected").text();
		var searchQuery = $("#searchInput").val();


		var data = {
			sortBy: method,
			genre: genre,
			searchQuery: searchQuery
		}

		$.ajax({
			type: 'POST',
			url: 'changeBrowseMethod.php', 
			data: data,
			success: function(data) { 
				//output the returned replies
				if (data.length) {
					$("#trackSection").html(data);
				} else {
					$("#trackSection").html('No results match your criteria');
				}
			}
		})
	});



});