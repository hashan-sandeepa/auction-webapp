<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | LogIn</title>
    <link href="{{ asset('assets/css/login.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div id="container">
    @include('pages.header')
    <div id="content">
        <div id="form-container">
            <h3 id="heading">Login</h3>
            <i id="user-avatar" class="far fa-user-circle"></i>
            <form method="POST" action="/user/login">
                {{ csrf_field() }}
                <table style="width: 100%">
                    <tbody>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="userName" name="userName" placeholder="User Name" required></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a id="fogot-pass-link" href="/user/forgot-password">Forgot Password?</a></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='/'">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-orange">Login</button>
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