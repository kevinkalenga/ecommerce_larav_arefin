<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Admin;
use Hash;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login()
    {
        return view('admin.login');
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
        ];

        if (Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard');
        } else {
            return back()->with('error', 'Invalid credentials.');
        }
    }
    
    /* -------------------- Déconnexion -------------------- */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success', 'Logged out successfully');
    }
    
    
    public function forget_password()
    {
        return view('admin.forget_password');
    }
    public function forget_password_submit(Request $request)
    {
        // php artisan queue:work
         // Validation du formulaire
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Récupérer l'admin
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->with('error', 'Email not found.');
        }

        // Générer un token sécurisé (32 octets aléatoires convertis en hexadécimal)
        $token = bin2hex(random_bytes(32));

        // Mettre à jour le token directement
        $admin->update(['token' => $token]);

        // Créer le lien de réinitialisation
        $link = url('admin/reset-password/' . $token . '/' . $request->email);

        // Message et sujet de l'email
        $subject = "Password Reset Request";
        $message = "To reset your password, please click on the link below:<br>";
        $message .= "<a href='" . $link . "'>Click Here</a>";

        // Envoyer l'email
        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        // Retourner avec un message de succès
        return redirect()->route('admin_login')
            ->with('success', 'Please check your email and follow the link to reset your password.');
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Invalid token or email.');
        }

        return view('admin.reset_password', compact('token', 'email'));
    }


    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ]);

        $admin = Admin::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Invalid token or email.');
        }

        // Réinitialiser le mot de passe
        $admin->update([
            'password' => Hash::make($request->password),
            'token' => null,
        ]);

        return redirect()->route('admin_login')->with('success', 'Password reset successfully. You can now log in.');
    }
}


