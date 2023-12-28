<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\user_level;
use App\Models\institute;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;



class ManageUser extends Component
{

    use WithFileUploads;

    public $name;
    public $Email;
    public $Password;
    public $ConfirmPassword;
    public $institute;
    public $user_level;
    public $designation;
    public $newImage;

    
    public $user;
    public $isEditMode;

    public $search = '';
    use WithPagination;

    public function render()
    {
        return view('livewire.manage-user',[
           'users'=>DB::table('users')
           ->select('name','users.institute as institute','users.id as id','users.designation_id as designation_id','users.user_level as user_level')
           ->Join("institute","users.institute","=","institute.id")
           ->where(function($a) {
            $a->where('name', 'like', '%'.$this->search.'%' )
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('user_level', 'like', '%'.$this->search.'%')
            ->orWhere('institute.institute_code', 'like', '%'.$this->search.'%');
            })  
            ->orderBy('users.institute')         
           ->paginate(20),  'ins'=>institute::all() 
        ]);
        
    }

    public $showDiv = false;

   
   


    public function signature()
    {
        
        $this->showingUserModal = false;

    }


    public $showingUserModal = false;
    
    public function showUserModal()
    {
        $this->reset();
        $this->showingUserModal = true;
    }

    public function close()
    {        
        $this->showingUserModal = false;
    }

    public function storeUser()
    {
        $this->validate([
            'name'=>'Required',
            'designation'=>'Required',
            'Email'=>'Required | email',
            'Password'=>'Required | min:6',
            'ConfirmPassword' => 'required_with:Password|same:Password|min:6',
            'institute'=>'Required',
            'user_level'=>'Required',
            //'newImage'=>'image|max:1024',
        ]);

        if ($this->newImage!=null){
            $signature=$this->newImage->store('public/signature');
        }else{
            $signature="";
        }
        
        User::create([
           
            'signature'=>$signature,
            'name' =>$this->name,
            'email'=>$this->Email,
            'designation_id'=>$this->designation,
            'password'=>Hash::make($this->Password),
            'institute'=>$this->institute,
            'user_level'=>$this->user_level,

        ]);
        $this->reset();
    }

    public function deleteUser($id)
    {
        user::findOrFail($id)->delete();
        $this->reset();
    }

    public function showEditUserModel($id)
    {
        $this->user=User::findOrFail($id);
        $this->name=$this->user->name;
        $this->designation=$this->user->designation_id;
        $this->Email=$this->user->email;
        $this->institute=$this->user->institute;
        $this->user_level=$this->user->user_level;
        //$this->Password=($this->user->password);
        $this->isEditMode = true;
        $this->showingUserModal=true;
        

    }

    public function editUser()
    {
        $this->validate([  
            'name'=>'Required',
            'Email'=>'Required | email',
            'Password'=>'Required | min:6',
            'ConfirmPassword' => 'required_with:Password|same:Password|min:6',
            'institute'=>'Required',
            'user_level'=>'Required',
        ]);

        $signature=$this->user->signature;
        if($this->newImage){
            $signature=$this->newImage->store('public/signature');
        }

        $this->user->update([
            'name' =>$this->name,
            'email'=>$this->Email,
            'signature'=>$signature,
            'designation_id'=>$this->designation,
            'password'=>Hash::make($this->Password),
            'institute'=>$this->institute,
            'user_level'=>$this->user_level,
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
        User::destroy($this->deleteID);
        $this->showingdeletemodal = false;
    }

    public function HideDeleteModal()
    {      
        $this->showingdeletemodal = false;
    }
    //********************************************************************************** */



}
