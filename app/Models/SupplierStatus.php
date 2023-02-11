<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class SupplierStatus extends Model
{
    protected $table = 'st_supplier_statuses';
    protected $primaryKey = 'supplier_status_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'supplier_status_id',
        'supplier_status',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_supplier_statuses";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\SupplierStatusFactory::new();
    // }
}

