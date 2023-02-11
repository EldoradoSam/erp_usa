<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class GLPosting extends Model
{
    protected $table = 'st_g_l__postings';
    protected $primaryKey = 'gl_post_id';
    use HasFactory,LogsActivity;
    protected static $logAttributes = [
        'user',
        'customer_id',
        'address',
        'contact_no',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_g_l__postings";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\GLPostingFactory::new();
    // }
}

