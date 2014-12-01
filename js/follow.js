$(document).ready(function() {

	$("#follow").click(function() {
		data = {
			id: $(this).val(),
			_token: $("input[name='_token']").val()
		}
		$.ajax({
			type: 'POST',
			url: 'http://localhost:8888/laravelProjects/shamelessPlug/public/users/follow',
			data: data,
			success: function(data) {
				if (data == 1) {
					$("#follow").html('FOLLOWING');
					$("#follow").attr('disabled', true);
				} else if (data == 0) {
					$("#loginModal").modal('show');
				}
			}
		})
	});
});