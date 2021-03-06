$(document).ready( function () {
	var goodTitle = false;
	var goodDescription = false;
	goodTrack = false;
	goodImage = false;
	audioDivEnabled = true;
	imageDivEnabled = true;


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

		if (goodTitle && goodDescription && goodTrack && goodImage) {
			//get all the tags
			var tagString = '';
			$("#tagSection").find('.tag').each( function(event) {
				tagString = tagString + $.trim($(this).text()) + ",";
			})
			
			//build a new form input to assign tags so they are also submitted to the server
			var input = $("<input>").attr('id', 'allTags').attr('type', 'hidden').attr('name', 'allTags').val(tagString);
			$("#createForm").append($(input));

			//submit will run successfully. 
		} else {
			event.preventDefault();
			//show red for errors.
			if (!goodTitle) {
				$("#title").parent().addClass('has-error');
			}
			if (!goodDescription) {
				$("#description").parent().addClass('has-error');
			}
			if (!goodTrack) {
				$("#audioSelector").css('border', '1px solid #b9484a');
			}
			if (!goodImage) {
				$("#imageSelector").css('border', '1px solid #b9484a');
			}
			$('html, body').animate({ scrollTop: 0 }, "slow");
		}
	});
});


function _(el){
	return document.getElementById(el);
} 
//TRACK UPLOADING:
$(function() {
	$("#trackuploadbutton").click(function(event) {
	event.stopPropagation();
	var file = _("trackupload").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("trackupload", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", audioProgressHandler, false);
	ajax.addEventListener("load", audioCompleteHandler, false);
	ajax.addEventListener("error", audioErrorHandler, false);
	
	//audio validation
	if(file.type =="audio/wav" || file.type =="audio/mp3" || file.type =="audio/aac" || file.type == "audio/mpeg" || file.type == "audio/x-wav")
	{
		ajax.open("POST", "dummyPHP.php");
		ajax.send(formdata);
	}
	else {
		_("status").innerHTML = "Invalid file type";
		$("#audioGlyph").css("visibility", "visible");
		$("#audioGlyph").css("color", "red");
		$("#audioGlyph").attr("class", "glyphicon glyphicon-exclamation-sign");
	}

	return false;
});
	});
function audioProgressHandler(event){
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	//_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function audioCompleteHandler(event){
	//_("status").innerHTML = event.target.responseText;
	goodTrack = true;
	//_("progressBar").value = 0;
	$("#audioGlyph").css("visibility", "visible");
	$("#audioGlyph").attr("class", "glyphicon glyphicon-ok");
	$("#audioGlyph").css("color", "#00CC00");
	$("#audioCancelGlyph").css("visibility", "visible");
	$("#trackuploadbutton").css("visibility", "hidden");
	audioDivEnabled = false;
}
function audioErrorHandler(event){
	goodTrack = false
	_("status").innerHTML = "Upload Failed. Try Again or Select New File.";
	$("#audioGlyph").css("visibility", "visible");
	$("#audioGlyph").css("color", "red");
	$("#audioGlyph").attr("class", "glyphicon glyphicon-exclamation-sign");
}
$(function() {
$("#trackupload:file").change(function (){
	var fileName = $(this).val();
       $("#trackuploadbutton").css("visibility", "visible");
        $("#progressBar").css("visibility", "visible");
        $("#audioGlyph").css("visibility", "hidden");
        $("#audioCancelGlyph").css("visibility", "hidden");
       $("#status").html("");
       $("#audioText").html(fileName);
       if(fileName ==""){
   		$("#audioText").html("Click anywhere to select a file");
   		$("#trackuploadbutton").css("visibility", "hidden");
    	$("#progressBar").css("visibility", "hidden");
       }
     });
});
$(function() {
	$("#audioSelector").click(function(event) {
		if(audioDivEnabled)
		{
			$(this).css('border', '1px solid #ccc');
			$(this).siblings('#trackupload').click();
		}
	});
});
$(function() {
	$("#audioCancelGlyph").click(function(event) {
		event.stopPropagation();
		reset();
	});
});
//resets file upload field
function reset(){
	audioDivEnabled = true;
	goodTrack = false;
	_("progressBar").value = 0;
	$("#audioText").html("Click anywhere to select a file");
	 $("#trackuploadbutton").css("visibility", "hidden");
    $("#progressBar").css("visibility", "hidden");
    $("#audioGlyph").css("visibility", "hidden");
    $("#audioCancelGlyph").css("visibility", "hidden");
    $("#status").html("");
    $("#trackupload:file").val("");
}


//PICTURE VALIDATION
$(function() {
	$("#imageUploadButton").click(function(event) {
	event.stopPropagation();
	var file = _("imageupload").files[0];
	//alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("imageupload", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", imageProgressHandler, false);
	ajax.addEventListener("load", imageCompleteHandler, false);
	ajax.addEventListener("error", imageErrorHandler, false);
	
	//audio validation
	if(file.type =="image/png" || file.type =="image/jpg" || file.type =="image/jpeg")
	{
		ajax.open("POST", "dummyPHP.php");
		ajax.send(formdata);
	}
	else {
		_("imageStatus").innerHTML = "Invalid file type";
		$("#imageGlyph").css("visibility", "visible");
		$("#imageGlyph").css("color", "red");
		$("#imageGlyph").attr("class", "glyphicon glyphicon-exclamation-sign");
	}

	return false;
});
	});
function imageProgressHandler(event){
	var percent = (event.loaded / event.total) * 100;
	_("imageProgressBar").value = Math.round(percent);
}
function imageCompleteHandler(event){
	goodImage = true;
	$("#imageGlyph").css("visibility", "visible");
	$("#imageGlyph").attr("class", "glyphicon glyphicon-ok");
	$("#imageGlyph").css("color", "#00CC00");
	$("#imageCancelGlyph").css("visibility", "visible");
	$("#imageUploadButton").css("visibility", "hidden");
	imageDivEnabled = false;
}
function imageErrorHandler(event){
	goodImage = false;
	_("imageStatus").innerHTML = "Upload Failed. Try Again or Select New File.";
	$("#imageGlyph").css("visibility", "visible");
	$("#imageGlyph").css("color", "red");
	$("#imageGlyph").attr("class", "glyphicon glyphicon-exclamation-sign");
}
$(function() {
$("#imageupload:file").change(function (){
	var fileName = $(this).val();
       $("#imageUploadButton").css("visibility", "visible");
        $("#imageProgressBar").css("visibility", "visible");
        $("#imageGlyph").css("visibility", "hidden");
        $("#imageCancelGlyph").css("visibility", "hidden");
       $("#imageStatus").html("");
       $("#imageText").html(fileName);
       if(fileName ==""){
   		$("#imageText").html("Click anywhere to select a file");
   		$("#imageUploadButton").css("visibility", "hidden");
    	$("#imageProgressBar").css("visibility", "hidden");
       }
     });
});
$(function() {
	$("#imageSelector").click(function(event) {
		if(imageDivEnabled)
		{
			$(this).css('border', '1px solid #ccc');
			$(this).siblings('#imageupload').click();
		}
	});
});
$(function() {
	$("#imageCancelGlyph").click(function(event) {
		event.stopPropagation();
		imageReset();
	});
});
//resets file upload field
function imageReset(){
	imageDivEnabled = true;
	goodImage = false;
	_("imageProgressBar").value = 0;
	$("#imageText").html("Click anywhere to select a file");
	 $("#imageUploadButton").css("visibility", "hidden");
    $("#imageProgressBar").css("visibility", "hidden");
    $("#imageGlyph").css("visibility", "hidden");
    $("#imageCancelGlyph").css("visibility", "hidden");
    $("#imageStatus").html("");
   $("#imageupload:file").val("");
}
