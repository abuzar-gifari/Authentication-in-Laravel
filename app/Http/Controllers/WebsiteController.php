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

    public function dashboard_user(){
        return view('dashboard_user');
    }

    public function dashboard_admin(){
        return view('dashboard_admin');
    }

    public function login(){
        return view('login');
    }

    public function registration(){
        return view('registration');
    }

    // Submit the Registration Data Through Post Method.
    public function registration_submit(Request $request){
        // Create a Token for a Specific User.
        $token = hash('sha256',time());
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = "Pending";
        // Give the Token Variable.
        $user->token = $token;
        $user->role=2;
        // Store the Information in the Database.
        $user->save();

        // Send This Information to the MailTrap. 
        $verification_link = url('registration/verify/'.$token.'/'.$request->email);
        $subject = "Registration Confirmation";
        $message = 'Please click on the link below: <br> <a href="'.$verification_link.'">Click Here</a>';
        Mail::to($request->email)->send(new WebsiteMail($subject,$message));
        print("Email is sent to the user");
    }

    // We Need to Verify the User in the MailTrap.
    public function registration_verify($token, $email)
    {
        // Firstly,We Need to Catch the User Information From Database.
        $user = User::where('token',$token)->where('email',$email)->first();
        // If the User is not Found then Redirected to the Login Page.
        if (!$user) {
            return redirect()->route('login');
        }
        // Then Update the Information of That Specific User.
        $user->status = "Active";
        $user->token = "";
        $user->update();

        echo "Registration verification is successfull";
    }

    public function login_submit(Request $request){
        // Get the Credentials
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
            'status'=>'Active'
        ];
        // Use the Default Authentication System for Login
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role==1) {
                return redirect()->route('dashboard_admin');  
            }else {
                return redirect()->route('dashboard_user');
            }
        }else {
            return redirect()->route('login');
        }
    }

    public function logout(){
        // Use the Default Logout System
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function forget_password(){
        return view('forget_password');
    }

    public function forget_password_submit(Request $request){
        // Create a Token.
        $token = hash('sha256',time());
        // Catch the User Information.
        $user = User::where('email',$request->email)->first();
        if (!$user) {
            dd("user not found");
        }
        $user->token = $token;
        $user->update();
        // Create a Password Reset Link.
        $password_reset_link = url("reset_password/".$token.'/'.$request->email);
        $subject = "Reset Password";
        $message = 'Please click on the link below: <br> <a href="'.$password_reset_link.'">Click Here</a>';
        // Mail to That Specific User.
        Mail::to($request->email)->send(new WebsiteMail($subject,$message));
        print "Check your email";
    }

    // Show Reset Password Page
    public function reset_password($token, $email)
    {
        // Catch the User Information.
        $user = User::where('email',$email)->where('token',$token)->first();
        return view('reset_password',compact('token','email'));
    }
    
    public function reset_password_submit(Request $request)
    {
        $user = User::where('token',$request->token)->where('email',$request->email)->first();
        // We Make the Token Null of That Specific User.
        $user->token = "";
        $user->password = Hash::make($request->password);
        $user->update();
        print "Password is reset.";
    }

    public function settings()
    {
        return view('settings');
    }
}
