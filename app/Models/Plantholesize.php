<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plantholesize extends Model
{
    protected $table = 'pp_plant_hole_sizes';
    protected $primaryKey = 'plant_hole_size_id'; 
    use HasFactory;
}
