<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrainHoleSize extends Model
{
    use HasFactory;
    protected $table = 'pp_drain_hole_sizes';
    protected $primaryKey = 'drain_hole_size_id';
    protected $fillable = [];
   
   
}
