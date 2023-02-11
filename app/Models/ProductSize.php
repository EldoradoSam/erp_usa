<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class ProductSize extends Model
{
    use HasFactory,LogsActivity;
    protected $table = 'pp_product_sizes';
    protected $primaryKey = 'product_size_id';
    protected $fillable = [];
    protected static $logAttributes = [
        'product_size_id',
        'size',
        'status',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_product_sizes";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    
}
