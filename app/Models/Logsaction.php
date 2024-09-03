<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logsaction extends Model
{
    protected $table="logsaction";
    protected $fillable = [
        'uploaded_by',
        'module_name',
        'action',
        'message',
        'uploadcsv'
    ];
    
}
