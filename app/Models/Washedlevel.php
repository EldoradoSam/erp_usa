<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Washedlevel extends Model
{
    protected $table = 'pp_washed_levels';
    protected $primaryKey = 'washed_level_id'; 
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'washed_level_id',
        'washed_level',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_washed_levels";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
