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

$("#secondPass").keyup(function(){
	if($("#firstPass").val()!="")//if there is a value for the first password
	{
		if($("#secondPass").val()==$("#firstPass").val())//if the passwords match then success
		{
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().addClass("has-success");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().removeClass("has-success");
			$("#secondPass").parent().addClass("has-warning");
			
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().removeClass("has-success");
			$("#firstPass").parent().addClass("has-warning");
			doesMatch = false;
		}
	}
	if($("#firstPass").val()==""&&$("#secondPass").val()=="")
	{
		$("#firstPass").parent().removeClass("has-error");
		$("#firstPass").parent().removeClass("has-success");
		$("#firstPass").parent().removeClass("has-warning");
		
		$("#secondPass").parent().removeClass("has-error");
		$("#secondPass").parent().removeClass("has-success");
		$("#secondPass").parent().removeClass("has-warning");
		doesMatch = false;
	}
}).blur(function(){
	if($("#firstPass").val()!="")//if there is a value for the first password
	{
		if($("#secondPass").val()==$("#firstPass").val())//if the passwords match then success
		{
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().addClass("has-success");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondPass").parent().removeClass("has-success");
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().addClass("has-error");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-success");
			$("#firstPass").parent().addClass("has-error");
			doesMatch = false;
		}
	}
});

$("#firstPass").keyup(function(){
	if($("#secondPass").val()!="")//if there is a value for the second password
	{
		if($("#secondPass").val()==$("#firstPass").val())//if the passwords match then success
		{
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().addClass("has-success");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().removeClass("has-success");
			$("#secondPass").parent().addClass("has-warning");
			
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().removeClass("has-success");
			$("#firstPass").parent().addClass("has-warning");
			doesMatch = false;
		}
	}
}).blur(function(){
	if($("#secondPass").val()!="")//if there is a value for the second password
	{
		if($("#secondPass").val()==$("#firstPass").val())//if the passwords match then success
		{
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().removeClass("has-error");
			$("#secondPass").parent().addClass("has-success");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-error");
			$("#firstPass").parent().addClass("has-success");
			doesMatch = true;
		}
		else
		{
			$("#secondPass").parent().removeClass("has-success");
			$("#secondPass").parent().removeClass("has-warning");
			$("#secondPass").parent().addClass("has-error");
			
			$("#firstPass").parent().removeClass("has-warning");
			$("#firstPass").parent().removeClass("has-success");
			$("#firstPass").parent().addClass("has-error");
			doesMatch = false;
		}
	}
});

$("#userName").keyup(function(){
	if($("#userName").val())
	{
		$("#userName").parent().removeClass("has-warning");
		$("#userName").parent().removeClass("has-error");
		$("#userName").parent().addClass("has-success");
		isUsername = true;
	}
	else
	{
		$("#userName").parent().removeClass("has-error");
		$("#userName").parent().removeClass("has-success");
		$("#userName").parent().addClass("has-warning");
	}
}).blur(function(){
	if($("#userName").val())
	{
		$("#userName").parent().removeClass("has-warning");
		$("#userName").parent().removeClass("has-error");
		$("#userName").parent().addClass("has-success");
		isUsername = true;
	}
	else
	{
		$("#userName").parent().removeClass("has-warning");
		$("#userName").parent().removeClass("has-success");
		$("#userName").parent().addClass("has-error");
	}
});


$("#submit").click(function(event){
	if(doesMatch && isEmail && isUsername)
	{
		alert("sign up successful");
	}
	else
	{
		event.preventDefault();
		alert("something is wrong");
	}
});