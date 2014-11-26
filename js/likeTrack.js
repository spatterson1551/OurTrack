$(document).ready( function(event) {

	$("#trackSection").on('click', '.likeTrack', function (event) {
		var data = {
			track_id: $(this).val(),
		}

		$.ajax({
			type: 'POST',
			url: 'likeTrack.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(".likeTrack").html('Unlike');
					var currentLikes = $(".likeTrack").closest(".trackListElement").find('.numLikes').html()
					$(".likeTrack").closest(".trackListElement").find('.numLikes').html(Number(currentLikes) + 1);
					$(".likeTrack").addClass("unlikeTrack");
					$(".likeTrack").removeClass("likeTrack");
				}
			}
		})
	});

	$('#trackSection').on('click', '.unlikeTrack', function (event) {
		var data = {
			track_id: $(this).val(),
		}

		$.ajax({
			type: 'POST',
			url: 'unlikeTrack.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(".unlikeTrack").html('Like');
					var currentLikes = $(".unlikeTrack").closest(".trackListElement").find('.numLikes').html()
					$(".unlikeTrack").closest(".trackListElement").find('.numLikes').html(Number(currentLikes) - 1);
					$(".unlikeTrack").addClass("likeTrack");
					$(".unlikeTrack").removeClass("unlikeTrack");
				}
			}
		})
	});
});