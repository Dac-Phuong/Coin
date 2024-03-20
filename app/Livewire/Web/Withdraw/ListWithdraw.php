<?php

namespace App\Livewire\Web\Withdraw;

use App\Components\InterestCalculator;
use App\Models\Investors;
use App\Models\Withdraw;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ListWithdraw extends Component
{
    use WithPagination;
    #[Title('Withdraw')]

    public $ref;
    public $investor;
    public $interestCalculator;
    protected $listeners = [
        'success' => 'render',
    ];
    public function mount()
    {
        $data_investor = session()->get('investor');
        $this->investor = Investors::find($data_investor ? $data_investor->id : '');
        if (!$this->investor) {
            return $this->redirect('/login', navigate: true);
        }
    }
    public function cancel($id)
    {
        $cancel_withdraw = Withdraw::find($id);
        if ($cancel_withdraw) {
            $cancel_withdraw->status = 2;
            $this->investor->balance += $cancel_withdraw->amount;
            $this->investor->save();
            $cancel_withdraw->save();
        }
    }
    public function render()
    {
        $ref = url()->to('/');
        if ($ref && $this->investor) {
            $this->ref = $ref . '/register?ref=' . $this->investor->username;
        }
        $list_withdraw = Withdraw::where('investor_id', $this->investor->id)->orderBy('created_at', 'desc')->paginate(10);
        $calculator = new InterestCalculator();
        $this->interestCalculator = $calculator->calculator_interest($this->investor);
        return view('livewire.web.withdraw.list-withdraw', ['list_withdraw' => $list_withdraw])->extends('components.layouts.app')->section('content');
    }
}
