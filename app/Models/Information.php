<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table="logsaction";
    public function __construct(){
        $headers = apache_request_headers(); 
        if (!$headers['Pass-Key']) {
            abort(400, 'Pass-Key is required');
        }
        $this->connection = setDb($headers['Pass-Key']);
    }
    protected $fillable = [
        'uploaded_by',
        'module_name',
        'action',
        'message',
        'uploadcsv'
    ];
    
}
