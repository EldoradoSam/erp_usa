<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class Country extends Model
{
    protected $table = 'st_countries';
    protected $primaryKey = 'country_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'country_id',
        'country_code',
        'country_name',
        'import_instruction',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_countries";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\CountryFactory::new();
    // }
}

