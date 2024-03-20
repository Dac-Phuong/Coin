<?php

namespace App\Livewire\Admin\Investors;

use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\Withdraw;
use Livewire\Component;

class DetailInvestor extends Component
{
    public $investor;
    public $total_deposit;
    public $total_widthdraw;
    protected $listeners = ['update' => 'mount'];
    public function mount($id = null)
    {
        $this->investor = Investors::find($id);
        if($this->investor){
            $this->total_deposit = Investor_with_plants::where('investor_id', $this->investor->id)->where('status', '!=', '3')->sum('amount');
            $this->total_widthdraw = Withdraw::where('investor_id', $this->investor->id)->where('status', 1)->sum('amount');
        }
    }
    public function render()
    {
        return view('livewire.admin.investors.detail-investor');
    }
}
