<?php

namespace App\Http\Livewire;

use App\Models\institute;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ManageSubInstitute extends Component
{

    public $isEditMode;
    public $institute_code;
    public $institute;
    public $institute1;
    public $main_institute;

    public $insti;
    public $insid;

    public $search = '';
    use WithPagination;

    Public function mount($insid)
        {
            $this->insid=$insid; //list id 
            
            
        }

    public function render()
    {
        
        return view('livewire.manage-subinstitute',[
            'ins'=>DB::table('institute')
            ->select('main_institute','institute.id as id','institute.institute_code as institute_code','institute.institute as institute','emp_designation.designation as empdes')
            ->where('main_institute','!=',0)
            ->groupBy('institute.id')
            ->orderBy('main_institute')
            ->leftJoin("emp_designation","emp_designation.institute_id","=","institute.id")
            ->where('main_institute', '=', ''.$this->insid.'' )
            ->where(function($a) {
                $a->where('institute', 'like', '%'.$this->search.'%' )
                ->orWhere('institute_code', 'like', '%'.$this->search.'%');
            })
            
            
            ->paginate(10),
            
            //'ins'=>institute::where('institute', 'like', '%'.$this->search.'%' )->orWhere('institute_code', 'like', '%'.$this->search.'%')->paginate(10)
        ]);
        
    }


    public $showingInsModal = false;
    public function showInsModal()
    {
        //$this->reset();
        $this->showingInsModal = true;
    }

    public function storeIns()
    {
        //dd($this->main_institute);
        $this->validate([
            'institute_code'=>'Required|unique:institute',
            'institute'=>'Required',
            //'main_institute'=>'Required',
        ]);

        institute::create([
            'institute_code' =>$this->institute_code,
            'institute'=>$this->institute,
            'main_institute'=>$this->insid,

        ]);
        //$this->reset();
        $this->showingInsModal=false;
    }


    public function showEditInsModel($id)
    {
        
        $this->insti=institute::findOrFail($id);        
        $this->institute_code=$this->insti->institute_code;
        $this->institute=$this->insti->institute;        
        $this->main_institute=$this->insti->main_institute;

        $this->isEditMode = true;
        $this->showingInsModal=true;
        

    }

    public function editIns()
    {
        $this->validate([  
            'institute_code'=>'Required',
            'institute'=>'Required',
            //'main_institute'=>'Required',
        ]);

       

        $this->insti->update([
            'institute_code' =>$this->institute_code,
            'institute'=>$this->institute,
            //'main_institute'=>$this->insid,
        ]);
        $this->showingInsModal=false;
        //$this->reset();
    }

    public function deleteIns($id)
    {
        institute::findOrFail($id)->delete();
        $this->reset();
    }

    public function back()
    {
        return redirect()->to('/manageinstitute'); 
    }


    public function close()
    {        
        $this->showingInsModal = false;
    }




    //********************************************************************************** */
    public $deleteID;
    public $showingdeletemodal = false;
    public function ShowDeleteModal($p)
    {
        //$this->reset();
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
