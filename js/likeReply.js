$(document).ready( function(event) {

	$("#replySection").on('click', '.likeReply', function (event) {
		var data = {
			reply_id: $(this).val(),
		}

		$.ajax({
			type: 'POST',
			url: 'likeReply.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(".likeReply").html('Unlike');
					var currentLikes = $(".likeReply").closest(".trackReply").find('.numLikes').html()
					//alert(Number(currentLikes));
					$(".likeReply").closest(".trackReply").find('.numLikes').html(Number(currentLikes) + 1);
					$(".likeReply").addClass("unlikeReply");
					$(".likeReply").removeClass("likeReply");
				}
			}
		})
	});

	$('#replySection').on('click', '.unlikeReply', function (event) {
		var data = {
			reply_id: $(this).val(),
		}

		$.ajax({
			type: 'POST',
			url: 'unlikeReply.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(".unlikeReply").html('Like');
					var currentLikes = $(".unlikeReply").closest(".trackReply").find('.numLikes').html()
					$(".unlikeReply").closest(".trackReply").find('.numLikes').html(Number(currentLikes) - 1);
					$(".unlikeReply").addClass("likeReply");
					$(".unlikeReply").removeClass("unlikeReply");
				}
			}
		})
	});
});