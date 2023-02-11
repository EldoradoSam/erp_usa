<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class CustomerOrder extends Model
{
    protected $table = 'pp_customer_orders';
    protected $primaryKey = 'order_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'order_id',
        'customer_id',
        'customer_name',
        'purchase_order',
        'factory_po_num',
        'invoice_num',
        'bill_address',
        'delivery_address',
        'cosignee_details',
        'party_details',
        'date',
        'country_id',
        'delivery_date',
        'shipping_term_id',
        'name_fill',
        'remarks',
        'production_status',
        'shipping_status',
        'status',
        'order_status',
        'fund_status',
        'created_by',
        'updated_by',
        'create_from',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_customer_orders";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}

