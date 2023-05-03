<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Requirement;
use Livewire\Component;

class RequirementForm extends Component
{

    protected $listeners = ['RequirementsDataChanged' => 'refresh'];

    public $clients;
    public $filter;
    public $requirements;
    public $requirement = [];

    public function mount()
    {
        $this->filter['selected_client_id'] = '';
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
        $this->clients = Client::whereIn('id',auth()->user()->clients->pluck('id'))->get();
        $this->requirements = Requirement::query()
            ->where('client_id', $this->filter['selected_client_id'])
            ->whereMonth('date', $this->filter['month'])
            ->whereYear('date', $this->filter['year'])
            ->get();
            $this->resetValidation();
    }

    public function toggle_completed($requirement_id)
    {
        $requirement = Requirement::find($requirement_id);
        if($requirement->is_completed){
            $requirement->is_completed = 0;
            $requirement->save();
        }else{
            $requirement->is_completed = 1;
            $requirement->save();
        }
        $this->emit('RequirementsDataChanged');
    }

    public function delete($requirement)
    {
        Requirement::find($requirement['id'])->delete();
        $this->emit('RequirementsDataChanged');
    }

    public function rules()
    {
        return [
            'requirement.date' => 'required',
            'requirement.account' => 'required',
            'requirement.description' => 'required',
            'requirement.amount' => 'required',
            // 'requirement.remarks' => 'required',
            'filter.selected_client_id' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();
        $data = [
            'date' => $this->requirement['date'],
            'account' => $this->requirement['account'],
            'description' => $this->requirement['description'],
            'amount' => $this->requirement['amount'],
            'remarks' => $this->requirement['remarks'] ?? null,
            'client_id' => $this->filter['selected_client_id'],
            'created_by' => auth()->id(),
        ];

        $this->emit('RequirementsDataChanged');
        $this->reset('requirement');
        Requirement::create($data);
    }

    public function render()
    {
        return view('livewire.requirement-form');
    }
}
