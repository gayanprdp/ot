<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected$table='_employees';
    protected $fillable=[
        'emp_no','nic','name','designation','institute'
    ];
}
