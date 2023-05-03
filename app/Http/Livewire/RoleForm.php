<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;

class RoleForm extends Component
{
    public $role;
    public $modalTitle;
    public $permissions = [];
    public $selected_permissions = [];
    public $showModal = false;

    protected $listeners = [
        'showModal' => 'showModal',
    ];

    public function rules()
    {
        if (isset($this->role['id'])) {
            return [
                'role.name' => ['required', 'unique:roles,name,' . $this->role['id'] . ''],
                'selected_permissions' => ['required'],
            ];
        } else {
            return [
                'role.name' => ['required', 'unique:roles,name'],
                'selected_permissions' => ['required'],
            ];
        }
    }

    public function mount()
    {
        $this->permissions = Permission::orderBy('id')->get()->groupBy(function ($item) {
            return $item->section_name;
        })->toBase();
    }

    public function showModal($role)
    {
        $this->reset();
        $this->resetValidation();
        if ($role) {
            $this->modalTitle = 'Edit Role';
            $this->role = $role;
            $this->selected_permissions = Role::find($this->role['id'])->permissions->pluck('id');
        } else {
            $this->modalTitle = 'New Role';
        }
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        if (isset($this->role['id'])) {
            $role = Role::find($this->role['id']);
            $role->update($this->role);
            $role->permissions()->sync($this->selected_permissions);
            $this->showModal = false;
            $this->emit('RolesDataChanged');
        } else {
            $role = Role::create($this->role);
            $role->permissions()->sync($this->selected_permissions);
            $this->showModal = false;
            $this->emit('RolesDataChanged');
        }
    }

    public function render()
    {
        return view('livewire.role-form');
    }
}
