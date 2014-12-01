$(document).ready(function() {

	$("#follow").click(function() {
		data = {
			id: $(this).val()
			//_token: $("input[name='_token']").val()
		}
		$.ajax({
			type: 'POST',
			url: 'follow.php',
			data: data,
			success: function(data) {
				if (data == 'valid') {
					$("#follow").html('FOLLOWING');
					$("#follow").attr('disabled', true);
				} else if (data == 'invalid') {
					$("#loginModal").modal('show');
				}
			}
		})
	});
});