<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Town extends Model
{
    protected $table = 'st_towns';
    protected $primaryKey = 'town_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'town_id',
        'town',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_towns";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\TownFactory::new();
    // }
}

