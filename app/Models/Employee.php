<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    protected $table = 'hr_employees';
    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory,LogsActivity;

    protected static $logAttributes = [
        'employee_id',
        'name_withinitial',
        'name_sinhala',
        'name_full',
        'callin_name',
        'address',
        'town_id',
        'town_id',

        'nic',
        'passport',
        'drvl',
        'birthday',
        'date_join',
        'resign_date',
        'pension_date',
        'etf_epf_date',

        'id_issue_date',
        'id_expire_date',

        'gender_id',
        'civilstatus_id',

        'designation_id',
        'bank_account',
        'bank_id',

        'bankbranch_id',

        'photo_parth',
        'email',
        'mobile',
        'fixed',

        'gmap',
        'emegency_contact',
        'emegency_contactno1',
        'emegency_contact2',
        'emegency_contactno2',
        'attendance_id',

        'epf_no',

        'employeetype_id',
        'employeestatus_id',
        'category_id',
        'site_id',
        'department_id',
        'section_id',
        'subsection_id',
        'company_id',
        'moh_division_id',
        'police_station_id',
        'gs_division_id',
        'supervisor_id',

        'subcontractor',
        'contract_expire',
        'print_status',
        'email_alert',
        'sms_alert',
        'contract',
        'pay_method',
        'notes',

    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "hr_employees";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }
}

