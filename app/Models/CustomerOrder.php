<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerOrder extends Model
{
    protected $table = 'pp_customer_orders';
    protected $primaryKey = 'order_id';
    use HasFactory;
}
