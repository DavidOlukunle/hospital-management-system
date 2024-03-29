<?php

namespace App\Http\Controllers;

use auth;
use session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create() {
        return view('users.register');
    }

    //create new user
    public function register(Request $request) {
        $formFields = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'email',  Rule::unique('users','email')],
            
        ]);
        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth()->login($user);
        return redirect('/')->with('message','You now have an account');
    }

    public function loginPage() {
        return view('users.login');
    } 

    //authenticate user
    public function authenticate(Request  $request) {
        $formFields = $request->validate([
            'email'=> ['required'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formFields)){

            if(auth()->user()->usertype == '0') {

                $request->session()->regenerate();
                
                return redirect('/');
            }
             elseif(auth()->user()->usertype == '1'){
                
                 $request->session()->regenerate();
                 return redirect('/admin/dashboard')->with('message','logged in');
             }
             
             }
             else{
                return redirect('/')->with('message', 'invalid credentials');
                 
             }
        }
    //logout user
    public function logout(Request $request) {

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken(); 

        return redirect('/');
    }
}
