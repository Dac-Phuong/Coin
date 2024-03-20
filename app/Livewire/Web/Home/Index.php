<?php

namespace App\Livewire\Web\Home;

use App\Models\plan_number_days;
use App\Models\PlanModel;
use Livewire\Component;

class Index extends Component
{
    public $plan_fixeds;
    public $plan_daily;
    public $investor;
    public function mount()
    {
        $this->investor = session()->get("investor");
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
        return view('livewire.web.home.index')->extends('web.layouts.master')->section('content');
    }
}
