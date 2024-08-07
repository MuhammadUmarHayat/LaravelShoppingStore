<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function showAdminRegistrationForm()
    {
        return view('auth.admin_register');
    }


    public function register(Request $request)
    {
      $res=  $this->validator($request->all())->validate();
//dd($res);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // or 'admin' based on your requirement
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now login.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>'required',
        ]);
    }
}
