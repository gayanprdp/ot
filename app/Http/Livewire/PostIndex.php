<?php

namespace App\Http\Livewire;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

use Symfony\Contracts\Service\Attribute\Required;

class PostIndex extends Component
{
    use WithFileUploads;

    public $title;
    public $newImage;
    public $body;
    public $isEditMode = false;
    public $post;



    public function storePost()
    {
        $this->validate([
            'newImage'=>'image|max:1024',
            'title'=>'Required',
            'body'=>'Required'
        ]);

        $image=$this->newImage->store('public/posts');
        //$image='asd';
        post::create([
            'title' =>$this->title,
            'image'=>$image,
            'body'=>$this->body,
        ]);
        $this->reset();
    }

    public function deletePost($id)
    {
        Post::findOrFail($id)->delete();
        $this->reset();
    }

    public function editPost()
    {
        $this->validate([  
            'title'=>'Required',
            'body'=>'Required'
        ]);

        $image=$this->post->image;
        if($this->newImage){
            $image=$this->newImage->store('public/posts');
        }

        $this->post->update([
            'title' =>$this->title,
            'image'=>$image,
            'body'=>$this->body,
        ]);
        $this->reset();
    }

    public function showEditPostModel($id)
    {
        $this->post=Post::findOrFail($id);
        $this->title=$this->post->title;
        $this->body=$this->post->body;
        $this->isEditMode = true;
        $this->showingPostModal=true;
        

    }



    public $showingPostModal = false;
    public function showPostModal()
    {
        $this->reset();
        $this->showingPostModal = true;
    }



    public function render()
    {
        return view('livewire.post-index',[
            'posts'=>post::all()
        ]);
    }
}
