<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerContacts extends Model
{
    protected $table = 'st_customer_contacts';
    protected $primaryKey = 'contact_id';
    use HasFactory;
    protected $casts = [
        'sms_alert' => 'boolean',
        'email_alert' => 'boolean',
        'primary' => 'boolean',
    ];

    protected $fillable = [];


}
