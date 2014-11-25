var isEmail = false;
var doesMatch = false;
var isUsername = false;
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

$("#email").keyup(function(event){
	if(isValidEmailAddress($("#email").val()))
	{
		$("#email").parent().removeClass("has-warning");
		$("#email").parent().removeClass("has-error");
		$("#email").parent().addClass("has-success");
		isEmail = true;
	}
	else
	{
		$("#email").parent().removeClass("has-error");
		$("#email").parent().removeClass("has-success");
		$("#email").parent().addClass("has-warning");
		isEmail = false;
	}
}).blur(function(event){
	if(isValidEmailAddress($("#email").val()))
	{
		$("#email").parent().removeClass("has-warning");
		$("#email").parent().removeClass("has-error");
		$("#email").parent().addClass("has-success");
		isEmail = true;
	}
	else
	{
		$("#email").parent().removeClass("has-error");
		$("#email").parent().removeClass("has-success");
		$("#email").parent().addClass("has-error");
		isEmail = false;
	}
});

$("#secondpass").keyup(function(){
	if($("#firstpass").val()!="")//if there is a value for the first password
	{
		if($("#secondpass").val()==$("#firstpass").val())//if the passwords match then success
		{
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().addClass("has-success");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().removeClass("has-success");
			$("#secondpass").parent().addClass("has-warning");
			
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().removeClass("has-success");
			$("#firstpass").parent().addClass("has-warning");
			doesMatch = false;
		}
	}
	if($("#firstpass").val() == "" && $("#secondpass").val() == "")
	{
		$("#firstpass").parent().removeClass("has-error");
		$("#firstpass").parent().removeClass("has-success");
		$("#firstpass").parent().removeClass("has-warning");
		
		$("#secondpass").parent().removeClass("has-error");
		$("#secondpass").parent().removeClass("has-success");
		$("#secondpass").parent().removeClass("has-warning");
		doesMatch = false;
	}
}).blur(function(){
	if($("#firstpass").val()!="")//if there is a value for the first password
	{
		if($("#secondpass").val()==$("#firstpass").val())//if the passwords match then success
		{
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().addClass("has-success");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondpass").parent().removeClass("has-success");
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().addClass("has-error");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-success");
			$("#firstpass").parent().addClass("has-error");
			doesMatch = false;
		}
	}
});

$("#firstpass").keyup(function(){
	if($("#secondpass").val()!="")//if there is a value for the second password
	{
		if($("#secondpass").val()==$("#firstpass").val())//if the passwords match then success
		{
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().addClass("has-success");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().removeClass("has-success");
			$("#secondpass").parent().addClass("has-warning");
			
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().removeClass("has-success");
			$("#firstpass").parent().addClass("has-warning");
			doesMatch = false;
		}
	}
}).blur(function(){
	if($("#secondpass").val()!="")//if there is a value for the second password
	{
		if($("#secondpass").val()==$("#firstpass").val())//if the passwords match then success
		{
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().removeClass("has-error");
			$("#secondpass").parent().addClass("has-success");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-error");
			$("#firstpass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondpass").parent().removeClass("has-success");
			$("#secondpass").parent().removeClass("has-warning");
			$("#secondpass").parent().addClass("has-error");
			
			$("#firstpass").parent().removeClass("has-warning");
			$("#firstpass").parent().removeClass("has-success");
			$("#firstpass").parent().addClass("has-error");
			doesMatch = false;
		}
	}
});

$("#username").keyup(function(){
	if($("#username").val())
	{
		$("#username").parent().removeClass("has-warning");
		$("#username").parent().removeClass("has-error");
		$("#username").parent().addClass("has-success");
		isUsername = true;
	}
	else
	{
		$("#username").parent().removeClass("has-error");
		$("#username").parent().removeClass("has-success");
		$("#username").parent().addClass("has-warning");
	}
}).blur(function(){
	if($("#username").val())
	{
		$("#username").parent().removeClass("has-warning");
		$("#username").parent().removeClass("has-error");
		$("#username").parent().addClass("has-success");
		isUsername = true;
	}
	else
	{
		$("#username").parent().removeClass("has-warning");
		$("#userName").parent().removeClass("has-success");
		$("#username").parent().addClass("has-error");
	}
});


$("#submit").click(function(event){
	if(doesMatch && isEmail && isUsername)
	{
		alert("sign up successful"); //this will be removed once back end is in place
	}
	else
	{
		event.preventDefault();
		if (!isEmail) {
			$("#email").parent().addClass('has-error');
		} 
		if (!isUsername) {
			$("#username").parent().addClass('has-error');
		}
		if (!doesMatch) {
			$("#firstpass").parent().addClass('has-error');
			$("#secondpass").parent().addClass('has-error');
		}
	}
});