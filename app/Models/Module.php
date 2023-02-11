<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Module extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = [
        'id',
        'module_name',
        'prefix',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "modules";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    /*protected static function newFactory()
    {
        return \Modules\St\Database\factories\ModuleFactory::new();
    }*/
}

