$(document).ready( function () {
	var goodTitle = false;
	var goodDescription = false;
	var goodCategory = false;

	$("#title").blur( function(event) {
		if ($(this).val()) {   //the value isnt empty so there is some text NOTE: $(this) refers to the element which the event listener is attache to, i.e ("#title")
			titleText = $(this).val();
			goodTitle = true;
			$(this).parent().removeClass('has-error');
		} else {
			goodTitle = false;
			$(this).parent().addClass('has-error');
		}
	});

	$('#title').keyup(function(event) {
		if (!$(this).val()) {
			$(this).parent().addClass('has-error');
		} else {
			$(this).parent().removeClass('has-error');
		}
	});

	$("#description").blur( function(event) {
		if ($(this).val()) { //the value isnt empty so its valid input
			descriptionText = $(this).val();
			goodDescription = true;
		} else {
			goodDescription = false;
		}
	});

	$('#description').keyup(function(event) {
		if (!$(this).val()) {
			$(this).parent().addClass('has-error');
		} else {
			$(this).parent().removeClass('has-error');
		}
	});

	$("#category").blur( function(event) {
		if ($("#category option:selected").text() == "Select A Category") { //no category selected yet.
			goodCategory = false;
			$(this).parent().addClass('has-error');
		} else {
			categoryText = $("#category option:selected").text();
			goodCategory = true;
			$(this).parent().removeClass('has-error');
		}
	});

	$("#category").change( function(event) {
		if ($("#category option:selected").text() != "Select A Category") {
			$(this).parent().removeClass('has-error');
		}
	})

	$("#tags").on("keydown", function(event) {
		if (event.which == 13) { //13 is keyCode for enter
			event.preventDefault();
			var tag = $(this).val();
			var newTag = $("#tagSection").append('<div class="tag">'+tag+'&nbsp;<span class="glyphicon glyphicon-remove removeTag"></span></div>');
			$(this).val('');

			newTag.find(".removeTag").click( function(event) { //have to add the listener in here, cant do when document ready because it doesnt exist yet.
				$(this).parent().remove();
			})
		}
	});


	$("#submit").click( function(event) {

		if (goodTitle && goodDescription && goodCategory) {
			//get all the tags
			var tagArray = [];
			$("#tagSection").find('.tag').each( function(event) {
				tagArray.push($.trim($(this).text()));
			})
			
			event.preventDefault();
			alert("submit Successful");
		} else {
			event.preventDefault();
			//show red for errors.
			if (!goodTitle) {
				$("#title").parent().addClass('has-error');
			}
			if (!goodDescription) {
				$("#description").parent().addClass('has-error');
			}
			if (!goodCategory) {
				$("#category").parent().addClass('has-error');
			}
			$('html, body').animate({ scrollTop: 0 }, "slow");
		}
	});
});


//FILE UPLOADING
function _(el){
	return document.getElementById(el);
} 
function uploadFile(){
	var file = _("trackupload").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	
	if(file.type =="audio/wav" || file.type =="audio/mp3")
	{
		ajax.open("POST", "dummyPHP.php");
		ajax.send(formdata);
	}
	else validationHandler();
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	//_("progressBar").value = 0;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
function validationHandler(){
	_("status").innerHTML = "Invalid file type";
}