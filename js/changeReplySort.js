$(document).ready( function() {
	
	var track_id = $("#trackHead").data('id');

	$("#sortDropDown").change( function(event) {

		var method = $("#sortDropDown option:selected").val();

		var data = {
			sortBy: method,
			track_id: track_id
		}

		$.ajax({
			type: 'POST',
			url: 'changeReplySort.php', 
			data: data,
			success: function(data) { 
				//output the returned replies
				if (data.length) {
					$("#replySection").html(data);
				} else {
					$("#replySection").html('No replies');
				}
			}
		})
	});



});