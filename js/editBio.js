$(document).ready(function() {

	$("#saveBio").click(function() {
		data = {
			bio: $("#bioContent").val(),
		}
		$.ajax({
			type: 'POST',
			url: 'some php script in the future',
			data: data,
			success: function(data) {
				$("#userBio").html(data);
				$("#bioModal").modal('hide');
			}
		})
	});
});