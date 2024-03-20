<?php

namespace App\Livewire\Web\Referal;

use App\Components\InterestCalculator;
use App\Models\Investors;
use App\Models\Referal_detail;
use App\Models\Referals;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class Referal extends Component
{
    #[Title('Referrals')]
    public $ref;
    public $interestCalculator;
    public $referal;
    public $perpage = 10;
    public $amount_received = 0;
    public $number_referals = 0;
    public $investor;
    public function mount()
    {
        $data_investor = session()->get('investor');
        $this->investor = Investors::find($data_investor ? $data_investor->id : '');
        if (!$this->investor) {
            return $this->redirect('/login', navigate: true);
        }
    }
    public function render()
    {
        $this->referal = Referals::first();
        $this->number_referals = Referal_detail::where('investor_id', $this->investor->id)->sum('number_referals');
        $this->amount_received = Referal_detail::where('investor_id', $this->investor->id)->sum('amount_received');
        $ref = url()->to('/');
        if ($ref && $this->investor) {
            $this->ref = $ref . '/register?ref=' . $this->investor->username;
        }
        $list_referal = Investors::where('referal_code', $this->investor->username)->orderBy('created_at', 'desc')->paginate($this->perpage);

        $calculator = new InterestCalculator();
        $this->interestCalculator = $calculator->calculator_interest($this->investor);
        return view('livewire.web.referal.referal', ['list_referal' => $list_referal])->extends('components.layouts.app')->section('content');
    }
}
