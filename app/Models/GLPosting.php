<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GLPosting extends Model
{
    protected $table = 'st_g_l__postings';
    protected $primaryKey = 'gl_post_id';
    use HasFactory;

    // protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\St\Database\factories\GLPostingFactory::new();
    // }
}
