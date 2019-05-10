function validateForm(event) {
    //event.preventDefault();

    var alphaRegex = new RegExp("^[a-zA-Z]+$");
    var phoneRegex = new RegExp("^[0-9\\+]{3,16}$");
    var passwordRegex = new RegExp("^[a-zA-Z0-9]{8,}$");

    var fnElm = document.getElementById("firstName");
    var lnElm = document.getElementById("lastName");
    var cnElm = document.getElementById("contactNumber");
    var passElm = document.getElementById("password");
    var cnfpassElm = document.getElementById("confPassword");
    var isAgreeElm = document.getElementById("isAgree");

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

    if (!passwordRegex.test(passElm.value)) {
        document.getElementById("pass-msg").innerHTML = '*Minimum eight characters, at least one letter and one number';
        passElm.focus();
        return false;
    } else {
        document.getElementById("pass-msg").innerHTML = '';
    }

    if (passElm.value !== cnfpassElm.value) {
        document.getElementById("confpass-msg").innerHTML = '*Confirm password must same as the password';
        cnfpassElm.focus();
        return false;
    } else {
        document.getElementById("confpass-msg").innerHTML = '';
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