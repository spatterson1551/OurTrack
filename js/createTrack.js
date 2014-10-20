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
		}
	});
});