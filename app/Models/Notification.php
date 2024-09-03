<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{ 

    protected $table="notification";
    protected $fillable = [
        'title','description','link','status','to_send','from_send','is_admin'
    ];

}
