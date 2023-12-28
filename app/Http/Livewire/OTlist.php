<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\OT_list_status;
use App\Models\OT_List;
use App\Models\OT_Records;
use App\Models\minutes;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\institute;



class OTlist extends Component
{

    public $isEditMode;

    public $year;
    public $month;
    public $institute_id;

    public $insti;
    public $otrec;

    public $search = '';
    public $minute;
    public $type;
    
    use WithPagination;



    
  

    public function render()
    {
        $pagienateVal=10;
        {{Session::put('notification','1');}}
        //Level 1 - Administrator ****************************************************************************************************
        if (Auth::user()->user_level==1 ){
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                })
                ->orderBy('ot_list.id','DESC')                
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get() 
            ]);

            
            //Level 2 Additional Director General (Admin) ****************************************************************************************************
        }
        elseif(Auth::user()->user_level==2 ) {   
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where('L3','=','1')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })   
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                })  
                ->orderBy('ot_list.id','DESC')             
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);


            //Level 3 Director(Admin)****************************************************************************************************
        }
        elseif(Auth::user()->user_level==3 ) {   
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where('L4','=','1')
                ->where('L3','=','0')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                })  
                ->orderBy('ot_list.id','DESC')             
                ->paginate($pagienateVal)  ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
            ]);

         //Level 4 Administrative Officer / Chief Clerk (Admin) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==4 ) {   
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where('L5','=','1')
                ->where('L2','=','0')
                
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->orderBy('ot_list.id','DESC')              
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()   
            ]);



            //Level 5 Subject Officer (Admin)************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==5 ) {   
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where('L6','=','1')
                ->where('L4','=','0')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                })
                ->orderBy('ot_list.id','DESC')              
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);


         //Level 6 Director / Chief Engineer / Chief Accountant************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==6 ) {   
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')

                ->where('L7','=','1')
                ->where('L5','=','0')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                }) 
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                }) 
                ->orderBy('ot_list.id','DESC')               
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);


        //Level 7 Administrative Officer / Chief Clerk ****************************************************************************************************
        }elseif(Auth::user()->user_level==7 ) {


            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")

                //->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')
                ->where('L8','=','1')
                ->where('L6','=','0')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                }) 
                ->orderBy('ot_list.id','DESC')             
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);




        }
        //Level 8 Subject Officer ****************************************************************************************************
        elseif(Auth::user()->user_level==8 ){
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','main_institute','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                //->join("ot_records","ot_records.List_id","=","ot_list.id")
                //->join("ot_list_status","ot_list_status.ot_range","=","ot_records.ot_range")

                ->where('completed','=','0')                
                ->where('L9','=','1')
                ->where('L7','=','0')        
                 
                //->groupBy('institute','year','month','ot_range')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 

                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                }) 
                ->orderBy('ot_list.id','DESC')
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()

                
                
            ]);
        }


        //Level 9 Subject Officer sub institute****************************************************************************************************
        elseif(Auth::user()->user_level==9 ){
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                //->join("ot_records","ot_records.List_id","=","ot_list.id")
                //->join("ot_list_status","ot_list_status.ot_range","=","ot_records.ot_range")

                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')
                ->where('L10','=','1')
                ->where('L8','=','0')  
                
                ->groupBy('year','month','ot_range','type')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->orderBy('ot_list.id','DESC')
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()

                
                
            ]);
        }


        //Level 10 Subject Officer sub institute****************************************************************************************************
        elseif(Auth::user()->user_level==10 ){
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                //->join("ot_records","ot_records.List_id","=","ot_list.id")
                //->join("ot_list_status","ot_list_status.ot_range","=","ot_records.ot_range")

                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')
                ->where('L11','=','1')
                ->where('L9','=','0')  
                
                ->groupBy('year','month','ot_range','type')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->orderBy('ot_list.id','DESC')
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()

                
                
            ]);
        }

        //Level 11 Subject Officer sub institute****************************************************************************************************
        elseif(Auth::user()->user_level==11 ){
            return view('livewire.otlist',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid','institute.id as insid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                //->join("ot_records","ot_records.List_id","=","ot_list.id")
                //->join("ot_list_status","ot_list_status.ot_range","=","ot_records.ot_range")

                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','0')
                ->where('L10','=','0')
                
                ->groupBy('year','month','ot_range','type')
                ->where(function($a) {
                    $a->where('institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('year', 'like', '%'.$this->search.'%' )
                    ->orwhere('month', 'like', '%'.$this->search.'%' )  
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%' )
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%' )  ;
                })  
                
                ->where(function($b) {
                    $b->where('status', '=', '1' );
                }) 
                ->orderBy('ot_list.id','DESC')
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()

                
                
            ]);
        }

    }


    public $showingOtListModal = false;
    public function showOtListModal()
    {
        $this->reset();
        $this->showingOtListModal = true;
    }

    public function close()
    {        
        $this->showingOtListModal = false;
    }

    public function storeOtList($x)
    {
        //dd($this->type);

        
       
        $this->validate([
            'year'=>'Required',
            'type'=>'Required',
            'month'=>'Required|unique:ot_list,month,,,year,'.$this->year.',institute_id,'.$x.',type,'.$this->type.'',
            
            //|multiple_unique:'.YOUR_MODEL_HERE::class.',FIELD_1,FIELD_2,FIELD_3...'
        ]);


       
            OT_List::create([
            'year' =>$this->year,
            'month'=>$this->month,
            'institute_id'=>$x,
            'type'=>$this->type,
            ]); 
        
        


        $last_list_id=DB::table("ot_list")->max('id');
       
        if(Auth::user()->user_level==8){
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r1',
                'status'=>'1',
                'L11'=>1,
                'L9'=>1,
                'L10'=>1,
            ]);
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r2',
                'L11'=>1,
                'L9'=>1,
                'L10'=>1,
            ]);
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r3',
                'L11'=>1,
                'L9'=>1,
                'L10'=>1,
            ]);
        }else{
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r1',
                'status'=>'1',
            ]);
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r2',
            ]);
            OT_list_status::create([
                'list_id' =>$last_list_id,
                'ot_range'=>'r3',
            ]);
        }

        $this->reset();
    }




    public $confirming;
    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        OT_List::destroy($id);
    }

    
    public function viewotrecords($x,$y,$z,$a,$b){        
        return redirect()->to('/otrecords/'.$x.'/'.$y.'/'.$z.'/'.$a.'/'.$b);
    }

    public function back(){        
        return redirect()->to('/otdashboard');
    }


    
    public function printotrecords($x){//Session::put('recordID',$x);
        return redirect()->to('/printotrecords/'.$x);
    }


    public function Submit8($id){
        //dd ($id);
        

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L8'=>1,
            

            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>8,
            'user'=>Auth::user()->id,
            
        ]);

        $this->reset();
        

    }


    public function Submit7($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L7'=>1,

            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>8,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function RESubmit7($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L8'=>0,
            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>2,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }


    public function Submit6($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L6'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>3,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function RESubmit6($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L7'=>0,
            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>3,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }


    public function Submit5($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L5'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>4,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function RESubmit5($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L6'=>0,
            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>4,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function Submit4($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L4'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>5,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }


    


    public function RESubmit4($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L5'=>0,
            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>5,
            'user'=>Auth::user()->id,
        ]);


        $this->reset();

    }

    public function Submit3($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L3'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>6,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function RESubmit3($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L4'=>0,
            
        ]);

        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>6,
            'user'=>Auth::user()->id,
        ]);


        $this->reset();

    }

    public function ApproveDA($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L3'=>1,            
            'completed'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"F",
            'minute'=>$this->minute,
            'submit_level'=>6,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function Submit2($id){
        //dd ($id);
        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L2'=>1,
            'completed'=>1,
            
        ]);

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"A",
            'minute'=>$this->minute,
            'submit_level'=>7,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function RESubmit2($id){
        //dd ($id);

        $this->validate([
            'minute'=>'Required',            
        ]);

        $this->otrec=OT_List_Status::findOrFail($id);
        $this->otrec->update([
            'L3'=>0,
            
        ]);

        
        

        minutes::create([
            'ot_list_number' =>$id,
            'type'=>"B",
            'minute'=>$this->minute,
            'submit_level'=>7,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }

    public function approve($id)
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
            'submit_level'=>3,
            'user'=>Auth::user()->id,
        ]);

        $this->reset();

    }





    //*******Delete Confirmation*************************************************************************** */
    public $deleteID;
    public $showingdeletemodal = false;
    public function ShowDeleteModal($p)
    {
        $this->reset();
        $this->deleteID=$p;        
        $this->showingdeletemodal = true;
    }

    public function DeleteModal()
    {
        OT_List::destroy($this->deleteID);
        $this->showingdeletemodal = false;
    }

    public function HideDeleteModal()
    {      
        $this->showingdeletemodal = false;
    }
    //******************************************************************************* */


   //******submit confirmation********************************************************** */
   public $SubmitID;
   public $OT_range;
   public $showingsubmitmodal = false;
   public function ShowSubmitModal($p,$q)
   {
       $this->reset();
       $this->SubmitID=$p; 
       $this->OT_range=$q;          
       $this->showingsubmitmodal = true;
   }

   public function SubmitModal()
   {
       OT_List::destroy($this->deleteID);
       $this->showingsubmitmodal = false;
   }

   public function HideSubmitModal()
   {      
    $this->reset();
       $this->showingsubmitmodal = false;
   }
   //********************************************************************************** */

   public function test($x)
   {

   }
}
