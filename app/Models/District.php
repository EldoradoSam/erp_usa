<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class District extends Model
{
    protected $table = 'st_districts';
    protected $primaryKey = 'district_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'id',
        'user',
        'customer_id',
        'address',
        'contact_no',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_districts";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\DistrictFactory::new();
    // }
}

