<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\User;
use App\Models\Role;
use Livewire\Component;

class UserForm extends Component
{
    public $user;
    public $modalTitle;
    public $roles = [];
    public $clients = [];
    public $selected_roles = [];
    public $selected_clients = [];
    public $showModal = false;

    protected $listeners = [
        'showModal' => 'showModal',
    ];

    public function rules()
    {
        if (isset($this->user['id'])) {
            return [
                'user.name' => ['required'],
                'user.username' => ['required', 'unique:users,username,'.$this->user['id'].''],
                'user.type' => ['required'],
                'selected_roles' => ['required'],
                'selected_clients' => ['required'],
            ];
        }else{
            return [
                'user.name' => ['required'],
                'user.username' => ['required','unique:users,username'],
                'user.type' => ['required'],
                'user.password' => ['required'],
                'selected_roles' => ['required'],
                'selected_clients' => ['required'],
            ];
        }
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->clients = Client::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showModal($user)
    {
        $this->reset();
        $this->resetValidation();
        if($user){
            $this->modalTitle = 'Edit User';
            $this->user = $user;
            $this->selected_roles = User::find($this->user['id'])->roles->pluck('id');
            $this->selected_clients = User::find($this->user['id'])->clients->pluck('id');

        }else{
            $this->modalTitle = 'New User';
            $this->user['type'] = 'local';
            $this->user['active'] = 1;
        }
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        if(isset( $this->user['id'])){
            $user = User::find($this->user['id']);
            $user->update($this->user);
            if(isset($this->user['password'])){
                $user->password = bcrypt($this->user['password']);
                $user->save();
            }
            $user->roles()->sync($this->selected_roles);
            $user->clients()->sync($this->selected_clients);
            $this->showModal = false;
            $this->emit('UsersDataChanged');
        }else{
            $user = User::create($this->user);
            $user->password = bcrypt($this->user['password']);
            $user->save();
            $user->roles()->sync($this->selected_roles);
            $user->clients()->sync($this->selected_clients);
            $this->showModal = false;
            $this->emit('UsersDataChanged');
        }
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
