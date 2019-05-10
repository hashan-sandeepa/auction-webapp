<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>

<body>
<h4>Reset your password</h4>

Hi {{$user['first_name']}},<br/><br>

We got a request to reset your MyAuction.lk password. Please click the link below to choose a new password
<br/><br/>
<a href="{{url('user/reset-password', $user['password_reset_token'])}}">Reset Password</a>
<br/><br/>
User name : <b>{{$user['username']}}</b>
<p>If you did not request a new account, please ignore this message</p>
</body>
