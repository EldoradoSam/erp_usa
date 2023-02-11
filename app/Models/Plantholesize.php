<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Plantholesize extends Model
{
    protected $table = 'pp_plant_hole_sizes';
    protected $primaryKey = 'plant_hole_size_id'; 
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'plant_hole_size_id',
        'plant_hole_size',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_plant_hole_sizes";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}

