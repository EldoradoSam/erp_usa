<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierType extends Model
{
    protected $table = 'st_supplier_types';
    protected $primaryKey = 'supplier_type_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\SupplierTypeFactory::new();
    // }
}
