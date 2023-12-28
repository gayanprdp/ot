<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\OT_Records;
use App\Models\OT_list_status;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\minutes;

use Mail;
use App\Mail\SendMail;


class OTrecords extends Component
{
   
    public $isEditMode=false;
    public $Emp_id;
    public $Nature_of_duties;
    public $suggest_ot_hour;
    public $director_rec_ot_hour;
    public $director_admin_rec_ot_hour;
    public $msg;
    public $checkbox1=false;
    public $List_id;
    public $previoushours;

    public $search = '';
    public $minute;

    public $otrec;
    public $otrec1;
    public $otrec2;
    public $rcount;

    public $param;
    public $param2;
    public $param3;
    public $type;
    public $param1;
    public $a;  

        Public function mount($param,$param1,$param2,$param3,$type)
        {
            $this->param=$param; //list id 
            $this->param1=$param1; //Edit Check
            $this->param2=$param2; //OT range
            $this->param3=$param3; //sub list id 
            $this->type=$type; //ot sheet type 
            
        }



        Public function sendmail($email,$type)
        {
            if ($type=='Submit'){
                $title='Pending Notification';
                $body='You have a pending notification. Please click the below URL and check the notification.';
            }

            if ($type=='Resubmit'){
                $title='Pending Notification  ';
                $body='You have a pending notification. Please click the below URL and check the notification.';
            }


            $mailData = [
                'email'=>$email,                
                'title' => $title,
                'body' => $body
            ];
             
            Mail::to($email)->send(new SendMail($mailData));
               
            //dd("Email is sent successfully.");
            
        }
   
    public function render()
    {
        return view('livewire.otrecords',[ 
            'otrecords'=>DB::table("ot_records")
            ->where('name', 'like', '%'.$this->search.'%' )
            ->select('institute.main_institute','ot_list.institute_id','ot_records.id as otid','List_id','Nature_of_duties','name','emp_designation.designation as desig','suggest_ot_hour','director_rec_ot_hour','director_admin_rec_ot_hour','mark')
            ->join('ot_list','ot_records.List_id','=','ot_list.id')
            ->join('institute','institute.id','=','ot_list.institute_id')
            ->where('List_id','=',$this->param)
            ->where('ot_range','=',$this->param2)
            ->join("_employees","ot_records.Emp_id","=","_employees.id")
            ->join("emp_designation","_employees.designation","=","emp_designation.id")
            ->paginate(10),
        ]);
    }

    public $showingOtRecordModal = false;

    public function close()
    {        
        $this->showingOtRecordModal = false;
    }

    public function showOtRecordModal()
    {
        //$this->reset();
        $this->Emp_id=0;
        $this->Nature_of_duties="";
        $this->suggest_ot_hour="";
        $this->msg='';
        $this->isEditMode = false;
        

        $this->showingOtRecordModal = true;
    }


    public function prehours()
    {
        $preothours=DB::table("ot_list")
        ->select('year','month')
        ->where('ot_list.id','=',$this->param)
        ->get();

        foreach ($preothours as $item)
        {
            $preothours1=DB::table("ot_records")
            ->select('director_admin_rec_ot_hour')
            ->join('ot_list','ot_records.List_id','=','ot_list.id')
            ->join('ot_list_status','ot_list_status.List_id','=','ot_list.id')
            ->where('ot_list.year','=',$item->year)
            ->where('ot_list.month','=', $item->month)
            ->where('ot_records.Emp_id','=', $this->Emp_id)
            ->get();
            //dd($preothours1);
        }
        

        foreach ($preothours1 as $item)
        {
            $this->previoushours=$item->director_admin_rec_ot_hour;
        }
        //$this->reset();
        
        
    }



    public function showmsg($list_type)
    {
        $approvedothours=DB::table("emp_designation")->select('OT_range1','OT_range2','OT_range3')->where('_employees.id','=',$this->Emp_id)->join("_employees","emp_designation.id","=","_employees.designation")->get();
            $r1=0;
            $r2=0;
            $r3=0;
        foreach ($approvedothours as $item)
        {
            $r1=$item->OT_range1;
            $r2=$item->OT_range2;
            $r3=$item->OT_range3;
        }
        if ($list_type==0){
                if ($this->suggest_ot_hour <= $r1){
                        $this->msg=''; 
                    }
                elseif ($this->suggest_ot_hour <= $r2){
                        $this->msg='This record will be added to list which for Director-Admin Approval'; 
                    }
                elseif ($this->suggest_ot_hour <= $r3){
                        $this->msg='This record will be added to list which for ADG Approval'; 
                    }
                else{
                        $this->msg=''; 
                    }
        }else{
                if (($this->suggest_ot_hour+$this->previoushours) <= $r1){
                        $this->msg=''; 
                    }
                elseif (($this->suggest_ot_hour+$this->previoushours) <= $r2){
                        $this->msg='This record will be added to list which for Director-Admin Approval'; 
                    }
                elseif (($this->suggest_ot_hour+$this->previoushours) <= $r3){
                        $this->msg='This record will be added to list which for ADG Approval'; 
                    }
                else{
                        $this->msg=''; 
                    }

        }

        
    }

    public function storeOtRecords($listid,$list_type)
    {
       
        $approvedothours=DB::table("emp_designation")->select('OT_range1','OT_range2','OT_range3')->where('_employees.id','=',$this->Emp_id)->join("_employees","emp_designation.id","=","_employees.designation")->get();
        foreach ($approvedothours as $item)
        {
            $r1=$item->OT_range1;
            $r2=$item->OT_range2;
            $r3=$item->OT_range3;
        }

        //$liststatus=DB::table("ot_list_status")->where('list_id.id','=',$listid)

       // dd($listid);

        if ((Auth::user()->user_level == 8)  ){
            $this->validate([
                'Emp_id'=>'Required|unique:ot_records,Emp_id,,,List_id,'.$listid.'',
                'Nature_of_duties'=>'Required',
                //'ot_range'=>'Required',
                //'suggest_ot_hour'=>'Required|integer|between:1,'.$r1.'',
                'suggest_ot_hour'=>'Required|integer',
            ]);
                    if($list_type==0){
                        if ($this->suggest_ot_hour <= $r1)
                            {
                                $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r1');
                                        if ($liststatus->count()==0){
                                            OT_Records::create([
                                            'Emp_id' =>$this->Emp_id,
                                            'Nature_of_duties'=>$this->Nature_of_duties,
                                            'List_id'=>$listid,                
                                            'ot_range'=>'r1',
                                            'suggest_ot_hour'=>$this->suggest_ot_hour,
                                            'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                            'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                            ]);
                                        }else{
                                            $this->msg='Can\'t add this record! Director Approval OT-Sheet already Submitted';
                                            goto x;
                                        }
                            }
                            
                            elseif ($this->suggest_ot_hour <= $r2)
                            {
                                $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r2');
                                        if ($liststatus->count()==0){
                                            OT_Records::create([
                                            'Emp_id' =>$this->Emp_id,
                                            'Nature_of_duties'=>$this->Nature_of_duties,
                                            'List_id'=>$listid,                
                                            'ot_range'=>'r2',
                                            'suggest_ot_hour'=>$this->suggest_ot_hour,
                                            'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                            'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                            ]);

                                            $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r2')->firstOrFail();
                                            $this->otrec1->update([
                                                'status' =>'1',
                                            ]);
                                        }else{
                                            $this->msg='Can\'t add this record! Director-Admin Approval OT-Sheet already Submitted';
                                            goto x;
                                        }
                                
                            }
                            elseif ($this->suggest_ot_hour <= $r3)
                            {
                                $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r3');
                                        if ($liststatus->count()==0){
                                            OT_Records::create([
                                            'Emp_id' =>$this->Emp_id,
                                            'Nature_of_duties'=>$this->Nature_of_duties,
                                            'List_id'=>$listid,                
                                            'ot_range'=>'r3',
                                            'suggest_ot_hour'=>$this->suggest_ot_hour,
                                            'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                            'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                            ]);
                                            $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r3')->firstOrFail();
                                            $this->otrec1->update([
                                                'status' =>'1',
                                            ]);
                                        }else{
                                            $this->msg='Can\'t add this record! ADG Approval OT-Sheet already Submitted';
                                            goto x;
                                        }
                            }
                    }else{
                        if ($this->suggest_ot_hour+$this->previoushours <= $r1)
                        {
                            $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r1');
                                    if ($liststatus->count()==0){
                                        OT_Records::create([
                                        'Emp_id' =>$this->Emp_id,
                                        'Nature_of_duties'=>$this->Nature_of_duties,
                                        'List_id'=>$listid,                
                                        'ot_range'=>'r1',
                                        'suggest_ot_hour'=>$this->suggest_ot_hour,
                                        'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'previuos_approved_hours'=>$this->previoushours,
                                        ]);
                                    }else{
                                        $this->msg='Can\'t add this record! Director Approval OT-Sheet already Submitted';
                                        goto x;
                                    }
                        }
                        
                        elseif ($this->suggest_ot_hour+$this->previoushours <= $r2)
                        {
                            $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r2');
                                    if ($liststatus->count()==0){
                                        OT_Records::create([
                                        'Emp_id' =>$this->Emp_id,
                                        'Nature_of_duties'=>$this->Nature_of_duties,
                                        'List_id'=>$listid,                
                                        'ot_range'=>'r2',
                                        'suggest_ot_hour'=>$this->suggest_ot_hour,
                                        'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'previuos_approved_hours'=>$this->previoushours,
                                        ]);

                                        $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r2')->firstOrFail();
                                        $this->otrec1->update([
                                            'status' =>'1',
                                        ]);
                                    }else{
                                        $this->msg='Can\'t add this record! Director-Admin Approval OT-Sheet already Submitted';
                                        goto x;
                                    }
                            
                        }
                        elseif ($this->suggest_ot_hour+$this->previoushours <= $r3)
                        {
                            $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L8','=','1')->where('ot_range','=','r3');
                                    if ($liststatus->count()==0){
                                        OT_Records::create([
                                        'Emp_id' =>$this->Emp_id,
                                        'Nature_of_duties'=>$this->Nature_of_duties,
                                        'List_id'=>$listid,                
                                        'ot_range'=>'r3',
                                        'suggest_ot_hour'=>$this->suggest_ot_hour,
                                        'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                        'previuos_approved_hours'=>$this->previoushours,
                                        ]);
                                        $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r3')->firstOrFail();
                                        $this->otrec1->update([
                                            'status' =>'1',
                                        ]);
                                    }else{
                                        $this->msg='Can\'t add this record! ADG Approval OT-Sheet already Submitted';
                                        goto x;
                                    }
                        }

                    }

           
            //$this->reset();
            $this->showingOtRecordModal=false;
            x:
        }      
        
        

        if ((Auth::user()->user_level == 11)  ){
            $this->validate([
                'Emp_id'=>'Required|unique:ot_records,Emp_id,,,List_id,'.$listid.'',
                'Nature_of_duties'=>'Required',
                //'ot_range'=>'Required',
                //'suggest_ot_hour'=>'Required|integer|between:1,'.$r1.'',
                'suggest_ot_hour'=>'Required|integer',
            ]);
        
                                if($list_type==0){
                                            if ($this->suggest_ot_hour <= $r1)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r1');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r1',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! Director Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                }
                                                
                                                elseif ($this->suggest_ot_hour <= $r2)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r2');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r2',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                ]);

                                                                $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r2')->firstOrFail();
                                                                $this->otrec1->update([
                                                                    'status' =>'1',
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! Director-Admin Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                    
                                                }
                                                elseif ($this->suggest_ot_hour <= $r3)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r3');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r3',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                ]);
                                                                $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r3')->firstOrFail();
                                                                $this->otrec1->update([
                                                                    'status' =>'1',
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! ADG Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                }
                                }else{
                                                if ($this->suggest_ot_hour+$this->previoushours <= $r1)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r1');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r1',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'previuos_approved_hours'=>$this->previoushours,
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! Director Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                }
                                                
                                                elseif ($this->suggest_ot_hour+$this->previoushours <= $r2)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r2');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r2',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'previuos_approved_hours'=>$this->previoushours,
                                                                ]);

                                                                $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r2')->firstOrFail();
                                                                $this->otrec1->update([
                                                                    'status' =>'1',
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! Director-Admin Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                    
                                                }
                                                elseif ($this->suggest_ot_hour+$this->previoushours <= $r3)
                                                {
                                                    $liststatus=DB::table("ot_list_status")->where('list_id','=',$listid)->where('L11','=','1')->where('ot_range','=','r3');
                                                            if ($liststatus->count()==0){
                                                                OT_Records::create([
                                                                'Emp_id' =>$this->Emp_id,
                                                                'Nature_of_duties'=>$this->Nature_of_duties,
                                                                'List_id'=>$listid,                
                                                                'ot_range'=>'r3',
                                                                'suggest_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,
                                                                'previuos_approved_hours'=>$this->previoushours,
                                                                ]);
                                                                $this->otrec1=OT_List_status::where('list_id','=',$listid)->where('ot_range','=','r3')->firstOrFail();
                                                                $this->otrec1->update([
                                                                    'status' =>'1',
                                                                ]);
                                                            }else{
                                                                $this->msg='Can\'t add this record! ADG Approval OT-Sheet already Submitted';
                                                                goto y;
                                                            }
                                                }

                                }

           
            //$this->reset();
            $this->showingOtRecordModal=false;
            //return back();
            y:
        }              



    }

    public function highlight($id)
    {
        $this->otrec1=OT_Records::findOrFail($id);
        if ($this->otrec1->mark==0)
        {
        $this->otrec1->update([
            'mark' =>'1',
        ]);
        }else{
            $this->otrec1->update([
                'mark' =>'0',
            ]); 
        }
        
        //
        
        
        
        

    }


    public function showEditOtRecordModel($id)
    {
        $this->otrec=OT_Records::findOrFail($id);
        $this->Emp_id=$this->otrec->Emp_id;
        $this->Nature_of_duties=$this->otrec->Nature_of_duties;
        $this->suggest_ot_hour=$this->otrec->suggest_ot_hour;
        $this->director_rec_ot_hour=$this->otrec->director_rec_ot_hour;
        $this->director_admin_rec_ot_hour=$this->otrec->director_admin_rec_ot_hour;
        $this->previoushours=$this->otrec->previuos_approved_hours;
        $this->List_id=$this->List_id;
        $this->isEditMode = true;
        $this->showingOtRecordModal=true;
        

    }


    public function editOtRec($list_id,$list_type)
    {
        $approvedothours=DB::table("emp_designation")->select('OT_range1','OT_range2','OT_range3')->where('_employees.id','=',$this->Emp_id)->join("_employees","emp_designation.id","=","_employees.designation")->get();
        foreach ($approvedothours as $item)
        {
            $r1=$item->OT_range1;
            $r2=$item->OT_range2;
            $r3=$item->OT_range3;
        }

        if ((Auth::user()->user_level == 11) || (Auth::user()->user_level == 8) || (Auth::user()->user_level == 7) ){
            $this->validate([  
                'Emp_id'=>'Required',
                'Nature_of_duties'=>'Required',
                'suggest_ot_hour'=>'Required|integer',
            ]);
                        if($list_type==0){
                                    if ($this->suggest_ot_hour <= $r1)
                                    {
                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r1')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r1','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]);
                                                }else{
                                                    $this->msg='Can\'t edit this record! Director Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }        
                                    elseif ($this->suggest_ot_hour <= $r2)
                                    {
                                        //dd($x);

                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r2')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r2','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]); 
                                                    
                                                    $this->otrec2=OT_List_status::where('list_id','=',$list_id)->where('ot_range','=','r2')->firstOrFail();
                                                    $this->otrec2->update([
                                                        'status' =>'1',
                                                    ]);
                                                    

                                                }else{
                                                    $this->msg='Can\'t edit this record! Director-Admin Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }
                                    elseif ($this->suggest_ot_hour <= $r3)
                                    {
                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r3')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r3','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]);    
                                                    $this->otrec2=OT_List_status::where('list_id','=',$list_id)->where('ot_range','=','r3')->firstOrFail();
                                                    $this->otrec2->update([
                                                        'status' =>'1',
                                                    ]);
                                                }else{
                                                    $this->msg='Can\'t edit this record! ADG Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }
                        }else{
                                    if ($this->suggest_ot_hour+$this->previoushours <= $r1)
                                    {
                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r1')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r1','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]);
                                                }else{
                                                    $this->msg='Can\'t edit this record! Director Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }        
                                    elseif ($this->suggest_ot_hour+$this->previoushours <= $r2)
                                    {
                                        //dd($x);

                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r2')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r2','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]); 
                                                    
                                                    $this->otrec2=OT_List_status::where('list_id','=',$list_id)->where('ot_range','=','r2')->firstOrFail();
                                                    $this->otrec2->update([
                                                        'status' =>'1',
                                                    ]);
                                                    

                                                }else{
                                                    $this->msg='Can\'t edit this record! Director-Admin Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }
                                    elseif ($this->suggest_ot_hour+$this->previoushours <= $r3)
                                    {
                                        $liststatus=DB::table("ot_list_status")->where('list_id','=',$list_id)->where('ot_range','=','r3')->where('L11','=','1');
                                                if ($liststatus->count()==0){
                                                    $this->otrec->update(['Nature_of_duties' =>$this->Nature_of_duties,'Emp_id'=>$this->Emp_id,'ot_range'=>'r3','suggest_ot_hour'=>$this->suggest_ot_hour,'director_rec_ot_hour'=>$this->suggest_ot_hour,'director_admin_rec_ot_hour'=>$this->suggest_ot_hour,'mark' =>0,]);    
                                                    $this->otrec2=OT_List_status::where('list_id','=',$list_id)->where('ot_range','=','r3')->firstOrFail();
                                                    $this->otrec2->update([
                                                        'status' =>'1',
                                                    ]);
                                                }else{
                                                    $this->msg='Can\'t edit this record! ADG Approval OT-Sheet already Submitted';
                                                    goto x;
                                                }
                                    }

                        }

            $this->showingOtRecordModal=false;
            x:
        }


        if ((Auth::user()->user_level == 6) ){
            $this->validate([  
                'Emp_id'=>'Required',
                'Nature_of_duties'=>'Required',
                //'suggest_ot_hour'=>'Required|integer',
            ]);
//dd($this->director_rec_ot_hour);
            
                $this->otrec->update([
                    'Nature_of_duties' =>$this->Nature_of_duties,
                    'Emp_id'=>$this->Emp_id,
                    //'ot_range'=>'r1',
                    //'suggest_ot_hour'=>$this->suggest_ot_hour,
                    'director_rec_ot_hour'=>$this->director_rec_ot_hour,
                    'director_admin_rec_ot_hour'=>$this->director_rec_ot_hour,
                    'mark' =>0,
              
                ]);
           

            
            //$this->reset();
            $this->showingOtRecordModal=false;
        }
   
        
        if ((Auth::user()->user_level == 1) || (Auth::user()->user_level == 2) || (Auth::user()->user_level == 3)|| (Auth::user()->user_level == 4)|| (Auth::user()->user_level == 5)){
            $this->validate([  
                'Emp_id'=>'Required',
                'Nature_of_duties'=>'Required',
                //'director_admin_rec_ot_hour'=>'Required|integer|between:1,'.$ApproverOTHHours.'',
                'suggest_ot_hour'=>'Required|integer',
            ]);

        

            $this->otrec->update([
                'Nature_of_duties' =>$this->Nature_of_duties,
                'Emp_id'=>$this->Emp_id,
                //'suggest_ot_hour'=>$this->suggest_ot_hour,
                //'director_rec_ot_hour'=>$this->director_rec_ot_hour,
                'director_admin_rec_ot_hour'=>$this->director_admin_rec_ot_hour,
                'mark' =>0,
            ]);
            //$this->reset();
            $this->showingOtRecordModal=false;
        }
    }
  
    public $confirming;
    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        OT_Records::destroy($id);
    }

    public function printotrecords($x){//Session::put('recordID',$x);
        return redirect()->to('/printotrecords/'.$x);
    }

//********************************************************************************** */
public $deleteID;
public $showingdeletemodal = false;
public function ShowDeleteModal($p)
{
    
    $this->deleteID=$p;        
    $this->showingdeletemodal = true;
}

public function DeleteModal()
{
    OT_Records::destroy($this->deleteID);
    $this->showingdeletemodal = false;
}

public function HideDeleteModal()
{      
    $this->showingdeletemodal = false;
}

//********************************************************************************** */


public function back($step)
    {
        $this->currentStep = $step;    
    }

    public function Submit($id,$level){
        dd($level);
        if ($level=='11'){
            $this->otrec=OT_List_Status::findOrFail($id);
            $this->otrec->update(['L11'=>1,]);
            minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>11,'user'=>Auth::user()->id,]);
            $this->param1='1';
            $this->showingforwardmodal = false;    
        }
        
    }

   


    public function Submit11($id){
        
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L11'=>1,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>11,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;


        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',10)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');

    }

    public function Submit10($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L10'=>1,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>10,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',9)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit9($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L9'=>1,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>9,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',8)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit8($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L8'=>1,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>8,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',7)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit7($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L7'=>1,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>7,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',6)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit6($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L6'=>1,]); 
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>6,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',5)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit5($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L5'=>1,]); 
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>5,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',4)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit4($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L4'=>1,]); 
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>4,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',3)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function Submit3($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L3'=>1,]); 
        minutes::create(['ot_list_number' =>$id,'type'=>"F",'minute'=>$this->minute,'submit_level'=>3,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',2)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Submit');
    }

    public function approve_ADG($id){
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L2'=>1,'completed'=>1,]); 
        minutes::create(['ot_list_number' =>$id,'type'=>"A",'minute'=>$this->minute,'submit_level'=>2,'user'=>Auth::user()->id,]);
        $this->param1='1';
        $this->showingforwardmodal = false;
    }


    public function approve_Director($id)
    {
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L6'=>1,            
            'completed'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"A",
            'minute'=>$this->minute,
            'submit_level'=>6,
            'user'=>Auth::user()->id,
        ]);
        $this->param1='1';
        $this->showingforwardmodal = false;

    }

    public function approve_Director_Admin($id)
    {
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L3'=>1,            
            'completed'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"A",
            'minute'=>$this->minute,
            'submit_level'=>3,
            'user'=>Auth::user()->id,
        ]);
        $this->param1='1';
        $this->showingforwardmodal = false;

    }


    public $SubmitID;
   public $OT_range;
   public $showingforwardmodal = false;
   public function ShowForwardModal()
   {               
       $this->showingforwardmodal = true;
   }

   public function HideForwardModal()
   {               
       $this->showingforwardmodal = false;
   }

   public $showingResubmitmodal = false;
   public function ShowResubmitModal()
   {               
       $this->showingResubmitmodal = true;
   }

   public function HideResubmitModal()
   {               
       $this->showingResubmitmodal = false;
   }

   public function ReSubmit10($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L11'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>10,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        


        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',11)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit9($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L10'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>9,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',10)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit8($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L9'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>8,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',9)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }


    public function ReSubmit7($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L8'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>7,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',8)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit6($id,$sub_institute){

                        
                            if ((Auth::user()->institute==$sub_institute)){
                                $this->validate(['minute'=>'Required',]);
                                $this->otrec=OT_List_Status::findOrFail($id);
                                $this->otrec->update(['L7'=>0,'L8'=>0,'L9'=>0]);
                                minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>6,'user'=>Auth::user()->id,]);
                                $this->showingResubmitmodal = false;
                                
                                
                                $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',7)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
                                foreach ($email as $item)
                                {
                                    $email=$item->email;            
                                }
                                $this->sendmail($email,'Resubmit');
                                
                                return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);  

                            }else{
                                $this->validate(['minute'=>'Required',]);
                                $this->otrec=OT_List_Status::findOrFail($id);
                                $this->otrec->update(['L7'=>0,]);
                                minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>6,'user'=>Auth::user()->id,]);
                                $this->showingResubmitmodal = false;
                                

                                $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',7)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
                                foreach ($email as $item)
                                {
                                    $email=$item->email;            
                                }
                                $this->sendmail($email,'Resubmit');
                                
                                return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
                            }


        
    }

    public function ReSubmit5($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L6'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>5,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',6)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit4($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L5'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>4,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',5)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit3($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L4'=>0,'L5'=>0,'L6'=>0]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>3,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',4)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

    public function ReSubmit2($id){
        $this->validate(['minute'=>'Required',]);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update(['L3'=>0,]);
        minutes::create(['ot_list_number' =>$id,'type'=>"B",'minute'=>$this->minute,'submit_level'=>2,'user'=>Auth::user()->id,]);
        $this->showingResubmitmodal = false;
        

        $email=DB::table("ot_list")->select('institute_id','email')->where('users.user_level','=',3)->where('ot_list_status.id','=',$id)->where('ot_list_status.id','=',$id)->join("users","users.institute","=","ot_list.institute_id")->leftjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")->get();
        foreach ($email as $item)
        {
            $email=$item->email;            
        }
        $this->sendmail($email,'Resubmit');
        
        return redirect()->route('ot.list', ['param' =>  Auth::user()->institute ]);
    }

   

}
