<?php

namespace App\Http\Livewire;

use App\Models\Requirement;
use Livewire\Component;

class ClientCard extends Component
{

    protected $listeners = ['CardDataChanged' => '$refresh'];

    public $requirement;
    public $comment;

    public function save_comment($requirement_id)
    {
        $requirement = Requirement::find($requirement_id);
        $requirement->update(['comment' => $this->comment]);
        $this->reset('comment');
        $this->emit('RequirementsDataChanged');

    }
    
    public function render()
    {
        return view('livewire.client-card');
    }
}
