<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class minutes extends Model
{
    use HasFactory;
    protected$table='minutes';
    protected $fillable=[
        'id','ot_list_number','minute','type','user','submit_level'
    ];
}
