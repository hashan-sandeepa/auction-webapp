<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | Forgot Password</title>
    <link href="{{ asset('assets/css/forgot-password.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="container">
    @include('pages.header')
    <div id="content">
        <div id="form-container">
            <h3 id="heading">Forgot your password?</h3>
            <form method="POST" action="/user/forgot-password">
                {{ csrf_field() }}
                <span>Enter your email address to reset your password</span>
                <table style="width: 100%">
                    <tbody>
                    <tr>
                        <td><input type="email" id="email" name="email" required></td>
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
<script type="text/javascript">
    $(function () {
        $("#email").focus();
    });
</script>
</body>
</html>