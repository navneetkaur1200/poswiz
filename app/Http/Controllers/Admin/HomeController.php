<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CommonController;
use Auth;
use DateTime;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $common;
    public function __construct()
    {
        $this->middleware('auth');
        $this->common=new CommonController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(){
        $content['pageConfigs'] = ['pageHeader' => true];
        $content['breadcrumbs'] = [
          ["link" => route('admin.dashboard'), "name" => "dashboard"],["name" => "Dashboard"]
        ];
        return view('admin.dashboard',$content);
    }

     public function index(){
        $content['pageConfigs'] = ['pageHeader' => true];
        $content['breadcrumbs'] = [
          ["link" => route('admin.home'), "name" => "Home"],["name" => "My Profile"]
        ];
        return view('admin.profile',$content);
    }

    function profile(){
        
        $content['pageConfigs'] = ['pageHeader' => true];
        $content['breadcrumbs'] = [
          ["link" => route('admin.profile'), "name" => "Home"],["name" => "My Profile"]
        ];
        $content['r'] = User::where('id',Auth::id())->first();

        return view('admin.profile',$content);
    }
    function profile_edit(){
        $content['pageConfigs'] = ['pageHeader' => true];
        $content['breadcrumbs'] = [
          ["link" => route('admin.profile'), "name" => "Home"],["name" => "My Profile"]
        ];
        $content['r'] = User::where('id',Auth::id())->first();

        return view('admin.profile-edit',$content);
    }
    function profile_update(Request $request){

        $request->validate([
            'name' => 'bail|required',
            'email' => 'required|string|email|unique:users,email,'.Auth::id(),
        ]);

        $form_data = $request->all();
        if($request->file('picture')){
            $form_data['picture']=  $this->common->fileUpload($request->file('picture'),  './uploads/profile',1 );
        }
        if($request->input('new_password')!=""){
            $form_data['password'] = bcrypt($request->input('new_password'));
        }
        $data =  User::find(Auth::id());
        if($data->update($form_data)){
            $request->session()->flash('success', 'Profile has been updated successfully!');
            return redirect(route('admin.profile'));
        }else{
            $request->session()->flash('error', 'Error!');
            return redirect(route('admin.profile'));
        }
    }
}
