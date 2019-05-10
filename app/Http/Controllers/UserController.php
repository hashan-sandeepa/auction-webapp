<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Mail\VerificationMail;
use App\User;
use Auth;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Image;
use Log;
use Mail;
use Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getLoginPage()
    {
        return view('pages/login');
    }

    public function getRegistrationPage()
    {
        return view('pages/registration');
    }

    public function getProfilePage()
    {
        return view('pages/profile');
    }


    public function registerUser(Request $request)
    {
        $firstName = $request->firstName;
        Log::info('firstName :' . $firstName);

        //Retrieve the name input field
        $lastName = $request->lastName;
        Log::info('lastName : ' . $lastName);

        //Retrieve the username input field
        $contactNumber = $request->contactNumber;
        Log::info('contactNumber : ' . $contactNumber);

        //Retrieve the username input field
        $email = $request->email;
        Log::info('email : ' . $email);

        //Retrieve the username input field
        $userName = $request->userName;
        Log::info('userName : ' . $userName);

        //Retrieve the password input field
        $password = $request->password;
        Log::info('password : ' . $password);

        //Retrieve the password input field
        $isAgree = $request->isAgree;
        Log::info('isAgree : ' . $isAgree);

        Log::info('validating...');

        $v = Validator::make($request->all(), [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'contactNumber' => array(
                'required',
                'unique:user,contact_no',
                'regex:/^[0-9\+]{3,16}$/'
            ),
            'email' => 'required|email|max:255|unique:user',
            'userName' => 'required|max:255|unique:user,username',
            'password' => 'required|confirmed|min:10|max:128'
        ], [
            'contactNumber.regex' => 'Contact Number is invalid: Please enter a valid Contact Number.',
        ]);

        Log::info('validate finished...');

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return redirect()->route('user.registration')->with('error', $error)->withInput(Input::except('password'));
        } else {
            try {
                $code = str_replace('-', '', (string)Str::uuid());
                Log::info('code :' . $code);

                $expireHours = env("VERIFICATION_EXPIRE_HOURS", "24");
                Log::info('Verification code will be expired by :' . $expireHours);

                $verificationExpire = date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $expireHours)));
                Log::info('Verification code will be expired on :' . $verificationExpire);

                //insert user data
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'contact_no' => $contactNumber,
                    'username' => $userName,
                    'email' => $email,
                    'verification_code' => $code,
                    'verification_expire' => $verificationExpire,
                    'password' => $password,
                ]);

                //send verification email
                Mail::to($email)->send(new VerificationMail($user));

            } catch (QueryException $ex) {
                Log::error('error :' . $ex->getMessage());
                return redirect()->route('user.registration')->with('error', 'processing error...')->withInput(Input::except('password'));
            }
            return redirect()->route('home')->with('message', 'Registration completed successfully. Please check your registered email for email verification');
        }
    }

    public function editProfile(Request $request)
    {
        $userId = Auth::id();
        Log::info('User ID :' . $userId);

        $firstName = $request->firstName;
        Log::info('firstName :' . $firstName);

        $lastName = $request->lastName;
        Log::info('lastName : ' . $lastName);

        $contactNumber = $request->contactNumber;
        Log::info('contactNumber : ' . $contactNumber);


        $v = Validator::make($request->all(), [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'contactNumber' => array(
                'required',
                'unique:user,contact_no,' . $userId,
                'regex:/^[0-9\+]{3,16}$/'
            ),
            'profilePicture' => array(
                'file',
                'image',
                'mimes:jpg,jpeg,png,bmp,gif,webp',
                'max:2048'
            ),
        ], [
            'contactNumber.regex' => 'Contact Number is invalid: Please enter a valid Contact Number.',
            'profilePicture.max' => 'Your profile picture is too big. Please upload a picture smaller than 2MB',
        ]);

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return redirect()->route('user.profile.page')->with('error', $error);
        } else {
            $user = Auth::user();
            if (isset($user)) {
                $user->first_name = $firstName;
                $user->last_name = $lastName;
                $user->contact_no = $contactNumber;

                $currentPass = $request->get('currentPass');
                if (isset($currentPass)) {
                    if (!(Hash::check($currentPass, Auth::user()->password))) {
                        // The passwords matches
                        return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
                    }

                    if (strcmp($currentPass, $request->get('newPassword')) == 0) {
                        //Current password and new password are same
                        return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
                    }
                    $v = Validator::make($request->all(), [
                        'newPassword' => 'required|confirmed|min:10|max:128'
                    ]);

                    if ($v->fails()) {
                        $error = $v->errors()->first();
                        Log::error('validation error :' . $error);
                        return redirect()->route('user.profile.page')->with('error', $error);
                    } else {
                        //Change Password
                        $user->password = bcrypt($request->get('newPassword'));
                    }
                }

                $file = $request->file('profilePicture');
                if (isset($file)) {
                    // generate a new filename. getClientOriginalExtension() for the file extension
                    $filename = 'profile-photo.' . $file->getClientOriginalExtension();
                    Log::info('File Name :' . $filename);

                    $profilePicDir = env("PROFILE_PICTURE_UPLOAD_DIR", "profiles");
                    Log::info('Root Dir :' . $profilePicDir);
                    Log::info('Upload Dir :' . $profilePicDir . '/' . $userId);

                    // save to storage/app/profiles as the new $filename
                    $path = $file->storeAs($profilePicDir . '/' . $userId, $filename);

                    $user->profile_img_path = $path;
                }
                $user->save();
                return redirect()->route('user.profile.page')->with('message', 'Your profile has been updated!');
            } else {
                return redirect()->route('home')->with('error', "You have no permission to perform this operation");
            }
        }
    }

    public function getProfileImage()
    {
        $imgPath = null;
        $user = Auth::user();
        if (isset($user) && $user->profile_img_path != null) {
            $imgPath = storage_path('app' . '/' . $user->profile_img_path);
        }

        if (!isset($user) || !file_exists($imgPath) || $user->profile_img_path == null) {
            $profilePicDir = env("PROFILE_PICTURE_UPLOAD_DIR", "profiles");
            $imgPath = storage_path('app' . '/' . $profilePicDir . '/' . 'avatar.jpg');
        }

        Log::info('Image Path :' . $imgPath);
        return Image::make($imgPath)->response();
    }

    public function verifyUser($code)
    {
        Log::info('Code - ' . $code);
        $user = User::where('verification_code', $code)->first();
        if (isset($user)) {
            if (!$user->is_verified) {
                $user->is_verified = 1;
                $user->save();
                return redirect()->route('user.login.page')->with('message', 'Your e-mail is verified. You can login now.');
            } else {
                return redirect()->route('user.login.page')->with('message', 'Your e-mail is already verified. You can login now.');
            }
        } else {
            return redirect()->route('home')->with('warning', "Sorry your email cannot be identified.");
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(array('userName' => $request->userName, 'password' => $request->password, 'is_verified' => 1))) {
            return redirect()->route('home');
        } else {
            return redirect()->route('user.login.page')->with('error', "You have entered an invalid username or password!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getForgotPassPage()
    {
        return view('pages/fogot-password');
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        Log::info('Email :' . $email);

        $v = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:user'
        ], [
            'email.exists' => 'We cannot find an account with email you entered'
        ]);

        Log::info('validate finished...');

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return redirect()->route('user.forgot.password')->with('error', $error);
        } else {
            $user = User::where("email", "=", $email)->first();

            $resetToken = str_replace('-', '', (string)Str::uuid());
            Log::info('Reset Token :' . $resetToken);
            $user->password_reset_token = $resetToken;
            $user->save();

            //send reset password email
            Mail::to($email)->send(new ResetPasswordMail($user));

            return redirect()->route('user.login.page')->with('message', 'We\'ve just sent you an email to reset your password.');
        }
    }

    public function getResetPasswordPage($token)
    {
        Log::info('Token :' . $token);
        $user = User::where("password_reset_token", "=", $token)->first();
        if (isset($user)) {
            return view('pages/reset-password', ["token" => $token, "name" => $user->first_name]);
        } else {
            return redirect()->route('user.login.page')->with('error', 'Invalid password reset link');
        }
    }

    public function resetPassword(Request $request)
    {
        $v = Validator::make($request->all(), [
            'token' => 'required|max:36|exists:user,password_reset_token',
            'password' => 'required|confirmed|min:10|max:128'
        ], [
            'token.exists' => 'Invalid Request',
        ]);

        Log::info('validate finished...');

        if ($v->fails()) {
            $error = $v->errors()->first();
            Log::error('validation error :' . $error);
            return redirect()->back()->with('error', $error);
        } else {
            $password = $request->password;

            $token = $request->token;
            Log::info('Token :' . $token);

            $user = User::where("password_reset_token", "=", $token)->first();
            $user->password = $password;
            $user->password_reset_token = null;
            $user->save();

            return redirect()->route('user.login.page')->with('message', 'Password reset succeeded. Please login to continue');
        }
    }
}
