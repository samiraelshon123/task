<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function registerUser(Request $request){
        $data = $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'


        ],[],[]);

        $news = User::create( [

            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))

        ]);
        return redirect('dashboard/index');
    }


    public function login(){
        return view('auth.login');
    }
    public function loginUser(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect('dashboard/index');

        }else{

            return back();
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back();
       }
}
