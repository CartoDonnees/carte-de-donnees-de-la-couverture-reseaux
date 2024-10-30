<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Newsletter as Newsl;
use Livewire\WithFileUploads;

class Newsletter extends Component
{
    use WithFileUploads;

    public $file;
    public $image;
    public $video_url;
    public $title;
    public $description;
    public $success;
    public $news;
    public $selected = 'list';
    public $action = 'list';
    public $edit;

    public $e_title;
    public $e_description;
    public $e_image;
    public $e_file;
    public $e_video_url;
    public $e_success;

    public function mount()
    {
        $this->news = Newsl::OrderBy('created_at', 'desc')->get();
    }


    public function render()
    {
        return view('livewire.admin.newsletter');
    }

    
    public function selectNews($id)
    {
        $this->s_new = Newsl::find($id);
        $this->selected = 'view';
    }

    public function selectEdit($id)
    {
        $this->edit = Newsl::find($id);
        $this->e_id = $id;
        $this->e_title = $this->edit->title;
        $this->e_description = $this->edit->description;
        $this->e_image = $this->edit->image_link;
        $this->e_file = $this->edit->file_link;
        $this->e_video = $this->edit->video_link;
        $this->image == null;
        $this->selected = 'edit';
    }

    public function submitNewsletter()
    {
        $urlimag = $urlfile = $video = null;
        if ($this->image != null) {

           $urlimag =  $this->image->store('images', 'public');;
        }

        if ($this->file != null) {
            $urlfile = $this->file->store('files', 'public');
        }

        if ($this->video_url != null) {
            $video = $this->video_url->store('files', 'public');
        }
        if ($this->title != null) {
            Newsl::create([
                'title' => $this->title,
                'image_link' => $urlimag,
                'file_link' => $urlfile,
                'video_link' => $video,
                'description' => $this->description,
            ]);
            $this->success = true;
        }
    }

    public function submitEditNewsletter($id)
    {
        $urlimag = null;
        if ($this->image != null) {
            $urlimag =  $this->image->store('images', 'public');
        }else{
            $urlimage = $this->e_image;
        }
        if (!empty($this->e_title)) {
            Newsl::where('id', $id)
                ->update([
                    'title' => $this->e_title,
                    'description' => $this->e_description,
                    'image_link' => $urlimag,
                ]);
        }
        $this->e_success = true;
        $this->edit = Newsl::find($id);
    }
    public function deleteNewsletter($id)
    {
        $urlimag = null;
        if ($this->image != null) {
            $urlimag =  $this->image->store('images', 'public');
        }else{
            $urlimage = $this->e_image;
        }
        if (!empty($this->e_title)) {
            Newsl::where('id', $id)
                ->update([
                    'title' => $this->e_title,
                    'description' => $this->e_description,
                    'image_link' => $urlimag,
                ]);
        }
        $this->e_success = true;
        $this->edit = Newsl::find($id);
    }
}
