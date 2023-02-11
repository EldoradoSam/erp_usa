<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class CustomerPlan extends Model
{
    use HasFactory,LogsActivity;

    protected $table = 'pp_customer_order_plans';
    protected $primaryKey = 'customer_order_plan_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected static $logAttributes = [
        'customer_order_plan_id',
        'order_id',
        'manufacturing_order_number',
        'trans_date',
        'from_date',
        'to_date',
        'description',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_customer_order_plans";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
