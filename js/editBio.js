$(document).ready(function() {

	$("#saveBio").click(function() {

		data = {
			bio: $("#bioContent").text(),
		}

		$.ajax({
			type: 'POST',
			url: 'dummyPHP.php', 
			data: data,
			success: function(data) { //event wont be called until back end in place, then the modal will be hid and the bio updated automatically.
				$("#userBio").html(data);
				$("#bioModal").modal('hide');
			}
		})
	});
});