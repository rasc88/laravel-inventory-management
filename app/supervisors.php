<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supervisors extends Model
{
    protected $fillable = [
        'name',
        'identification',
        'signature'     
    ];
}
