$(document).ready( function() {

	$("#sortDropDown").change( function(event) {

		var method = $("#sortDropDown option:selected").val();

		var data = {
			sortBy: method,
		}

		$.ajax({
			type: 'POST',
			url: 'dummyPHP.php', 
			data: data,
			success: function(data) { //event wont work until back end in place, then it will return replies in correct ordering
				//output the returned replies
			}
		})
	});



});