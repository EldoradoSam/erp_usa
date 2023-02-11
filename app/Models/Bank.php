<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class bank extends Model
{
    protected $table = 'st_banks';
    protected $primaryKey = 'bank_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'bank_id',
        'bank_name',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_banks";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\BankFactory::new();
    // }
}

