<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplierStatus extends Model
{
    protected $table = 'st_supplier_statuses';
    protected $primaryKey = 'supplier_status_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\SupplierStatusFactory::new();
    // }
}
