<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    protected $table = 'st_districts';
    protected $primaryKey = 'district_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\DistrictFactory::new();
    // }
}
