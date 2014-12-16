$(document).ready( function(event) {

	$("#replySection").on('click', '.likeReply', function (event) {
		var data = {
			reply_id: $(this).val(),
		}

		var thisElement = $(this);

		$.ajax({
			type: 'POST',
			url: 'likeReply.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(thisElement).html('Unlike');
					var parent = $(thisElement).closest(".trackReply");
					var currentLikes = $(parent).find('.numLikes').html()
					$(parent).find('.numLikes').html(Number(currentLikes) + 1);
					$(parent).addClass("unlikeReply");
					$(parent).removeClass("likeReply");
				}
			}
		})
	});

	$('#replySection').on('click', '.unlikeReply', function (event) {
		var data = {
			reply_id: $(this).val(),
		}

		var thisElement = $(this);

		$.ajax({
			type: 'POST',
			url: 'unlikeReply.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(thisElement).html('Like');
					var parent = $(thisElement).closest(".trackReply");
					var currentLikes = $(parent).find('.numLikes').html()
					$(parent).find('.numLikes').html(Number(currentLikes) - 1);
					$(parent).addClass("likeReply");
					$(parent).removeClass("unlikeReply");
				}
			}
		})
	});
});