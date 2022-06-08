<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class WebsiteController extends Controller
{
    public function index(){
        return view('home');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function login(){
        return view('login');
    }

    public function registration(){
        return view('registration');
    }

    // submit the registration data through post method.
    public function registration_submit(Request $request){
        // create a token for a specific user.
        $token = hash('sha256',time());
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = "Pending";
        // give the token variable.
        $user->token = $token;

        // store the information in the database.
        $user->save();

        // Send this information to the MailTrap. 
        $verification_link = url('registration/verify/'.$token.'/'.$request->email);
        $subject = "Registration Confirmation";
        $message = 'Please click on the link below: <br> <a href="'.$verification_link.'">Click Here</a>';
        Mail::to($request->email)->send(new WebsiteMail($subject,$message));
        print("Email is sent to the user");
    }

    // we need to verify the user in the mailtrap.
    public function registration_verify($token, $email)
    {
        // Firstly,we need to catch the user information from database.
        $user = User::where('token',$token)->where('email',$email)->first();
        // if the user is not found then redirected to the login page.
        if (!$user) {
            return redirect()->route('login');
        }
        // then update the information of that specific user.
        $user->status = "Active";
        $user->token = "";
        $user->update();

        echo "Registration verification is successfull";
    }

    public function login_submit(Request $request){
        // get the credentials
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
            'status'=>'Active'
        ];
        // use the default authentication system for login
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login');
        }
    }

    public function logout(){
        // use the default logout system
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function forget_password(){
        return view('forget_password');
    }

    public function forget_password_submit(Request $request){
        // create a token.
        $token = hash('sha256',time());
        // catch the user information.
        $user = User::where('email',$request->email)->first();
        if (!$user) {
            dd("user not found");
        }
        $user->token = $token;
        $user->update();
        // create a password reset link.
        $password_reset_link = url("reset_password/".$token.'/'.$request->email);
        $subject = "Reset Password";
        $message = 'Please click on the link below: <br> <a href="'.$password_reset_link.'">Click Here</a>';
        // mail to that specific user.
        Mail::to($request->email)->send(new WebsiteMail($subject,$message));
        print "Check your email";
    }

    // show reset password page
    public function reset_password($token, $email)
    {
        // catch the user information.
        $user = User::where('email',$email)->where('token',$token)->first();
        return view('reset_password',compact('token','email'));
    }
    
    public function reset_password_submit(Request $request)
    {
        $user = User::where('token',$request->token)->where('email',$request->email)->first();
        // we make the token null of that specific user.
        $user->token = "";
        $user->password = Hash::make($request->password);
        $user->update();
        print "Password is reset.";
    }

}
