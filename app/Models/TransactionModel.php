<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    protected $fillable = [

        'customer_id',
        'type',
        'ip',
        'amount',
        'date',
        'created_at',
        'updated_at',
        'status'

    ];

    public $timestamps = false;
}
