<?php

namespace App\Http\Livewire;

use App\Models\Requirement;
use Livewire\Component;

class ClientPage extends Component
{

    protected $listeners = ['RequirementsDataChanged' => 'refresh'];

    public $filter;
    public $requirements;
    public $requirement = [];
    public $comment = '';

    public function mount()
    {
        $this->filter['month'] = now()->month;
        $this->filter['year'] = now()->year;
        $this->refresh();
    }

    public function updatedFilter()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->requirements = Requirement::query()
            ->where('client_id', auth()->user()->clients->first()->id)
            ->whereMonth('date', $this->filter['month'])
            ->whereYear('date', $this->filter['year'])
            ->orderBy('is_completed')
            ->orderBy('comment')
            ->get();
        $this->emit('CardDataChanged');

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.client-page')->layout('layouts.client');
    }
}
