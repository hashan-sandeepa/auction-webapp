<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | Forgot Password</title>
    <link href="{{ asset('assets/css/reset-password.css') }}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/reset-password.js') }}"></script>
</head>
<body>
<div id="container">
    @include('pages.header')
    <div id="content">
        <div id="form-container">
            <h3 id="heading">Reset your password</h3>
            <form method="POST" action="/user/reset-password" onsubmit="return validateForm(event);">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{$token}}">
                <span>Hello <b>{{$name}}</b>, Please enter your password below to reset.</span><br><br>
                <table style="width: 100%">
                    <tbody>
                    <tr>
                        <td><input type="password" id="password" name="password" placeholder="New Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="pass-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td><input type="password" id="confPassword" name="password_confirmation"
                                   placeholder="Confirm Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="confpass-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='/user/login'">
                                Back to Login
                            </button>
                            <button type="submit" class="btn btn-orange">Reset Password</button>
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