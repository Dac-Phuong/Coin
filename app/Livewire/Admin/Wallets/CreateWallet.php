<?php

namespace App\Livewire\Admin\Wallets;

use App\Models\PlanModel;
use App\Models\Wallets;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateWallet extends Component
{
    public $address_wallet_bsc;
    public $address_wallet_tron;
    public $wallet_type = 0;
    public $plan;
    public $plan_id;

    public function submit()
    {
        $this->validate([
            'address_wallet_bsc' => 'required|regex:/^[a-zA-Z0-9\s.,_-]+$/',
            'address_wallet_tron' => 'required|regex:/^[a-zA-Z0-9\s.,_-]+$/',
            "plan_id" => "required",
        ]);
        $new_array1 = explode("\n", $this->address_wallet_bsc);
        $new_array2 = explode("\n", $this->address_wallet_tron);
        $new_array1 = array_filter($new_array1, 'strlen');
        $new_array2 = array_filter($new_array2, 'strlen');
        try {
            if ($this->address_wallet_bsc) {
                foreach ($new_array1 as $key => $value) {
                    $check_wallet_address = Wallets::where('wallet_address_bsc', $value)->first();
                    if ($check_wallet_address) {
                        return $this->dispatch('error', "Adding wallet failed.{$value} already exists.");
                    }
                    DB::table('wallets')
                        ->updateOrInsert(
                            ['wallet_address_bsc' => null],
                            ['wallet_address_bsc' => $value, 'plan_id' => $this->plan_id]
                        );
                }
                $this->dispatch('success', 'Wallet added successfully.');
            }
            if ($this->address_wallet_tron) {
                foreach ($new_array2 as $key => $value) {
                    $check_wallet_address = Wallets::where('wallet_address_tron', $value)->first();
                    if ($check_wallet_address) {
                        return $this->dispatch('error', "Adding wallet failed.{$value} already exists.");
                    }
                    DB::table('wallets')
                        ->updateOrInsert(
                            ['wallet_address_tron' => null],
                            ['wallet_address_tron' => $value, 'plan_id' => $this->plan_id],
                        );
                }
                $this->dispatch('success', 'Wallet added successfully.');
            }
        } catch (\Exception $e) {
            $this->dispatch('error', $e->getMessage());
        }
        $this->reset();
    }
    public function render()
    {
        $this->plan = PlanModel::get();
        return view('livewire.admin.wallets.create-wallet');
    }
}
