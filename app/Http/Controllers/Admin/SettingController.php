<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Models\Setting;
use Session;
use App\Http\Controllers\CommonController;

class SettingController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function common(){
        $content['r']=  Setting::first();
        return view('admin.setting.create',$content);
    }

    public function common_save(Request $request){
       
        $form_data = $request->all();
        $data = Setting::find(1);
        if($request->file('logo')){
            $form_data['logo']=  $this->common->fileUpload($request->file('logo'),  'uploads/settings/' );
        } 
        if($request->file('logo_sm')){
            $form_data['logo_sm']=  $this->common->fileUpload($request->file('logo_sm'),  'uploads/settings/' );
        } 
        if($request->file('login_logo')){
            $form_data['login_logo']=  $this->common->fileUpload($request->file('login_logo'),  'uploads/settings/' );
        } 
        if($request->file('logo_invoice')){
            $form_data['logo_invoice']=  $this->common->fileUpload($request->file('logo_invoice'),  'uploads/settings/' );
        } 
        if($request->file('favicon')){
            $form_data['favicon']=  $this->common->fileUpload($request->file('favicon'),  'uploads/settings/' );
        }
        
        if($request->has('ai_tender_sale_file_use')){

            if($request->input('ai_tender_sale_file_use') == 1){
                if($request->file('tenderCsvFile')){
                    $tenderCsvFile=  $this->common->fileUpload($request->file('tenderCsvFile'),  'uploads/settings/' );
                    $form_data['ai_tender_sale_file']='uploads/settings/'.$tenderCsvFile;
                }
            }else if($request->input('ai_tender_sale_file_use') == 0){
                //$form_data['ai_tender_sale_file']=getLogsInfo('Tender Sales','CSV Upload','uploadcsv');
            }
        }
        //echo "<pre>"; print_r($request->all()); die();


        if($data->update($form_data)){
            $request->session()->flash('success', 'Information has been updated successfully!');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Error!');
            return redirect()->back();
        }
    }
}
