<?php

namespace App\Http\Livewire\School;

use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentsGraphic extends Component
{
    public $months,$amounts,$year,$selectedYearAmount;
    protected $listeners = ['changeYear'];
    protected $queryString = [
        'year'=>['except'=>'']
    ];
    public function mount()
    {
        $this->year=date('Y');
        $this->clearData();
    }

    public function changeYear($year)
    {
        $this->year=$year;
        $this->clearData();
        $this->setGraphicData($year);
        $this->dispatchBrowserEvent('changeYear', [
            'months' => $this->months,
            'amounts'=>$this->amounts
        ]);
    }
    public function render()
    {
        $this->setGraphicData();
        return view('livewire.school.payments-graphic');
    }
    public function setGraphicData()
    {
        $items=Payment::selectRaw("TO_CHAR(created_at, 'Month') as month_name, SUM(amount) as total_amount")
            ->groupBy('month_name', DB::raw("DATE_TRUNC('month', created_at)"))
            ->orderBy(DB::raw("DATE_TRUNC('month', created_at)"))
            ->whereYear('created_at',$this->year)
            ->school()
            ->get()
            ->toArray();

        foreach ($items as $item){
            array_push($this->months, $item['month_name']);
            array_push($this->amounts, $item['total_amount']);
        }

        $this->selectedYearAmount=Payment::selectRaw("SUM(amount) as total_amount")
            ->whereYear('created_at',$this->year)
            ->school()
            ->first()
            ->total_amount;
    }

    public function clearData()
    {
        $this->amounts=[];
        $this->months=[];
    }

}
