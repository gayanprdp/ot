<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_level extends Model
{
    use HasFactory;
    protected$table='user_level';
    protected $fillable=[
        'id','user_level','designation'
    ];
}
