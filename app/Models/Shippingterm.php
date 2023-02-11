<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Shippingterm extends Model
{
    protected $table = 'pp_shipping_terms';
    protected $primaryKey = 'shipping_term_id'; 
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'shipping_term_id',
        'shipping_term',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_shipping_terms";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
