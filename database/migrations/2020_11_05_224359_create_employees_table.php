<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            
            $table->string('employee_id',25)->unique();
            $table->string('name_withinitial',250)->nullable();
            $table->string('name_sinhala',250)->nullable();
            $table->string('name_full',250)->nullable();
            $table->string('callin_name',250)->nullable();
            $table->string('address',500)->nullable();
            $table->foreignId('town_id')->nullable();
            $table->foreign('town_id')->references('town_id')->on('hr_towns')->onDelete('cascade');

            
            $table->string('nic',15)->nullable();
            $table->string('passport',25)->nullable();
            $table->string('drvl',25)->nullable();
            $table->date('birthday')->nullable();
            $table->date('date_join')->nullable();
            $table->date('resign_date')->nullable();
            $table->date('pension_date')->nullable();
            $table->date('etf_epf_date')->nullable();

            $table->date('id_issue_date')->nullable();
            $table->date('id_expire_date')->nullable();
            
            $table->integer('gender_id')->nullable();
            $table->foreignId('civilstatus_id')->nullable();
            $table->foreign('civilstatus_id')->references('civilstatus_id')->on('hr_employee_civilstatuses')->onDelete('cascade');

            $table->foreignId('designation_id')->nullable();
            $table->foreign('designation_id')->references('designation_id')->on('hr_employee_designations')->onDelete('cascade');

            $table->string('bank_account',25)->nullable();
            $table->foreignId('bank_id')->nullable();
            //$table->foreign('bank_id')->references('bank_id')->on('banks')->onDelete('cascade');

            
            $table->foreignId('bankbranch_id')->nullable();
            //$table->foreign('bankbranch_id')->references('bankbranch_id')->on('bank_branches')->onDelete('cascade');

            $table->string('photo_parth',250)->nullable();
            $table->string('email',200)->nullable()->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('fixed',20)->nullable();
            
            $table->string('gmap',200)->nullable();
            $table->string('emegency_contact',100)->nullable();
            $table->string('emegency_contactno1',20)->nullable();
            $table->string('emegency_contact2',100)->nullable();
            $table->string('emegency_contactno2',20)->nullable();
            $table->string('attendance_id',25)->nullable();
            
            $table->string('epf_no',25)->nullable();

            $table->foreignId('employeetype_id')->nullable();
            $table->foreign('employeetype_id')->references('employeetype_id')->on('hr_employee_types')->onDelete('cascade');

            $table->foreignId('employeestatus_id')->nullable();
            $table->foreign('employeestatus_id')->references('employeestatus_id')->on('hr_employee_statuses')->onDelete('cascade');

            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('hr_employee_categories')->onDelete('cascade');

            $table->foreignId('site_id')->nullable();
            $table->foreign('site_id')->references('site_id')->on('hr_employee_sites')->onDelete('cascade');
            
            $table->foreignId('department_id')->nullable();
            $table->foreign('department_id')->references('department_id')->on('hr_employee_departments')->onDelete('cascade');

            $table->foreignId('section_id')->nullable();
            $table->foreign('section_id')->references('section_id')->on('hr_employee_sections')->onDelete('cascade');

            $table->foreignId('subsection_id')->nullable();
            $table->foreign('subsection_id')->references('subsection_id')->on('hr_employee_subsections')->onDelete('cascade');

            $table->foreignId('company_id')->nullable();
            //$table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');

            $table->foreignId('moh_division_id')->nullable();
            //$table->foreign('moh_division_id')->references('moh_division_id')->on('hr_moh_divisions')->onDelete('cascade');

            $table->foreignId('police_station_id')->nullable();
            //$table->foreign('police_station_id')->references('police_station_id')->on('hr_police')->onDelete('cascade');

            $table->foreignId('gs_division_id')->nullable();
            //$table->foreign('gs_division_id')->references('gs_division_id')->on('hr_gs_divisions')->onDelete('cascade');

            $table->string('supervisor_id',25)->nullable();
            $table->string('subcontractor',250)->nullable();
            $table->date('contract_expire')->nullable();
            $table->boolean('print_status')->nullable();
            $table->boolean('email_alert')->nullable();
            $table->boolean('sms_alert')->nullable();
            $table->boolean('contract')->nullable();
            $table->integer('pay_method');
            
            
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
