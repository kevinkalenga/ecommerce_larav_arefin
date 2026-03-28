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
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function registration()
    {
        if(Auth::guard('web')->check()) {
            return redirect()->route('user_dashboard');
        }
        return view('user.auth.registration');
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
        if(Auth::guard('web')->check()) {
            return redirect()->route('user_dashboard');
        }
        return view('user.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();

        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1
        ];

        if (Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with('success', 'Logged in successfully!');
        } else {
            return redirect()->route('user_login')->with('error', 'Information is not correct!');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user_login')->with('success', 'Logged out successfully!');
    }

    /* -------------------- Page mot de passe oublié -------------------- */
    public function forget_password()
    {
        return view('user.auth.forget_password');
    }


    /* -------------------- Soumission du formulaire de mot de passe oublié -------------------- */
    public function forget_password_submit(Request $request)
    {
        // Validation du formulaire
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Récupérer le customer
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        // Générer un token sécurisé (32 octets aléatoires convertis en hexadécimal)
        $token = bin2hex(random_bytes(32));

        // Mettre à jour le token directement
        $user->update(['token' => $token]);

        // Créer le lien de réinitialisation
        $link = url('user/reset-password/' . $token . '/' . $request->email);

        // Message et sujet de l'email
        $subject = "Password Reset Request";
        $message = "To reset your password, please click on the link below:<br>";
        $message .= "<a href='" . $link . "'>Click Here</a>";


        \Mail::to($request->email)->send(new Websitemail($subject, $message));

       

        // Retourner avec un message de succès
        return redirect()->route('user_login')
            ->with('success', 'Please check your email and follow the link to reset your password.');
    }

    /* -------------------- Page de réinitialisation de mot de passe -------------------- */
    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('user_login')->with('error', 'Invalid token or email.');
        }

        return view('user.auth.reset_password', compact('token', 'email'));
    }


    /* -------------------- Soumission du formulaire de réinitialisation -------------------- */
    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        $user = User::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$user) {
            return redirect()->route('user_login')->with('error', 'Invalid token or email.');
        }

        // Réinitialiser le mot de passe
        $user->update([
            'password' => Hash::make($request->password),
            'token' => null,
        ]);

        return redirect()->route('user_login')->with('success', 'Password reset successfully. You can now log in.');
    }

    /* -------------------- Page de Profie -------------------- */
    public function profile()
    {
        return view('user.profile');
    }


    public function profile_submit(Request $request)
    {
       $request->validate([
             'name' => 'required',
             'email' => 'required|email',
             'password' => 'nullable|min:6|confirmed',
        ]);

        
        
       
        $user = User::find(Auth::guard('web')->id());
        // Mettre à jour le mot de passe seulement si rempli
        if ($request->password) {
              $user->password = Hash::make($request->password);
        }
      
        //  photo

        if ($request->hasFile('photo')) {
           $request->validate([
            'photo' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
           ]);

            // Supprime l'ancienne photo seulement si ce n'est pas une photo par défaut
            $defaultPhotos = ['user.jpg', 'default.png'];
            if ($user->photo && !in_array($user->photo, $defaultPhotos) && file_exists(public_path('uploads/' . $user->photo))) {
                unlink(public_path('uploads/' . $user->photo));
            }

             // Sauvegarde la nouvelle photo
             $final_name = 'user_' . time() . '.' . $request->photo->extension();
             $request->photo->move(public_path('uploads'), $final_name);
             $user->photo = $final_name;
        }


        // Update
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->save();

        Auth::guard('web')->setUser($user->fresh());

        return redirect()->back()->with('success', 'Profile updated successfully.');

    }

    public function orders()
    {
        return view('user.orders');
    }
    public function wishlist()
    {
       return view('user.wishlist');
    }
}
