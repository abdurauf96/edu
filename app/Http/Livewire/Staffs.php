<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Staff;
use Livewire\WithPagination;

class Staffs extends Component
{
    use WithPagination;

    public $organizations;
    public $key;
    public $organization_id;

    public function render()
    {
        $staffs=Staff::school();

        if(isset($this->organization_id)){
            $staffs->where('organization_id', $this->organization_id);
        }
        if(isset($this->key)){
            $staffs->where('name', 'LIKE', '%'.$this->key.'%');
        }
        $staffs=$staffs->with('organization')->latest()->paginate(10);
        return view('livewire.staffs',compact('staffs'));
    }
}
