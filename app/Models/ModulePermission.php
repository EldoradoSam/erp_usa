<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class ModulePermission extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = [
        'module_id',
        'permission_id',
        'prefix',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "module_permissions";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    /*protected static function newFactory()
    {
        return \Modules\St\Database\factories\ModulePermissionFactory::new();
    }*/
}

