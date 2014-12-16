$(document).ready( function(event) {

	$("#trackSection").on('click', '.likeTrack', function (event) {
		var data = {
			track_id: $(this).val(),
		}

		var thisElement = $(this);

		$.ajax({
			type: 'POST',
			url: 'likeTrack.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(thisElement).html('Unlike');
					var parent = $(thisElement).closest(".trackListElement");
					var currentLikes = $(parent).find('.numLikes').html();
					$(parent).find('.numLikes').html(Number(currentLikes) + 1);
					$(thisElement).addClass("unlikeTrack");
					$(thisElement).removeClass("likeTrack");
				}
			}
		})
	});

	$('#trackSection').on('click', '.unlikeTrack', function (event) {
		var data = {
			track_id: $(this).val(),
		}

		var thisElement = $(this);

		$.ajax({
			type: 'POST',
			url: 'unlikeTrack.php', 
			data: data,
			success: function(data) {
				if(data == 'success') { 
					$(thisElement).html('Like');
					var parent = $(thisElement).closest(".trackListElement");
					var currentLikes = $(parent).find('.numLikes').html();
					$(parent).find('.numLikes').html(Number(currentLikes) - 1);
					$(thisElement).addClass("likeTrack");
					$(thisElement).removeClass("unlikeTrack");
				}
			}
		})
	});

	$("#trackHead").on('click', '.likeTrack', function (event) {
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
					var currentLikes = $("#trackLikes").html();
					$("#trackLikes").html(Number(currentLikes) + 1);
					$(".likeTrack").addClass("unlikeTrack");
					$(".likeTrack").removeClass("likeTrack");
				}
			}
		})
	});

	$('#trackHead').on('click', '.unlikeTrack', function (event) {
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
					var currentLikes = $("#trackLikes").html();
					$("#trackLikes").html(Number(currentLikes) - 1);
					$(".unlikeTrack").addClass("likeTrack");
					$(".unlikeTrack").removeClass("unlikeTrack");
				}
			}
		})
	});
});