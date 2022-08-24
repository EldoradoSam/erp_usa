<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    protected $table = 'st_banks';
    protected $primaryKey = 'bank_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\BankFactory::new();
    // }
}
