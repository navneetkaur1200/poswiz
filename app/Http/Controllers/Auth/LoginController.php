<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Cookie;
use Hash;
use App\Http\Controllers\CommonController;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->common=new CommonController();
    }

    function loginform(){
        return view('auth.login');
    }
    
    public function login(Request $request) {
        $this->validate($request, [
           'username' => 'required|string|max:255',
           'password' => 'required|string',
           ]
         );


       $remember = ($request->input('remember')) ? true : false;

       $email=$request->input('username');
       $password=$request->input('password');
       $user = User::where("email",$email)->first();
        $auth = Auth::attempt(
            [
                'username'  => strtolower($request->input('username')),
                'password'  => $request->input('password'),
                'status' => 1,
            ]
        );       
       if($auth){
        
           if($remember){

               Cookie::queue("login_username", $email);
               Cookie::queue("login_password", $password);
           }
           if(Auth::user()->role=='1'){
               return redirect(route('admin.dashboard'));
           }
           if(Auth::user()->role=='2'){
                return redirect(route('staff.profile'));
            }

       }else{        
           $request->session()->flash('error', 'Your User Name/password combination was incorrect.!');
           return redirect(route('login'));
       }

    }

    function logout(Request $request) {
        Auth::logout();
        session_start();
        session_destroy();
        //return redirect(route('login'));
        return redirect()->back();
    }
}
