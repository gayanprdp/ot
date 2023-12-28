<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Employees;
use App\Models\empDesignation;
use App\Models\institute;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ManageEmployee extends Component
{

    public $isEditMode;

    public $name;
    public $nic;
    public $institute;
    public $designation;
    public $search = '';
    public $empl;
    public $emp_no;
    Public $paginator;
    Public $employee_id;

    

    //public $param='1';
    use WithPagination;


    public $showingEmployeeModal = false;
    public function showEmployeeModal()
    {
        $this->reset();
        $this->showingEmployeeModal = true;
    }


    public function showEditEmployeeModal($id)
    {
        $this->empl=Employees::findOrFail($id);
        $this->employee_id=$this->empl->id;
        $this->emp_no=$this->empl->emp_no;
        $this->name=$this->empl->name;
        $this->designation=$this->empl->designation;
        $this->isEditMode = true;
        $this->showingEmployeeModal = true;
    }

    public function editEmpl()
    {
        $this->validate([  
            'emp_no'=>['Required', Rule::unique('_employees')->ignore($this->employee_id),'integer'],
            'name'=>'Required',
            'designation'=>'Required',   
        ]);

       

        $this->empl->update([
            'emp_no'=>$this->emp_no,
            'name' =>$this->name,
            'nic'=>$this->name,
            'designation'=>$this->designation,
        ]);
        $this->reset();
    }
    

    public function storeEmployee($x)
    {
        $this->validate([
            'emp_no'=>'Required|integer|unique:_employees',
            'name'=>'Required',
            'designation'=>'Required',
        ]);

        Employees::create([
            'emp_no'=>$this->emp_no,
            'name' =>$this->name,
            'nic'=>$this->name,
            'designation'=>$this->designation,
            'institute'=>$x,
            

        ]);
        $this->reset();
    }

    public function deleteEmployee($id)
    {
        Employees::findOrFail($id)->delete();
        $this->reset();
    }

    public $confirming;
    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function kill($id)
    {
        Employees::destroy($id);
    }


    public function search1()
    {
        
        //return redirect()->to('/manageemployeer/1');

    }
    

    public function close()
    {        
        $this->showingEmployeeModal = false;
    }
    
    

    public function render()
    {
        if (Auth::user()->user_level==1 ){
            return view('livewire.manage-employee',[
                'emp'=>DB::table('_employees')
                ->select(DB::raw('((SELECT count(*) from _employees )) as aa') ,'_employees.emp_no','institute.institute_code as institute_code','institute.institute as institute','_employees.id as id','_employees.name','_employees.designation','ot_records.Emp_id as empdes','emp_designation.designation as empdesignation')
                ->leftJoin("ot_records","ot_records.Emp_id","=","_employees.id")
                ->leftjoin('emp_designation','_employees.designation','=','emp_designation.id')
                ->leftJoin("institute","institute.id","=","_employees.institute")
                //->where("_employees.institute","=",''.Auth::user()->institute.'')
                ->groupBy("name")
                ->where(function($a) {
                    $a->where('name', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('emp_designation.designation', 'like', '%'.$this->search.'%')
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%')
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%');
                })
                ->paginate(10),
                //'emp'=>Employees::where('name', 'like', '%'.$this->search.'%' )->where('institute','=',Auth::user()->institute )->paginate(5), 
                'des'=>empDesignation::all(), 
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
             
            ]);
        }
        else
        {

            return view('livewire.manage-employee',[
                
                'emp'=>DB::table('_employees')
                ->select('_employees.emp_no','institute.institute_code as institute_code','institute.institute as institute','_employees.id as id','_employees.name','_employees.designation','ot_records.Emp_id as empdes','emp_designation.designation as empdesignation')
                ->leftJoin("ot_records","ot_records.Emp_id","=","_employees.id")
                ->leftjoin('emp_designation','_employees.designation','=','emp_designation.id')
                ->leftJoin("institute","institute.id","=","_employees.institute")
                ->where("_employees.institute","=",''.Auth::user()->institute.'')
                ->groupBy("name")
                ->where(function($a) {
                    $a->where('name', 'like', '%'.$this->search.'%' ) 
                    ->orwhere('emp_designation.designation', 'like', '%'.$this->search.'%')
                    ->orwhere('institute.institute_code', 'like', '%'.$this->search.'%')
                    ->orwhere('institute.institute', 'like', '%'.$this->search.'%');
                })        
                ->paginate(10),
                //'emp'=>Employees::where('name', 'like', '%'.$this->search.'%' )->where('institute','=',Auth::user()->institute )->paginate(5), 
                'des'=>empDesignation::all(), 
                'ins'=>institute::where("institute.id","=",''.Auth::user()->institute.'')->get()
            ]);
        }
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
        Employees::destroy($this->deleteID);
           $this->showingdeletemodal = false;
       }
   
       public function HideDeleteModal()
       {      
           $this->showingdeletemodal = false;
       }
       //********************************************************************************** */

     

}
