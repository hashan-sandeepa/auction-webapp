function triggerFileInput(){
	document.getElementById("img-file-input").click();
}

function loadImg(event){
	var img = event.target.files[0];
	var reader = new FileReader();

	var imgtag = document.getElementById("user-img");
	imgtag.title = img.name;
	
	reader.onload = function(event) {
		imgtag.src = event.target.result;
	};

	reader.readAsDataURL(img);
}

function validateForm(event) {
    //event.preventDefault();

    var alphaRegex = new RegExp("^[a-zA-Z]+$");
    var phoneRegex = new RegExp("^[0-9\\+]{3,16}$");
    var passwordRegex = new RegExp("^[a-zA-Z0-9]{8,}$");

    var fnElm = document.getElementById("firstName");
    var lnElm = document.getElementById("lastName");
    var cnElm = document.getElementById("contactNumber");
    var currentPassElm = document.getElementById("currentPass");
    var newPassElm = document.getElementById("newPass");
    var cnfpassElm = document.getElementById("confirmPass");

    if (!alphaRegex.test(fnElm.value)) {
        document.getElementById("fn-msg").innerHTML = '*Alphabetic Only!';
        fnElm.focus();
        return false;
    } else {
        document.getElementById("fn-msg").innerHTML = '';
    }

    if (!alphaRegex.test(lnElm.value)) {
        document.getElementById("ln-msg").innerHTML = '*Alphabetic Only!';
        lnElm.focus();
        return false;
    } else {
        document.getElementById("ln-msg").innerHTML = '';
    }

    if (!phoneRegex.test(cnElm.value)) {
        document.getElementById("cn-msg").innerHTML = '*Numbers & "+" Sign only! | Min - 3 Max - 16';
        cnElm.focus();
        return false;
    } else {
        document.getElementById("cn-msg").innerHTML = '';
    }

    if (currentPassElm.value){
        if (!passwordRegex.test(newPassElm.value)) {
            document.getElementById("pass-msg").innerHTML = '*Minimum eight characters, at least one letter and one number';
            newPassElm.focus();
            return false;
        } else {
            document.getElementById("pass-msg").innerHTML = '';
        }

        if (newPassElm.value !== cnfpassElm.value) {
            document.getElementById("confpass-msg").innerHTML = '*Confirm password must same as the password';
            cnfpassElm.focus();
            return false;
        } else {
            document.getElementById("confpass-msg").innerHTML = '';
        }
	}


    if (!isAgreeElm.checked) {
        document.getElementById("isAgree-msg").innerHTML = '*Please read & agree to the Terms & Conditions!';
        isAgreeElm.focus();
        return false;
    } else {
        document.getElementById("isAgree-msg").innerHTML = '';
    }
    return true;
}