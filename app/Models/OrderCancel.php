<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class OrderCancel extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected $table = 'pp_order_cancels';
    protected $primaryKey = 'order_cancel_id';
    protected static $logAttributes = [
        'order_cancel_id',
        'date',
        'factory_po_no',
        'customer_po_no',
        'order_id',
        'reason_id',
        'remarks',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_order_cancels";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
