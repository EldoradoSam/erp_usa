<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Reason extends Model
{
    use HasFactory,LogsActivity;
    protected $table = 'pp_reasons';
    protected $primaryKey = 'reason_id';
    protected $fillable = [];
    protected static $logAttributes = [
        'reason_id',
        'reason',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_reasons";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
