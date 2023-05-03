<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientForm extends Component
{
    public $client;
    public $modalTitle;
    public $showModal = false;

    protected $listeners = [
        'showModal' => 'showModal',
    ];

    public function rules()
    {
        if (isset($this->client['id'])) {
            return [
                'client.name' => ['required', 'unique:clients,name,' . $this->client['id'] . ''],
            ];
        } else {
            return [
                'client.name' => ['required', 'unique:clients,name'],
            ];
        }
    }

    public function showModal($client)
    {
        $this->reset();
        $this->resetValidation();
        if ($client) {
            $this->modalTitle = 'Edit Client';
            $this->client = $client;
        } else {
            $this->modalTitle = 'New Client';
        }
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        if (isset($this->client['id'])) {
            $client = Client::find($this->client['id']);
            $client->update($this->client);
            $this->showModal = false;
            $this->emit('ClientsDataChanged');
        } else {
            $client = Client::create($this->client);
            $this->showModal = false;
            $this->emit('ClientsDataChanged');
        }
    }

    public function render()
    {
        return view('livewire.client-form');
    }
}
