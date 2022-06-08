<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        // catch the user information from database.
        $user = User::where('token',$token)->where('email',$email)->first();
        // if the user is not found then redirected to the login page.
        if (!$user) {
            return redirect()->route('login');
        }
        // update the information of that specific user.
        $user->status = "Active";
        $user->token = "";
        $user->update();

        echo "Registration verification is successfull";
    }

    public function forget_password(){
        return view('forget_password');
    }
}
