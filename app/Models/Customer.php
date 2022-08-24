<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{

    protected $table = 'st_customers';
    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $keyType = 'string';
    use HasFactory;

    protected $fillable = [];

    /*protected static function newFactory()
    {

        return \Modules\St\Database\factories\CustomerFactory::new();
    }*/
}
