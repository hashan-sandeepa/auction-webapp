<!DOCTYPE html>
<html>
<head>
    <title>MyAuction | My Profile</title>
    <link href="{{ asset('assets/css/profile.css') }}" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/profile.js') }}"></script>
</head>
<body>
<div id="container">
    @include('pages.header')
    <div id="content">
        <div id="form-container">
            <h3 id="heading">My Profile</h3>
            {{--<a href="javascript:triggerFileInput();" id="user-avatar" class="far fa-user-circle"></a>--}}
            <img id="user-img" src="/user/my/profile/image" onclick="triggerFileInput();">
            <div id="acc-info">
                <div id="userName">@if (Auth::check()){{Auth::user()->username}}@endif</div>
                <div>@if (Auth::check()){{Auth::user()->email}}@endif</div>
            </div>
            <form method="POST" action="/user/my/profile" onsubmit="return validateForm();" enctype="multipart/form-data">
                <input id="img-file-input" type="file" name="profilePicture" onchange="loadImg(event);" accept="image/x-png,image/gif,image/jpeg">
                {{ csrf_field() }}
                <table style="width: 98%">
                    <tbody>
                    <tr>
                        <th colspan="2" class="sub-head">General Info</th>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="firstName" name="firstName" placeholder="First Name" value="@if (Auth::check()){{Auth::user()->first_name}}@endif"
                                   required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="fn-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="lastName" name="lastName" placeholder="Last Name" value="@if (Auth::check()){{Auth::user()->last_name}}@endif"
                                   required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="ln-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="text" id="contactNumber" name="contactNumber" placeholder="Contact Number"
                                   value="@if (Auth::check()){{Auth::user()->contact_no}}@endif" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="cn-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="sub-head">Change Password</th>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="currentPass" name="currentPass" placeholder="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="newPass" name="newPassword" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="pass-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td class="required"></td>
                        <td><input type="password" id="confirmPass" name="newPassword_confirmation" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" id="confpass-msg" class="error-msg"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='/'">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-orange">Save</button>
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
    <!--includeHTML();-->
</script>
</body>
</html>
