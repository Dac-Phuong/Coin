<?php

namespace App\Livewire\Admin\Deposit;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DetailDeposit extends Component
{
    public $detail = null;
    protected $listeners = ['update' => 'mount'];
    public function mount($id = null)
    {
        $this->detail = DB::table('investor_with_plants')
            ->join('investors', 'investor_with_plants.investor_id', '=', 'investors.id')
            ->join('plan_models', 'investor_with_plants.plan_id', '=', 'plan_models.id')
            ->join('wallets', 'investor_with_plants.wallet_id', '=', 'wallets.id')
            ->select('investor_with_plants.*','wallets.wallet_address_bsc as wallet_address_bsc','wallets.wallet_address_tron as wallet_address_tron', 'investors.fullname as investor_name', 'plan_models.name as plan_name', 'plan_models.title as plan_title', 'plan_models.discount as plan_discount')
            ->where('investor_with_plants.id', $id)->first();
           
    }
    public function generateQrCode()
    {
        return $this->detail && $this->detail->wallet_address_bsc ? QrCode::size(120)->generate($this->detail->wallet_address_bsc) : null;
    }
    public function generateQrCode1()
    {
        return $this->detail && $this->detail->wallet_address_tron ? QrCode::size(120)->generate($this->detail->wallet_address_tron) : null;
    }

    public function render()
    {
        return view('livewire.admin.deposit.detail-deposit');
    }
}
