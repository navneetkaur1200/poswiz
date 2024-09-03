<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Models\User;
use App\Models\DBInformation;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Hash;
use Validator;
use Str;

class SubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $common;
    public function __construct(){
        $this->middleware('auth');
        $this->common=new CommonController();
    }

    function create(){
        $content['module'] = 'Subscriber';
        $content['title'] = 'Create New';
        $content['name'] = 'Subscriber';       
        return view('admin.subscriber.create',$content);
    }
    public function show(){
        $content['name'] = 'Subscriber';
        $content['module'] = 'Subscriber';
        $content['title'] = 'All Subscriber';
        return view('admin.subscriber.list',$content);
    }
    public function view($id=''){
        $content['name'] = 'User';
        $content['module'] = 'User';
        $content['title'] = 'View';
        $content['r'] = User::where('id',$id)->first();
        $content['db']=  DBInformation::where('user_id',$id)->first();
        return view('admin.subscriber.view',$content);
    }
   
    
    function edit($id=''){
        $record = User::where('id',$id)->first();
        $content['name'] = 'Subscriber';
        $content['module'] = 'Edit';
        $content['title'] = 'Edit Subscriber';
        
        $content['r']=  User::find($id);
        $content['db']=  DBInformation::where('user_id',$id)->first();
        return view('admin.subscriber.edit',$content);
    }
    function showList(Request $request){
        $record = User::where('id','!=',Auth::id());
        if($request->has('rolewise')){
            if($request->get('rolewise')!=""){
                $record->where('role',$request->get('rolewise'));
            }
        }
        return Datatables::of($record)
           ->editColumn('status',function($record) {
            if($record->status==0){
                    return '<span class="badge badge-soft-danger" key="t-new">De-Active</span>';
            }else{
                return '<span class="badge badge-soft-success" key="t-new">Active</span>';
            }

            })
            ->editColumn('picture',function($record) {
                if($record->picture!=""){
                    return '<div><img class="rounded-circle avatar-xs" src="'.asset('uploads/profile/'.$record->picture).'" alt=""></div>';
                }else{
                    return '<div class="avatar-xs"><span class="avatar-title rounded-circle">'.substr($record->name,0,1).'</span></div>';
                }
                
            })
            ->editColumn('role',function($record) {
                return roleName($record->role);
            })
            ->editColumn('created_at',function($record) {
                return date("Y-m-d", strtotime($record->created_at));
            })
            ->addColumn('actions',function($record) {
                $actions = '<a href="'. route('admin.subscriber.edit',$record->id).'" class="on-default"><i class="ti ti-pencil-minus"></i></a>';
                $actions.= '<a href="'. route('admin.subscriber.view',$record->id).'" class="on-default"><i class="ti ti-eye"></i></a>';
                $actions.= '<a href="javascript:void(0);" data-url="'. route('admin.subscriber.delete',$record->id).'" class="on-default sa-warning"><i class="ti ti-trash"></i></a>';


                return $actions;
            })
            ->rawColumns(['actions','status','picture'])
            ->make(true);
    }
    
    public function generateUserName($firstname){
        $username = Str::lower(Str::slug($firstname));
        if(User::where('username', '=', $username)->exists()){
            $uniqueUserName = $username.'-'.str_pad(mt_rand(1,9999),4,'0',STR_PAD_LEFT);
            $username = $this->generateUserName($uniqueUserName);
        }
        return $username;
    }
    function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' =>'required|unique:users',
            'storenumber' =>'required|numeric|unique:users',
            'password' =>'required'
        ],$this->message_errors());
        $formdata= $request->all();

        
        $formdata['username'] = $this->generateUserName($formdata['name']);;
        //echo "<pre>"; print_r($formdata);die();
        $formdata['password'] = Hash::make($request->input('password'));
        if($request->file('picture')){
            $formdata['picture']=  $this->common->fileUpload($request->file('picture'),  './uploads/profile');
        }
        $formdata['passkey'] = encode($formdata['username'].rand(20,2547));

        $user = new User($formdata);
        if($user->save()){

            $db['user_id'] = $user->id;
            $db['dbctdriver'] = $formdata['dbctdriver'];
            $db['dbctname'] = $formdata['dbctname'];
            $db['dbcthost'] = $formdata['dbcthost'];
            $db['dbctusername'] = $formdata['dbctusername'];
            $db['dbctpassword'] = $formdata['dbctpassword'];
            $dbsave = new DBInformation($db);
            $dbsave->save();
            /**Logs Generate */
            logsCreate(
                array(
                    'uploaded_by'=>Auth::id(),
                    'module_name'=>'Subscriber',
                    'action'=>'Create',
                    'message'=>'New subscriber added'
                    )
            );
            $request->session()->flash('success', 'Subscriber information has been created');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Error!');
            return redirect()->back();
        }
    }
    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'storenumber' => 'required|numeric|unique:users,storenumber,'.$id
        ],$this->message_errors());

        $data = User::where('id',$id)->first();
        $formdata = $request->all();        
        if($request->input('new_password')!=""){
            $formdata['password'] = bcrypt($request->input('new_password'));
        }

        if($request->file('picture')){
            $formdata['picture']=  $this->common->fileUpload($request->file('picture'),  './uploads/profile');
        }        
        if($data->update($formdata)){

            $db['dbctdriver'] = $formdata['dbctdriver'];
            $db['dbctname'] = $formdata['dbctname'];
            $db['dbcthost'] = $formdata['dbcthost'];
            $db['dbctusername'] = $formdata['dbctusername'];
            $db['dbctpassword'] = $formdata['dbctpassword'];
            $dbsave =  DBInformation::where('user_id',$id);
            $dbsave->update($db);

            /**Logs Generate */
            logsCreate(
                array(
                    'uploaded_by'=>Auth::id(),
                    'module_name'=>'Subscriber',
                    'action'=>'Edit',
                    'message'=>'Update member'
                    )
            );
            $request->session()->flash('success', 'User has updated successfully!');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Error!');
            return redirect()->back();
        }
    }
    function delete($id = ''){
        echo User::where("id",$id)->delete();
        die();
    }

    function message_errors(){
        return [
            'name.required'=>'Name required',
            'email.required'=>'Email required',
            'email.unique'=>'Email already exist',
            'password.required' => 'Password required'

        ];
    }
}
