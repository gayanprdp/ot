<?php

namespace App\Http\Livewire;

use App\Models\institute;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ManageInstitute extends Component
{

    public $isEditMode;
    public $institute_code;
    public $institute;
    public $institute_id;

    public $insti;

    public $search = '';
    use WithPagination;

    public function render()
    {
        return view('livewire.manage-institute',[
            'ins'=>DB::table('institute')
            ->select('institute.id as id','institute.institute_code as institute_code','institute.institute as institute','emp_designation.designation as empdes')
            ->where('main_institute','=',0)
            ->groupBy('institute.id')
            ->leftJoin("emp_designation","emp_designation.institute_id","=","institute.id")
            ->where(function($a) {
                $a->where('institute', 'like', '%'.$this->search.'%' )
                ->orWhere('institute_code', 'like', '%'.$this->search.'%');
            })
            ->paginate(10),
            //'ins'=>institute::where('institute', 'like', '%'.$this->search.'%' )->orWhere('institute_code', 'like', '%'.$this->search.'%')->paginate(10)
        ]);
    }

    public function close()
    {        
        $this->showingInsModal = false;
    }


    public $showingInsModal = false;
    public function showInsModal()
    {
        $this->reset();
        $this->showingInsModal = true;
    }

    public function storeIns()
    {
        $this->validate([
            'institute_code'=>'Required|unique:institute',
            'institute'=>'Required',
        ]);

        institute::create([
            'institute_code' =>$this->institute_code,
            'institute'=>$this->institute,

        ]);
        $this->reset();
    }


    public function showEditInsModel($id)
    {
        $this->insti=institute::findOrFail($id);
        $this->institute_id=$this->insti->id;
        $this->institute_code=$this->insti->institute_code;
        $this->institute=$this->insti->institute;
        $this->isEditMode = true;
        $this->showingInsModal=true;
        

    }

    public function subinstitute($id)
    {
       return redirect()->to('/managesubinstitute/'.$id); 
        

    }

    public function editIns()
    {
        $this->validate([  
            'institute_code'=>['Required', Rule::unique('institute')->ignore($this->institute_id)],
            'institute'=>'Required',
        ]);

       

        $this->insti->update([
            'institute_code' =>$this->institute_code,
            'institute'=>$this->institute,
        ]);
        $this->reset();
    }

    public function deleteIns($id)
    {
        institute::findOrFail($id)->delete();
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
        institute::destroy($this->deleteID);
        $this->showingdeletemodal = false;
    }

    public function HideDeleteModal()
    {      
        $this->showingdeletemodal = false;
    }
    //********************************************************************************** */


}
