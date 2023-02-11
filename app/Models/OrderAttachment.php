<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderAttachment extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'pp_order_attachments';
    protected static $logAttributes = [
        'id',
        'order_id',
        'description',
        'file_path',
        'token',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_order_attachments";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
