<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class RolesPermission extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = [
        'role_id',
        'permission_id',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "roles_permissions";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

    protected static function newFactory()
    {
        return \Modules\St\Database\factories\RolesPermissionFactory::new();
    }
}
