<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shippingterm extends Model
{
    protected $table = 'pp_shipping_terms';
    protected $primaryKey = 'shipping_term_id'; 
    use HasFactory;
}
