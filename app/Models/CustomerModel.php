<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';

    protected $fillable = [

        'customername',
        'email',
        'mobile',
        'amount',
        'credited_on',
        'created_at',
        'updated_at',
        'status'

    ];

    public $timestamps = false;
}
