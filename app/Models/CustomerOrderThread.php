<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class CustomerOrderThread extends Model
{
    use HasFactory,LogsActivity;

    protected $table = 'pp_customer_order_threads';
    protected $fillable = [];
    protected static $logAttributes = [
        'id',
        'order_id',
        'user_id',
        'user_name',
        'user_type',
        'text',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_customer_order_threads";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

}
