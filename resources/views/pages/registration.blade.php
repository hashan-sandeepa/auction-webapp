<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | Register</title>
    <link href="{{ asset('assets/css/registration.css') }}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/registration.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="container">
    @include('pages.header')
    <div id="content">
        <div id="form-container">
            <h3 id="heading">Register</h3>
            <i id="user-avatar" class="far fa-user-circle"></i>
            <form method="POST" action="/user/register" onsubmit="return validateForm(event);">
                {{ csrf_field() }}
                <table style="width: 92%">
                    <tbody>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="firstName" name="firstName" placeholder="First Name" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="fn-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="lastName" name="lastName" placeholder="Last Name" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="ln-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required" placeholder="Country"></td>
                        <td>
                            <select id="country" name="country" required>
                                <option value="0">Select your country</option>
                                <option value="1">Sri Lanka</option>
                                <option value="2">United State</option>
                                <option value="3">Australia</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="contactNumber" name="contactNumber" placeholder="Contact Number"
                                   required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="cn-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="email" id="email" name="email" placeholder="Email" required></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="userName" name="userName" placeholder="User Name" required></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="pass-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="confPassword" name="password_confirmation" placeholder="Confirm Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="confpass-msg" class="error-msg"></td>
                    </tr>
                    </tbody>
                </table>
                <div id="captchaContainer" class="input-group">
                    <div class="g-recaptcha" data-sitekey="6LcUPGgUAAAAAIZQGPaJ-ExesW1F4OaBchwyQIjm"></div>
                </div>

                <table>
                    <tbody>
                    <tr>
                        <td colspan="2"><input id="isAgree" type="checkbox" name="isAgree" value="1"> I have read and
                            agree to the <a href="#">Terms & Conditions</a></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="isAgree-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-orange">Create Account</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
    <footer>
        Copyright © 2018 All rights reserved
    </footer>
</div>
</body>
</html>
