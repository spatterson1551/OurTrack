function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

var isEmail = false;
var isPass = false;

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

$("#pass").keyup(function(){
	if(!($("#pass").val()))
	{
		$("#pass").parent().removeClass("has-error");
		$("#pass").parent().removeClass("has-success");
		$("#pass").parent().addClass("has-warning");
		
		isPass = false;
	}
	else
	{
		isPass = true;
	}
}).blur(function(){
	if(!($("#pass").val()))
	{
		$("#pass").parent().removeClass("has-warning");
		$("#pass").parent().removeClass("has-success");
		$("#pass").parent().addClass("has-error");
		isPass = false;
	}
	else
	{
		isPass = true;
	}
}).focus(function(){
	$("#pass").parent().removeClass("has-warning");
	$("#pass").parent().removeClass("has-success");
	$("#pass").parent().removeClass("has-error");
});

$("#submit").click(function(event){
	if(isEmail && isPass)
	{
		alert("sign up successful"); //this will be removed in the future once the backend is there
	}
	else
	{
		event.preventDefault();
		if (!isEmail) {
			$("#email").parent().addClass('has-error');
		} 
		if (!isPass) {
			$("#pass").parent().addClass('has-error');
		}
	}
});