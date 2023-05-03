<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Livewire\Component;

class PermissionForm extends Component
{
    public $permission;
    public $modalTitle;
    public $showModal = false;

    protected $listeners = [
        'showModal' => 'showModal',
    ];

    public function rules()
    {
        if (isset($this->permission['id'])) {
            return [
                'permission.name' => ['required', 'unique:permissions,name,' . $this->permission['id'] . ''],
                'permission.description' => ['required'],
                'permission.section_name' => ['required'],
            ];
        } else {
            return [
                'permission.name' => ['required', 'unique:permissions,name'],
                'permission.description' => ['required'],
                'permission.section_name' => ['required'],
            ];
        }
    }

    public function save()
    {
        $this->validate();
        if (isset($this->permission['id'])) {
            $permission = Permission::find($this->permission['id']);
            $permission->update($this->permission);
            $this->showModal = false;
            $this->emit('PermissionsDataChanged');
        } else {
            Permission::create($this->permission);
            $this->showModal = false;
            $this->emit('PermissionsDataChanged');
        }
    }

    public function showModal($permission)
    {
        $this->reset();
        $this->resetValidation();
        if ($permission) {
            $this->modalTitle = 'Edit Permission';
            $this->permission = $permission;
        } else {
            $this->modalTitle = 'New Permission';
        }
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.permission-form');
    }
}
