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



class OTlist_completed extends Component
{

    public $isEditMode;

    public $year;
    public $month;
    public $institute_id;
    public $institute;

    public $insti;
    public $otrec;

    public $search = '';
    use WithPagination;



    
  

    public function render()
    {
        $pagienateVal=10;
        {{Session::put('notification','1');}}
        // list all institute data
        if (Auth::user()->user_level==1 ){
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)  
            ]);

            
            //user 2Additional Director General (Admin) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==2 ) {   
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)   
            ]);


            //user 3 Director(Admin) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==3 ) {   
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)  
            ]);

         //user 4/5 AO/CC(Admin office) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==4  || Auth::user()->user_level==5) {   
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)   
            ]);



            //user level 6 Subject Clerk (admin Office) ************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==6 ) {   
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)   
            ]);


         //user level 7/ 8 / 9 Director /Chief Engineer/Chief Accountant************************************************************************************************* 
        }
        elseif(Auth::user()->user_level==7 || Auth::user()->user_level==8 || Auth::user()->user_level==9) {   
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','1')

                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)   
            ]);


        //user level 10/11 AO/CC ****************************************************************************************************
        }elseif(Auth::user()->user_level==10 || Auth::user()->user_level==11 ) {


            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','1')
                
                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)   
            ]);




        }elseif(Auth::user()->user_level==12 ){
            //list institute wise data
            return view('livewire.otlist_completed',[
                'otlist'=>DB::table('ot_list')
                ->select('ot_list.id as id','year','month','institute','institute_code','L1','L2','L3','L4','L5','L6','L7','L8','completed')
                ->join("institute","ot_list.institute_id","=","institute.id")
                ->where('institute_id', '=', Auth::user()->institute )
                ->where('completed','=','1')
                
                ->when($this->year == "", (function ($a) {
                    $a->where('year', '=', ''.now()->year.'' );
                }))

                ->when($this->year != "", (function ($a) {
	                    $a->where('year', '=', ''.$this->year.'' );
                }))
                ->when($this->month != "", (function ($b) {
                    $b->where('month', '=', ''.$this->month.'' );
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
                ->paginate($pagienateVal)
                
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

    
    public function viewotrecords($x){        
        return redirect()->to('/otrecords/'.$x);
    }


    
    public function printotrecords($x){//Session::put('recordID',$x);
        return redirect()->to('/printotrecords/'.$x);
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
