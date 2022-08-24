<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productmix extends Model
{
    protected $table = 'pp_product_mixes';
    protected $primaryKey = 'product_mix_id'; 
    use HasFactory;
}
