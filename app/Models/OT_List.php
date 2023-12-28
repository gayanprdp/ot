<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OT_list extends Model
{
    use HasFactory;
    protected$table='ot_list';
    protected $fillable=[
        'id','year','month','institute_id','type',
               
        'completed',
        
    ];
}
