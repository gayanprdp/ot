<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OT_List_Status extends Model
{
    use HasFactory;
    protected$table='ot_list_status';
    protected $fillable=[
        'id','list_id','ot_range',
        'L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11',        
        'completed','status'
        
    ];
}
