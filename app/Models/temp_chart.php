<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_chart extends Model
{
    use HasFactory;
    protected$table='temp_chart';
    protected $fillable=[
        'id','month','value'
    ];
}
