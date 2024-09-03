<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DBInformation extends Model
{
    protected $table="subscriber_information";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'zipcode',
        'country',
    ];
    
}
