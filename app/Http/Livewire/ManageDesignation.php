<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\empDesignation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\institute;
use Livewire\Component;
use Livewire\WithPagination;

class ManageDesignation extends Component
{

    public $designation_id;
    public $designation;
    public $empDesignation;
    public $institute_id;
   // public $approved_OT_hours;
    public $approved_OT_hours1;
    public $approved_OT_hours2;
    public $approved_OT_hours3;

    public $OT_range1;
    public $OT_range2;
    public $OT_range3;
    
    public $isEditMode;

    public $desig;

    public $search = '';
    use WithPagination;


    public function render()
    {
        if (Auth::user()->user_level==1 ){
            return view('livewire.manage-designation',[
                'des'=>DB::table('emp_designation')
                    ->select('institute.institute_code as institute_code','institute.institute as institute','emp_designation.id as id','emp_designation.designation as designation1','emp_designation.institute_id as institute_id1', '_employees.designation as empdes','OT_range1','OT_range2','OT_range3')
                    ->leftJoin("_employees","_employees.designation","=","emp_designation.id")
                    ->leftJoin("institute","institute.id","=","emp_designation.institute_id")
                    
                    ->where('emp_designation.designation', 'like', '%'.$this->search.'%' )
                    ->groupBy('emp_designation.id')
                    ->paginate(10),

                    
                    'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
      
            ]);
        }
        else
        {

            //return view('livewire.manage-designation',[
            //    'des'=>empDesignation::where('designation', 'like', '%'.$this->search.'%' )->paginate(10), 'ins'=>institute::all(),
                
                
                return view('livewire.manage-designation',[
                    //'des'=>empDesignation::where('designation', 'like', '%'.$this->search.'%' )->paginate(10), 'ins'=>institute::all()
                    'des'=>DB::table('emp_designation')
                    ->select('institute.institute_code as institute_code','institute.institute as institute','emp_designation.id as id','emp_designation.designation as designation1','emp_designation.institute_id as institute_id1', '_employees.designation as empdes','OT_range1','OT_range2','OT_range3')
                    ->leftJoin("_employees","_employees.designation","=","emp_designation.id")
                    ->leftJoin("institute","institute.id","=","emp_designation.institute_id")
                    //->where("emp_designation.institute_id","=",''.Auth::user()->institute.'')
                    ->where('emp_designation.designation', 'like', '%'.$this->search.'%' )
                    ->groupBy('emp_designation.id')
                    ->paginate(10),

                    //'ins'=>institute::all()
                    'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()

                ]);
        }
       
    }

    public $showingDesModal = false;
    
    
    public function showDesModal()
    {
        $this->reset();
        $this->showingDesModal = true;
    }

    public function close()
    {        
        $this->showingDesModal = false;
    }


 


    public function storeDes($x)
    {
        $this->validate([
            'designation'=>'Required|unique:emp_designation|string|min:2',    
            'approved_OT_hours1' =>'Required|numeric|max:999', 
            'approved_OT_hours2'=>'Required|numeric|max:999|min:'.$this->approved_OT_hours1.'', 
            'approved_OT_hours3'=>'Required|numeric|max:999|min:'.$this->approved_OT_hours2.'', 
                 
        ]);

        empDesignation::create([
            'designation' =>$this->designation,
            //'approved_OT_hours'=>$this->approved_OT_hours,
            'OT_range1'=>$this->approved_OT_hours1,
            'OT_range2'=>$this->approved_OT_hours2,
            'OT_range3'=>$this->approved_OT_hours3,
            'institute_id' => $x,

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
        empDesignation::destroy($id);
    }

    public function showEditDesModel($id)
    {
        $this->desig=empDesignation::findOrFail($id);
        $this->designation_id=$this->desig->id;
        $this->designation=$this->desig->designation;
        $this->approved_OT_hours1=$this->desig->OT_range1;
        $this->approved_OT_hours2=$this->desig->OT_range2;
        $this->approved_OT_hours3=$this->desig->OT_range3;
        $this->isEditMode = true;
        $this->showingDesModal=true;
        

    }

    public function editDes()
    {
        //dd($this->$this->designation_id);
        $this->validate([  
            //Rule::unique('emp_designation')->ignore(13),
            'designation'=>['Required', Rule::unique('emp_designation')->ignore($this->designation_id)], 
            'approved_OT_hours1' =>'Required|numeric|max:999',   
            'approved_OT_hours2'=>'Required|numeric|max:999|min:'.$this->approved_OT_hours1.'', 
            'approved_OT_hours3'=>'Required|numeric|max:999|min:'.$this->approved_OT_hours2.'', 
            
        ]);

       

        $this->desig->update([
            'designation' =>$this->designation,
            //'approved_OT_hours'=>$this->approved_OT_hours,
            'OT_range1'=>$this->approved_OT_hours1,
            'OT_range2'=>$this->approved_OT_hours2,
            'OT_range3'=>$this->approved_OT_hours3,
        ]);
        $this->reset();
    }



       //********************************************************************************** */
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
           empDesignation::destroy($this->deleteID);
           $this->showingdeletemodal = false;
       }
   
       public function HideDeleteModal()
       {      
           $this->showingdeletemodal = false;
       }
       //********************************************************************************** */

       

       
}
