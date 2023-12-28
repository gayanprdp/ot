<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OT_Records extends Model
{
    use HasFactory;
    protected$table='ot_records';
    protected $fillable=[
        'id','List_id','Emp_id','Nature_of_duties','suggest_ot_hour','director_rec_ot_hour','director_admin_rec_ot_hour','ot_range','mark','previuos_approved_hours'
    ];
}
