<?php

namespace App\Livewire\Web\Deposit;

use App\Models\Daily_discounts;
use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\plan_number_days;
use App\Models\PlanModel;
use App\Models\Wallets;
use Carbon\Carbon;
use Livewire\Component;

class ConfirmModal extends Component
{
    public $calculator;
    public $investor_with_plans;
    public $confirm = false;
    public $plan;
    public $wallet;
    public $investor;
    public $number_days;
    public $curent_profit = 0;
    protected $listeners = ['update' => 'mount'];

    public function mount($id = null)
    {
        $data_investor = session()->get('investor');
        if (!$data_investor) {
            return $this->redirect('/login', navigate: true);
        }
        $this->investor = Investors::find($data_investor->id);
        $this->investor_with_plans = Investor_with_plants::find($id);
        if ($this->investor_with_plans) {
            $this->confirm = false;
            $this->plan = PlanModel::where('id', $this->investor_with_plans->plan_id)->first();
            $this->wallet = Wallets::where('id', $this->investor_with_plans->wallet_id)->first();
            if ($this->plan->package_type == 0) {
                $this->confirm = true;
                $purchase_date = Carbon::parse($this->investor_with_plans->created_at);
                $to_date = Carbon::parse($this->plan->to_date);
                $interval = $purchase_date->diff($to_date);
                $this->calculator_profit($this->investor_with_plans, $this->plan, $interval);
            } else {
                $this->confirm = true;
                $purchase_date = Carbon::parse($this->investor_with_plans->created_at);

                $this->calculator_profit_fixed($this->investor_with_plans, $this->plan, $purchase_date);
            }
        }
    }
    public function calculator_profit($investor_with_plans, $plan, $interval)
    {
        $daily_discount = Daily_discounts::where('plan_id', $plan->id)->orderBy('discount', 'asc')->get();
        foreach ($daily_discount as $value) {
            $total_seconds_discount = Carbon::parse($plan->to_date)->diffInSeconds($value->end_date);
            if ($investor_with_plans->total_last_seconds <= $total_seconds_discount) {
                $this->curent_profit = $value->discount;
                break;
            }
        }
        $Caculation_old_profit = $investor_with_plans->total_last_seconds * ((((preg_replace('/[^0-9]/', '', $investor_with_plans->profit) / 10000) * $investor_with_plans->amount) / $interval->days) / 24 / 60 / 60);
        $Caculation_new_profit = $investor_with_plans->total_last_seconds * ((((preg_replace('/[^0-9]/', '', $this->curent_profit) / 10000) * $investor_with_plans->amount) / $interval->days) / 24 / 60 / 60);
        $this->calculator = $Caculation_old_profit - $Caculation_new_profit;
    }

    public function calculator_profit_fixed($investor_with_plans, $plan, $purchase_date)
    {
        $number_days = plan_number_days::where('plan_id', $plan->id)->get();
        $total_seconds_profit = Carbon::parse($purchase_date)->diffInSeconds(Carbon::parse($purchase_date->addDays($investor_with_plans->number_days)->format('Y-m-d H:i:s')));
        foreach ($number_days as $value) {
            if ($investor_with_plans->total_last_seconds <= $total_seconds_profit) {
                $this->curent_profit = $value->profit;
                break;
            }
        }
        $Caculation_old_profit = $investor_with_plans->total_last_seconds * ((((preg_replace('/[^0-9]/', '', $investor_with_plans->profit) / 10000) * $investor_with_plans->amount) / $investor_with_plans->number_days) / 24 / 60 / 60);
        $Caculation_new_profit = $investor_with_plans->total_last_seconds * ((((preg_replace('/[^0-9]/', '', $this->curent_profit) / 10000) * $investor_with_plans->amount) / $investor_with_plans->number_days) / 24 / 60 / 60);
        $this->calculator = $Caculation_old_profit - $Caculation_new_profit;
    }

    public function confirm_cancel()
    {
        if ($this->investor_with_plans && $this->plan) {
            if ($this->investor_with_plans->status == 1) {
                $this->investor->balance += $this->investor_with_plans->amount;
                if ($this->confirm == true) {
                    $this->investor->balance -= $this->calculator;
                    $this->investor->earned_toatl -= $this->calculator;
                }
                $this->investor->save();
            }
            $this->wallet->status = 0;
            $this->investor_with_plans->status = 3;
            $this->investor_with_plans->save();
            $this->wallet->save();
            $this->dispatch('success', 'T');
        }
    }

    public function render()
    {
        return view('livewire.web.deposit.confirm-modal');
    }
}
