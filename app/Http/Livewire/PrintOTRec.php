<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class PrintOTRec extends Component
{
    Public function mount($param,$param2)
        {
            $this->param=$param; //ot_list id sub
            $this->param2=$param2; // ot range
            
        }

    public function render()
    {
       
        return view('livewire.print-o-t-rec',[
            'signaturepath'=> 'signature/test-signature1.PNG' ,
            'otrecords'=>DB::table('ot_list_status')
            ->select('ot_records.id as otid','ot_records.List_id as List_id','Nature_of_duties','name','emp_designation.designation as desig','suggest_ot_hour','director_rec_ot_hour','director_admin_rec_ot_hour')
            
            //->selectRaw("sum(`director_admin_rec_ot_hour`) as totOT")
    
            ->join("ot_list","ot_list_status.list_id","=","ot_list.id")
            ->Join("ot_records", function($join){
                $join->on("ot_list_status.list_id", "=", "ot_records.list_id")
                ->on('ot_list_status.ot_range', "=", "ot_records.ot_range");
            })

            ->join("_employees","ot_records.Emp_id","=","_employees.id")
            ->join("emp_designation","_employees.designation","=","emp_designation.id")

            ->where('ot_records.List_id','=', $this->param)
            ->where('ot_records.ot_range','=', $this->param2)
            ->where('completed','=','1')
            ->get(),
            
            
            
            'ApprovedByDirector'=>DB::table('minutes')
            ->select('name','minutes.created_at','signature')
            ->join("ot_list_status","ot_list_status.id","=","minutes.ot_list_number")
            ->join("users","users.id","=","minutes.user")
            ->where('ot_list_status.list_id','=', $this->param)
            ->where('ot_list_status.ot_range','=','r1')
            ->where('submit_level','=','6')
            ->where('type','=','A')
            ->get(),

            'ForwardByDirector_r2'=>DB::table('minutes')
            ->select('name','minutes.created_at','signature')
            ->join("ot_list_status","ot_list_status.id","=","minutes.ot_list_number")
            ->join("users","users.id","=","minutes.user")
            ->where('ot_list_status.list_id','=', $this->param)
            ->where('ot_list_status.ot_range','=','r2')
            ->where('submit_level','=','6')
            ->where('type','=','F')
            ->get(),

            'ForwardByDirector_r3'=>DB::table('minutes')
            ->select('name','minutes.created_at','signature')
            ->join("ot_list_status","ot_list_status.id","=","minutes.ot_list_number")
            ->join("users","users.id","=","minutes.user")
            ->where('ot_list_status.list_id','=', $this->param)
            ->where('ot_list_status.ot_range','=','r2')
            ->where('submit_level','=','6')
            ->where('type','=','F')
            ->get(),

            'ApprovedByDirectorAdmin'=>DB::table('minutes')
            ->select('name','minutes.created_at','signature')
            ->join("ot_list_status","ot_list_status.id","=","minutes.ot_list_number")
            ->join("users","users.id","=","minutes.user")
            ->where('ot_list_status.list_id','=', $this->param)
            ->where('ot_list_status.ot_range','=','r2')
            ->where('submit_level','=','3')
            ->where('type','=','A')
            ->get(),

            'ApprovedByADG'=>DB::table('minutes')
            ->select('name','minutes.created_at','signature')
            ->join("ot_list_status","ot_list_status.id","=","minutes.ot_list_number")
            ->join("users","users.id","=","minutes.user")
            ->where('ot_list_status.list_id','=', $this->param)
            ->where('ot_list_status.ot_range','=','r3')
            ->where('submit_level','=','2')
            ->where('type','=','A')
            ->get(),
            
            
            
            //DB::table("ot_records")
            //->select('ot_records.id as otid','ot_records.List_id as List_id','Nature_of_duties','name','emp_designation.designation as desig','suggest_ot_hour','director_rec_ot_hour','director_admin_rec_ot_hour')
            //->where('ot_records.List_id','=',124)
            //->join("_employees","ot_records.Emp_id","=","_employees.id")
            //->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
            //->join("emp_designation","_employees.designation","=","emp_designation.id")
            //->get(),
           
           
            'otlist'=>DB::table("ot_list")
            ->select('year','month','institute')
            ->where('ot_list.id','=',$this->param)
            ->join("institute","ot_list.institute_id","=","institute.id")->get()
        ]);
    }

    public function back($x){   ///otrecords/560015{param}45/0058552100154{param1}11     
        return redirect()->to('/otlist_status/'.$x.'/C');
    }
}
