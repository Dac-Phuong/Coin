<?php

namespace App\Livewire\Admin\Wallets;

use App\Models\PlanModel;
use App\Models\Wallets;
use Livewire\Component;

class UpdateWallet extends Component
{
    public $wallet_address_bsc;
    public $wallet_address_tron;
    public $wallet;
    public $plan;
    public $plan_id;
    protected $listeners = ['update' => 'mount'];

    public function mount($id = null)
    {
        $this->wallet = Wallets::find($id);
        if ($this->wallet) {
            $this->wallet_address_bsc = $this->wallet->wallet_address_bsc;
            $this->wallet_address_tron = $this->wallet->wallet_address_tron;
            $this->plan_id = $this->wallet->plan_id;
        }
    }
    public function submit()
    {
        $this->validate([
            // 'wallet_address_bsc' => 'required|regex:/^[a-zA-Z0-9\s.,_-]+$/',
            // 'wallet_address_tron' => 'required|regex:/^[a-zA-Z0-9\s.,_-]+$/',
            'plan_id' => 'required',
        ]);

        $this->wallet->wallet_address_bsc = $this->wallet_address_bsc;
        $this->wallet->wallet_address_tron = $this->wallet_address_tron;
        $this->wallet->plan_id = $this->plan_id;
        $this->wallet->save();
        $this->dispatch('success', 'Wallet updated successfully.');
        $this->reset();
    }
    public function render()
    {
        $this->plan = PlanModel::get();
        return view('livewire.admin.wallets.update-wallet');
    }
}
