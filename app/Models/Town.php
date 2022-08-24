<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Town extends Model
{
    protected $table = 'st_towns';
    protected $primaryKey = 'town_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\TownFactory::new();
    // }
}
