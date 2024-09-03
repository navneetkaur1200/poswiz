<?php
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Models\Notification;
use App\Models\Logsaction;
use App\Models\DBInformation;
//use Config;
function get_role($id=0,$field='name'){
    $result =  Role::where('id',$id)->first();
    if(!empty($result)){
        return $result->$field;
    }
}
function currency(){
    return "$";
}
function convertoblog($path_image=''){
    $path = $path_image;
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
function getSettingInfo($field='name'){
    $result =  Setting::first();
    if(!empty($result)){
        if($field!="all"){
            return $result->$field;
        }else{
            return $result;
        }
        
    }
}
function userInfo($id, $field='name'){
    $result =  User::where('id',$id)->first();
    if(!empty($result)){
        if($field!="all"){
            return $result->$field;
        }else{
            return $result;
        }
    }
}
function userPassInfo($id, $field='name'){
    $result =  User::where('passkey',$id)->first();
    if(!empty($result)){
        if($field!="all"){
            return $result->$field;
        }else{
            return $result;
        }
    }
}
function roleInfo($id, $field='name'){
    $result =  Role::where('id',$id)->first();
    if(!empty($result)){
        if($field!="all"){
            return $result->$field;
        }else{
            return $result;
        }
        
    }
}
function sendSystemNotification($to=0,$title='',$message='',$url='',$is_admin=0){
    $data['to_send'] = $to;
    $data['from_send'] = Auth::id();
    $data['title'] = $title;
    $data['description'] = $message;
    $data['link'] = $url;
    $data['is_admin'] = $is_admin;
    $notif =new Notification($data);
    return $notif->save();
}
function getSystemSendNotification($to =0,$count=0 ){
    
    if(Auth::user()->role == 1){
        $query = Notification::where('is_admin',1);
    }else{
        $query = Notification::where('to_send',$to);
    }
    $query->where('status',0);
    if($count == 1){
        return $query->count();
    }else{
        return $query->get();
    }
}
function notification_update(){
    if(isset($_GET['notification_status'])){        
        $notif = Notification::find($_GET['notification_status']);
        $notif->status = 1;
        $notif->save();
    }
}

function roleName($role=0){
    switch($role){
        case 1:
            return "Admin";
            break;
        case 2:
            return "Staff";
            break;
        default:
        return "Invalid";
    }
}
function encode($val){
    if($val){
       return str_replace(array('+', '/','='), array('', '',''), strrev(substr(md5(999),3,4).base64_encode(strrev("`".$val."~".substr(md5($val),0,10).'p04b54'))));
    }
}
function decode($code){
    if($code){
        $val = strrev(base64_decode(str_replace(array('', '',''), array('+', '/','='),strrev($code))));
        $val = ltrim(current(explode('~',$val)),'`');
        return $val;
    }
}
function getMonthName($month=0){
    return date("F", mktime(0, 0, 0, $month, 10));
}

function getAddDate($type = 'start'){
    $start = date('Y-m-01',strtotime('-1 month'));
    $end = date('Y-m-t',strtotime('-1 month'));
    if($type=="start"){
        return $start;
    }else{
        return $end;
    }
}

function getSelectedMonth($return='month'){
    if ($return == "month"){
        return date("F",strtotime('-1 month'));
    }else{
        return date("Y");
    }
}

function getSettingCsv($type ='Commission',$key='commission_row_start'){
    $setting = Setting::first();
    return $setting->$key;
    
}

function logsCreate($data = array()){
    $info = new Logsaction($data);
    $info->save();
}
function getLogsInfo($module='',$action='',$field=''){
    $info = Logsaction::where('module_name',$module)->where('action',$action)->orderBy('id','desc')->first();
    if(!empty($info)){
        return $info->$field;
    }
}
function dnsinfo($dns='',$fld=''){
    $user = User::where('dns',$dns)->first();
    if(!empty($user)){
        if($fld == ""){
            return $user;
        }else{
            return $user->$fld;
        }
    }
}
function setDb($passKey=""){
    $passkey = "AmahN2az9mbxkTOz43NmhTNzUzN2kDZwBDNiVDN5386";
    session(['passKey' => $passKey]);
    $id = userPassInfo($passkey,'id');
    $dbInfo =DBInformation::where('user_id',$id)->first();
    config(['database.connections.'.$dbInfo->dbctname => [
        'driver' => $dbInfo->dbctdriver,
        'host' => $dbInfo->dbcthost,
        'port' => $dbInfo->dbctport ?? '3306',
        'username' => $dbInfo->dbctusername,
        'password' => $dbInfo->dbctpassword,
        'database' => $dbInfo->dbctname
    ]]);
    return $dbInfo->dbctname;
}
?>
