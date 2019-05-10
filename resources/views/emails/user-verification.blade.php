<!DOCTYPE html>
<html>
<head>
    <title>Welcome to MyAuction.lk</title>
</head>

<body>
<h4>Please confirm your email address</h4>

Dear {{$user['first_name']}},<br/><br>

You have been successfully registered with MyAuction.lk. Please click the below link to
activate your account and note that you can activate the account within 48 hours from the time this email is received.
<br/><br/>
<a href="{{url('user/verify', $user['verification_code'])}}">Activate Account</a>
<br/>
<p>If you did not request a new account, please ignore this message</p>
</body>
