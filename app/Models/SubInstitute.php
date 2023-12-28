<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subinstitute extends Model
{
    use HasFactory;
    protected$table='institute';
    protected $fillable=[
        'id','institute_code','institute'
    ];
}
