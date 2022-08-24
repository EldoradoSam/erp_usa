<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerOrderData extends Model
{
    use HasFactory;

    protected $table = 'pp_customer_orders_data';
    protected $primaryKey = 'order_data_id';
    public $incrementing = false;
    protected $keyType = 'string';

    //by nipuna start
    protected $casts = [
        'vegetableCheck' => 'boolean',
        'berryCheck' => 'boolean',
        'flowersCheck' => 'boolean',
        'PCMCheck' => 'boolean',
        'OthersCheck' => 'boolean',
    ];
    //by nipuna end

}
