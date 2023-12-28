<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\OT_List;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\institute;



class OTlist_status extends Component
{

    public $isEditMode;

    public $year;
    public $month;
    public $status;
    public $institute_id;
    public $institute;

    public $insti;
    public $otrec;

    public $search = '';
    use WithPagination;


    public $param2;
    public function mount($param2){
       if ($param2=="C"){
          $this->status="C";  
       }
       if ($param2=="I"){
        $this->status="I";  
     }
        
    }
    
  

    public function render()
    {
        $pagienateVal=10;
        {{Session::put('notification','1');}}
        //Level 1 - Administrator ****************************************************************************************************
        if (Auth::user()->user_level==1 ){
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                //   $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))
                
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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
            ]);

            
            //Level 2 Additional Director General (Admin) ****************************************************************************************************
        }
        elseif(Auth::user()->user_level==2 ) {     
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                //    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))

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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()   
            ]);


            //Level 3 Director(Admin)****************************************************************************************************
        }
        elseif(Auth::user()->user_level==3 ) {    
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                //    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))

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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);

         //Level 4 Administrative Officer / Chief Clerk (Admin) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==4 ) {   
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                //    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))

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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()   
            ]);



            //Level 5 Subject Officer (Admin)************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==5 ) {     
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                //    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))

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
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);


         //Level 6 Director / Chief Engineer / Chief Accountant************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==6 ) {      
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                })
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                 //   $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))

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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()   
            ]);


        //Level 7 Administrative Officer / Chief Clerk ****************************************************************************************************
    }elseif(Auth::user()->user_level==7 ) {


            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->join("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                })
                
                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->year == "", (function ($a) {
                  //  $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))
              

                 
  
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
                ->paginate($pagienateVal) ,
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()  
            ]);




        }//Level 8 Subject Officer ****************************************************************************************************
        elseif(Auth::user()->user_level==8 ){
            
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->rightjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                ->where(function($c) {
                    $c->where('institute_id', '=', Auth::user()->institute )
                    ->orwhere('institute.main_institute', '=', Auth::user()->institute);
                })
                

                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))                

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
               

                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))
                
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
                ->paginate($pagienateVal),
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
                
            ]);
        }

        elseif(Auth::user()->user_level==9 || Auth::user()->user_level==10  || Auth::user()->user_level==11 ){
            
            return view('livewire.otlist_status',[
                'otlist'=>DB::table('ot_list')
                ->select('type','ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','L9','L10','L11','completed','ot_range','ot_list_status.id as otlistid')
                ->join("institute","ot_list.institute_id","=","institute.id")
                
                ->rightjoin("ot_list_status","ot_list_status.list_id","=","ot_list.id")
                ->where('institute_id', '=', Auth::user()->institute )
                

                ->when($this->status == "C", (function ($a) {
                    $a->where('completed', '=', '1' );
                }))

                ->when($this->status == "I", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))

                ->when($this->status == "", (function ($a) {
                    $a->where('completed', '=', '0' );
                }))                

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
               

                ->when($this->institute != "", (function ($b) {
                    $b->where('institute.id', '=', ''.$this->institute.'' );
                }))
                
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
                ->paginate($pagienateVal),
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



    public function storeOtList($x)
    {
        //dd($x);

        
       
        $this->validate([
            'year'=>'Required',
            'month'=>'Required|unique:ot_list,month,,,year,'.$this->year.',institute_id,'.$x.'',
            
            //|multiple_unique:'.YOUR_MODEL_HERE::class.',FIELD_1,FIELD_2,FIELD_3...'
        ]);

        OT_List::create([
            'year' =>$this->year,
            'month'=>$this->month,
            'institute_id'=>$x,

        ]);
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

    
   // public function viewotrecords($x){        
    //    return redirect()->to('/otrecords/'.$x);
   // }


    
    public function printotrecords($x,$y){//Session::put('recordID',$x);
        return redirect()->to('/printotrecords/'.$x.'/'.$y);
    }

    public function printotrecords2($x,$y){//Session::put('recordID',$x);
        return redirect()->to('/printotrecords2/'.$x.'/'.$y);
    }


    public function Submit1($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L1' =>1,
            
            
        ]);
        $this->reset();
        

    }


    public function Submit2($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L2' =>1,
            
            
        ]);
        $this->reset();

    }


    public function Submit3($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L3' =>1,
            
            
        ]);
        $this->reset();

    }

    public function Submit4($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L4' =>1,
            
            
        ]);
        $this->reset();

    }

    public function Submit5($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L5' =>1,
            
            
        ]);
        $this->reset();

    }

    public function Submit6($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'L6' =>1,
            
            
        ]);
        $this->reset();

    }

    public function Submit7($id){
        //dd ($id);
        $this->otrec=OT_List::findOrFail($id);
        $this->otrec->update([
            'completed'=>1,
            'L7' =>1,
            
            
        ]);
        $this->reset();

    }

    
    public function viewotrecords($x,$y,$z,$a,$b){        
        return redirect()->to('/otrecords/'.$x.'/'.$y.'/'.$z.'/'.$a.'/'.$b);
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
   public $showingsubmitmodal = false;
   public function ShowSubmitModal($p)
   {
       $this->reset();
       $this->SubmitID=$p;        
       $this->showingsubmitmodal = true;
   }

   public function SubmitModal()
   {
       OT_List::destroy($this->deleteID);
       $this->showingsubmitmodal = false;
   }

   public function HideSubmitModal()
   {      
       $this->showingsubmitmodal = false;
   }
   //********************************************************************************** */


}
