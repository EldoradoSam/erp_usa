<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Customer extends Model
{

    protected $table = 'st_customers';
    protected $primaryKey = 'customer_id';
    //public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = [
        'customer_id',
        'customer_name',
        'address',
        'delivery_address',
        'cosignee_details',
        'party_details',
        'web',
        'country_id',
        'accountgroup_id',
        'status_id',
        'notes',
        'create_from',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_customers";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

    /*protected static function newFactory()
    {

        return \Modules\St\Database\factories\CustomerFactory::new();
    }*/
}
