$(document).ready( function(event) {

	$(".likeReply").click( function(event) {
		var data = {
			replyID: $(this).val(),
		}

		$.ajax({
			type: 'POST',
			url: 'some php script in the future', 
			data: data,
			success: function(data) { //event wont work until back end in place, then the number of likes will also be incremented
				$(this).html('You like this');
			}
		})
	});
});