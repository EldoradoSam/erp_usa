<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
class CustomerOrderData extends Model
{
    use HasFactory,LogsActivity;

    protected $table = 'pp_customer_orders_data';
    protected $primaryKey = 'order_data_id';
    public $incrementing = false;
    protected $keyType = 'string';

    //by nipuna start
    protected $casts = [
        'vegetableCheck' => 'boolean',
        'berryCheck' => 'boolean',
        'flowersCheck' => 'boolean',
        'PCMCheck' => 'boolean',
        'OthersCheck' => 'boolean',
    ];
    //by nipuna end



    protected static $logAttributes = [
        'order_data_id',
        'order_id',
        'product_type',
        'product_code',
        'product_dimensions',
        'product_mix_id',
        'washed_level_id',
        'naked_plank',
        'slab_position',
        'dripper_holes',
        'no_of_dripper',
        'drain_holes',
        'no_of_drain',
        'drain_holes_size',
        'drain_holes_shape',
        'dug_holes',
        'no_of_dug',
        'dug_holes_size',
        'vegetableCheck',
        'berryCheck',
        'flowersCheck',
        'PCMCheck',
        'OthersCheck',
        'plant_holes',
        'no_of_plant',
        'plant_holes_size',
        'standing_Lying',
        'Bio_Degratable_Bags',
        'pallet',
        'Bottom_Mesh_Liner',
        'Boxes_Cases',
        'pcs_per_boxes',
        'boxes_pallet',
        'boxes_master_cartoon',
        'master_cartoon_pallets',
        'quantity_pieces',
        'token',
    ];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->log_name = "pp_customer_orders_data";
        $activity->description = $eventName;
        $activity->causer_id = Auth::user()->id;
    }

}
