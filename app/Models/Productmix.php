<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Productmix extends Model
{
    protected $table = 'pp_product_mixes';
    protected $primaryKey = 'product_mix_id'; 
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'product_mix_id',
        'product_mix',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_product_mixes";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}
