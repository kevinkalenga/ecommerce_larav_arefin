<?php

namespace App\Http\Controllers\Admin;
 use App\Models\User;
 use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        return view('admin.user.create');
    }

     
  public function store(Request $request)
  {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'photo' => ['nullable','image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        'phone' => 'unique:users,phone'
    ]);

    // Générer un mot de passe aléatoire
    $randomPassword = Str::random(10);

    //Gestion de la photo
    if ($request->hasFile('photo')) {
        $final_name = 'user_' . time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
    } else {
        $final_name = 'default.png';
    }

    // Enregistrement
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->country = $request->country;
    $user->address = $request->address;
    $user->state = $request->state;
    $user->city = $request->city;
    $user->zip = $request->zip;
    $user->password = Hash::make($randomPassword); 
    $user->photo = $final_name;
    $user->status = $request->status ?? 1;
    $user->save();


    // Send email
        $subject = 'Your account has been created';
        $message  = 'See you login details below: <br>';
        $message  = 'URL: '.route('user_login').'<br>';
        $message .= 'Email: '.$request->email.'<br>';
        $message .= 'Password: '.$randomPassword. '<br>';
       
        

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

    // (optionnel) afficher ou envoyer le mot de passe
    return redirect()->route('admin_user_index')->with('success',  'User is Created Successfully');
  }
}
