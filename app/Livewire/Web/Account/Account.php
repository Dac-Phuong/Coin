<?php

namespace App\Livewire\Web\Account;

use App\Components\InterestCalculator;
use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\Referal_detail;
use App\Models\Referals;
use App\Models\Withdraw;
use Livewire\Attributes\Title;
use Livewire\Component;

class Account extends Component
{
    #[Title('Account')]
    protected $interestCalculator;
    public $ref;
    public $investor;
    public $total_deposit = 0;
    public $total_withdraw = 0;
    public $pending_withdraw = 0;
    public $last_withdraw = 0;
    public $earned_toatl = 0;
    public $active_deposit = 0;
    public $last_deposit = 0;

    public function logout()
    {
        $investor = optional(session('investor'))->id;
        if ($investor) {
            session()->forget('investor');
        }
        return $this->redirect('/', navigate: true);
    }
    public function mount()
    {
        $data_investor = session()->get("investor");
        // lấy ra investor
        $this->investor = Investors::find($data_investor ? $data_investor->id : '');
        if (!$this->investor) {
            return $this->redirect('/login', navigate: true);
        }
    }
    public function render()
    {
        
        // lấy referal link
        $ref = url()->to('/');
        if ($ref &&  $this->investor) {
            $this->ref = $ref . '/register?ref=' . $this->investor->username;
        }
        // tổng số tiền gửi
        $this->total_deposit = Investor_with_plants::where('investor_id', $this->investor->id)
            ->where(function ($query) {
                $query->where('status', 1)
                    ->orWhere('status', 2);
            })
            ->sum('amount');

        // số tiền gửi cuối cùng
        $this->last_deposit = Investor_with_plants::where('investor_id', $this->investor->id)
            ->latest('created_at')
            ->value('amount');
        // tổng số tiền đã rút
        $this->total_withdraw = Withdraw::where('investor_id', $this->investor->id)->where('status', 1)->sum('amount');
        // tổng số tiền chờ rút . pending
        $this->pending_withdraw = Withdraw::where('investor_id', $this->investor->id)->where('status', 0)->sum('amount');
        // số tiền rút cuối cùng
        $this->last_withdraw = Withdraw::where('investor_id', $this->investor->id)
            ->where('status', 1)
            ->latest('created_at')
            ->value('amount');
        // tính lãi suất theo giây
        $calculator = new InterestCalculator();
        $this->interestCalculator = $calculator->calculator_interest($this->investor);
        // số tiền gửi đang hoạt động
        $this->active_deposit = Investor_with_plants::where('investor_id', $this->investor->id)
            ->where(function ($query) {
                $query->where('status', 1);
            })
            ->sum('amount');
        return view('livewire.web.account.account')->extends('components.layouts.app')->section('content');
    }
}
