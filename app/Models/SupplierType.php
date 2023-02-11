<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class SupplierType extends Model
{
    protected $table = 'st_supplier_types';
    protected $primaryKey = 'supplier_type_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'supplier_type_id',
        'supplier_type',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_supplier_types";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\SupplierTypeFactory::new();
    // }
}
