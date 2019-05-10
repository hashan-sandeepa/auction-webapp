function validateForm(event) {
    var passwordRegex = new RegExp("^[a-zA-Z0-9]{8,}$");

    var passElm = document.getElementById("password");
    var cnfpassElm = document.getElementById("confPassword");

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

    return true;
}