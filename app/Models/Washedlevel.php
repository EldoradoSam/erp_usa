<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Washedlevel extends Model
{
    protected $table = 'pp_washed_levels';
    protected $primaryKey = 'washed_level_id'; 
    use HasFactory;
}
