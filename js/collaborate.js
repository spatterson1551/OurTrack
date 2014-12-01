$(document).ready(function() {

	$("#collaborate").click(function() {
		data = {
			id: $(this).val(),
			//_token: $("input[name='_token']").val()
		}
		$.ajax({
			type: 'POST',
			url: 'collaborate.php',
			data: data,
			success: function(data) {
				if (data == 'valid') {
					$("#collaborate").html('COLLABORATOR');
					$("#collaborate").attr('disabled', true);
				} else if (data == 'invalid') {
					$("#loginModal").modal('show');
				}
			}
		})
	});
});