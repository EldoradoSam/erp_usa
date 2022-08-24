<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'pp_product_sizes';
    protected $primaryKey = 'product_size_id';
    protected $fillable = [];
    
}
