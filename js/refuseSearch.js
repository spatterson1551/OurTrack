$(document).ready( function () {

	$("#searchForm").submit( function(event) {

		var searchInput = $("#searchInput").val();

		if (searchInput == '') {
			event.preventDefault();
		}
	});




});