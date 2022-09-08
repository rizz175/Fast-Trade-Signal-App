<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forex extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'symbol','type','tp','sl','lot','deleted_at','profit'
    ];
    
}
