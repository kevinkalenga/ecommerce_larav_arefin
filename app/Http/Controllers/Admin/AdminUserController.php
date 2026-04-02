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
        $subject  = 'See you login details below: <br>';
        $message  = 'URL: '.route('user_login').'<br>';
        $message .= 'Email: '.$request->email.'<br>';
        $message .= 'Password: '.$randomPassword. '<br>';
       
        

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

    // (optionnel) afficher ou envoyer le mot de passe
    return redirect()->route('admin_user_index')->with('success',  'User is Created Successfully');
  }

  
    
    
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'country' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'photo' => ['nullable','image','mimes:jpg,jpeg,png,gif,webp','max:2048'],
            'password' => 'nullable|min:6'
            
        ]);
        
        // Upload photo
        if($request->hasFile('photo')) 
        {
            // Supprimer ancienne photo (sécurisé)
             if ($user->photo && $user->photo !== 'default.png' && file_exists(public_path('uploads/' . $user->photo))) {
                 unlink(public_path('uploads/' . $user->photo));
             }

             $filename = 'user_' . time() . '_' . uniqid() . '.' . $request->photo->extension();
             $request->photo->move(public_path('uploads'), $filename);
             
             $user->photo = $filename;
        }
        
        // Update password (optionnel)
        if (!empty($request->password)) {
          $user->password = bcrypt($request->password);
        }
        
          // Update infos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status ?? $user->status;
        $user->save();

        return redirect()->route('admin_user_index')->with('success', 'User is Updated Successfully');
    }

    public function delete($id)
    {
       $user = User::findOrFail($id);

       // Supprimer la photo si elle existe et n'est pas par défaut
       if ($user->photo && $user->photo !== 'default.png' && file_exists(public_path('uploads/' . $user->photo))) {
           unlink(public_path('uploads/' . $user->photo));
       }

       // Supprimer l'utilisateur
       $user->delete();

       return redirect()->route('admin_user_index')->with('success', 'User deleted successfully');
    }
}
