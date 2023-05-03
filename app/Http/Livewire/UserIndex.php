<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    protected $listeners = ['UsersDataChanged' => '$refresh'];

    public $search;
    public $pagination = 9;

    public function delete($user)
    {
        User::find($user['id'])->delete();
        $max = DB::table('users')->max('id') + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT =  $max");
        $this->emit('UsersDataChanged');
    }

    public function render()
    {
        return view('livewire.user-index',[
            'users' => User::when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
                $q->orWhere('username', 'like', '%' . $this->search . '%');
                $q->orWhere('email', 'like', '%' . $this->search . '%');
            })->paginate($this->pagination),
            
        ]);
    }
}
