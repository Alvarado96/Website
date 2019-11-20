function checkDate() {
	var ok = _privateCheck();
	var submitButton = document.getElementById("signup-submit");
	submitButton.disabled = ! ok; //yes
}
function _privateCheck() {
	var year = document.getElementById("year").value;
	var msgElt = document.getElementById("errmsg");
	
	if (year == ""){
		msgElt.innerText = "Year is required and must be between 1900 and 2100";
		return  false;
	}
	
	if (isNaN(year) || year <= 1900 || year >= 2100) {
		msgElt.innerText = "Year must be between 1900 and 2100, not '" + year + "'";
		return false;
	}
	
	msgElt.innerText = "";
	return true;
}

function checkMonth() {
	var ok = _privateMonthCheck();
	var submitButton = document.getElementById("signup-submit");
	submitButton.disabled = ! ok;
}

function checkUsername() {
	var ok = _privateUsernameCheck();
	var submitButton = document.getElementById("signup-submit");
	
	submitButton.disabled = ! ok;
}

function checkPassword() {
	var ok = _privatePasswordCheck();
	var submitButton = document.getElementById("signup-submit");
	submitButton.disabled = ! ok;
}

function _privateUsernameCheck() {
	var username = document.getElementById("uid1");
	var msgElt = document.getElementById("errmsg");
	var reg = new RegExp('[0-9 ;-]+');
	
	//get the regular expression
	if(reg.test(username.value)){
		msgElt.innerText = "Invalid character for username make sure there are no spaces or numbers";
		return false;
	}
	
	if(username.value.length < 4) {
		msgElt.innerText = "Username must be at least 4 characters long";
		return false;
	}

	msgElt.innerText = "";
	return true;
}


function _privatePasswordCheck() {
	var pwd = document.getElementById("pwd1");
	var msgElt = document.getElementById("errmsg");
	
	if (pwd.value.length < 4){
		msgElt.innerText = "Password must be at least 4 characters long";
		
		return false;
	}
		
	msgElt.innerText = "";
	return true;
}

function _privateMonthCheck() {
	var group = document.getElementsByName("month");
	var d = document.getElementById("day").value;
	var msgElt = document.getElementById("errmsg");
	var year = document.getElementById("year").value;
	
	for ( var i = 0; i < group.length; i++) {
		if (group.item(i).checked) {
			if ((group.item(i).id == "month-4" || group.item(i).id == "month-6" || group.item(i).id == "month-9" || group.item(i).id == "month-11") && d > 30){
				msgElt.innerText = "Day must be between 1 and 30, not '" + d + "'";
				return false;
			}
			
			if ( year % 4 == 0 && group.item(i).id == "month-2" && d > 29) {
				msgElt.innerText = "Day must be between 1 and 29, not '" + d + "'";
				return false;
			}
			
			if ( year % 4 != 0 && group.item(i).id == "month-2" && d > 28) {
				msgElt.innerText = "Day must be between 1 and 28, not '" + d + "'";
				return false;
			}
		}
	}
	
	msgElt.innerText = "";
	return true;
}
