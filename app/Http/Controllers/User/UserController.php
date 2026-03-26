<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\Websitemail;

class UserController extends Controller
{
    public function registration()
    {
        return view('user.registration');
    }
    
    
    public function registration_submit(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        
         $token = hash('sha256', time());
         $password = Hash::make($request->password);
          $link = url('registration_verify/'.$request->email.'/'.$token);
          
          $obj = new User();
          $obj->name = $request->name;
          $obj->email = $request->email;
          $obj->password = $password;
          $obj->token = $token;
          $obj->status = 0;
          $obj->save();
          
          
          
          // Send email
            $subject = 'Registration Verification';
            $message  = 'Please click on the link below to confirm sign up process: <br>';
            $message .= '<a href="'.$link.'">';
            $message .= $link;
            $message .= '</a>';
        

            \Mail::to($request->email)->send(new Websitemail($subject, $message));
        

        return redirect()->back()->with('success', 'To complete the registration, please check your email and click on the link.');

       
    }


    public function registration_verify($email, $token)
    {
      
        $user = User::where('email', $email)->where('token', $token)->first();

        if ($user) {
           $user->token = "";
           $user->status = 1;
           $user->update();
        
            
            
            return redirect()->route('login')
            ->with('success', 'Your account is verified successfully!');
        
        }


        return redirect()->route('login')->with('error', 'Invalid verification link.');
    
    
    }

    public function login()
    {
        return view('user.login');
    }
}
