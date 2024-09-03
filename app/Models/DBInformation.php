<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DBInformation extends Model
{
    protected $table="dbinformation";
    protected $fillable = [
        'user_id',
        'dbctdriver',
        'dbctname',
        'dbcthost',
        'dbctusername',
        'dbctpassword'
    ];
    
}
