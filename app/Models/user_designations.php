<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_designations extends Model
{
    use HasFactory;
    protected$table='user_designation';
    protected $fillable=[
        'id','designation'
    ];
}
