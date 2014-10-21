$(document).ready(function() {

	$("#editPicture").hide();

	$("#profilePictureContainer").mouseover( function() {
		$("#editPicture").show();
	});
	$("#profilePictureContainer").mouseout( function() {
		$("#editPicture").hide();
	});

	$("#editPicture").click( function() {

		$("#fileDialog").click();
	});

	$("#fileDialog").change( function() {
		var file_data = $("#fileDialog").prop("files")[0];   // Getting the properties of file from file field
		var form_data = new FormData();                  // Creating object of FormData class
		form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data
		form_data.append("_token", $("input[name='_token']").val())                 // Adding extra parameters to form_data
		$.ajax({
            url: "dummyPHP.php",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         // Setting the data attribute of ajax with file_data
            type: 'post',
            success: function(data) {    //wont work until we get the backend going which saves the file and returns its path
            	$("#profilePicture").attr('src', data);
            }
      	});
	});
});