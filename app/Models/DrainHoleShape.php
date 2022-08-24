<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DrainHoleShape extends Model
{
    use HasFactory;
    protected $table = 'pp_drain_hole_shapes';
    protected $primaryKey = 'drain_hole_shape_id';
    protected $fillable = [];
    

}
