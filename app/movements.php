<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movements extends Model
{
    protected $fillable = [
        'companies_id',
        'product_id',
        'entry_date',
        'entry_quantity',
        'entry_unit',
        'invoice_number',
        'provider_name',
        'permission_number',
        'exit_date',
        'exit_quantity',
        'exit_unit',
        'observations',
        'supervisor_id',
        'balance'
        
    ];
}
