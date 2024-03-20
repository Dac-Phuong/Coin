<?php

namespace App\Livewire\Web\Deposit;

use App\Components\InterestCalculator;
use App\Models\Daily_discounts;
use App\Models\Investors;
use App\Models\plan_number_days;
use App\Models\PlanModel;
use Livewire\Attributes\Title;
use Livewire\Component;

class Deposit extends Component
{
    #[Title('Deposit')]

    public $plan_fixeds;
    public $plan_daily;
    public $investor;
    public $ref;
    public $interestCalculator;

    protected $listeners = [
        'success' => 'render',
    ];
    public function mount()
    {
        $data_investor = session()->get("investor");
        $this->investor = Investors::find($data_investor ? $data_investor->id : '');
        if (!$this->investor) {
            return $this->redirect('/login', navigate: true);
        }
        $ref = url()->to('/');
        if ($ref && $this->investor) {
            $this->ref = $ref . '/register?ref=' . $this->investor->username;
        }
        $this->plan_daily = PlanModel::where('package_type', 0)->get();
    }

    public function render()
    {
        $plan_fixeds = PlanModel::where('package_type', 1)->get();
        foreach ($plan_fixeds as $key => $item) {
            $profit_day = plan_number_days::where(['plan_id' => $item->id, 'number_days' => 1])->first();
            $profit_week = plan_number_days::where(['plan_id' => $item->id, 'number_days' => 30])->first();
            $item["deposit_days"] = (preg_replace('/[^0-9]/', '',  $profit_day->profit)  / 10000) * (preg_replace('/[^0-9]/', '', $item->min_deposit) / 100);
            if ($profit_week) {
                $item["deposit_week"] = (preg_replace('/[^0-9]/', '',  $profit_week->profit)  / 10000) * preg_replace('/[^0-9]/', '', $item->min_deposit) / 100;
            }
            $item["deposit_year"] = (preg_replace('/[^0-9]/', '',  $item->discount)  / 10000) * preg_replace('/[^0-9]/', '', $item->min_deposit) / 100;
        }
        $this->plan_fixeds = $plan_fixeds;
        $calculator = new InterestCalculator();
        $this->interestCalculator = $calculator->calculator_interest($this->investor);
        return view('livewire.web.deposit.deposit')->extends('components.layouts.app')->section('content');
    }
}
