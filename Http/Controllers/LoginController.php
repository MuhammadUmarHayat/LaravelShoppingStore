<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
       
       // Validate the request using the custom method
    $this->validateLogin($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
          
            $role=Auth::user()->role;
            if($role === "admin")
            {
               // dd( $role);
               session()->put('user_id',$request->email);
                return view('admin.dashboard', ['success' => 'Logged in successfully']);
               
            }
            else
            {
               // dd( $role);
             
               // return view('customer.dashboard', ['success' => 'Logged in successfully']);
               session()->put('user_id',$request->email);
               return redirect()->route('customer.dashboard');
                
            }
            
        }

        return back()->with('error', 'Invalid email or password');
    }
    protected function validateLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
}
    /**
     * Handle logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        session()->forget('user_id');
        Auth::logout();
        
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
