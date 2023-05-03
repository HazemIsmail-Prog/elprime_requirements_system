<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientIndex extends Component
{
    use WithPagination;

    protected $listeners = ['ClientsDataChanged' => '$refresh'];

    public $search;
    public $pagination = 9;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($client)
    {
        Client::find($client['id'])->delete();
        $this->emit('ClientsDataChanged');
    }

    public function render()
    {
        return view('livewire.client-index',[
            'clients' => Client::when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->paginate($this->pagination),
        ]);
    }
}
