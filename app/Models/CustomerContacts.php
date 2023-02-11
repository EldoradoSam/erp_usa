<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class CustomerContacts extends Model
{
    protected $table = 'st_customer_contacts';
    protected $primaryKey = 'contact_id';
    use HasFactory,LogsActivity;
    protected $casts = [
        'sms_alert' => 'boolean',
        'email_alert' => 'boolean',
        'primary' => 'boolean',
    ];

    protected $fillable = [];
    protected static $logAttributes = [
        'contact_id',
        'customer_id',
        'designation',
        'email',
        'mobile',
        'fixed',
        'sms_alert',
        'email_alert',
        'primary',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "st_customer_contacts";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

    /*protected static function newFactory()
    {
        return \Modules\St\Database\factories\CustomerContactsFactory::new();
    }*/
}
