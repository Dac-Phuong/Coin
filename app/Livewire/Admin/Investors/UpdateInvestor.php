<?php

namespace App\Livewire\Admin\Investors;

use App\Models\Investors;
use App\Models\Wallets;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateInvestor extends Component
{
    public $fullname;
    public $username;
    public $email;
    public $phone;
    public $password;
    public $wallet_id;
    public $wallets;
    public $wallet_address;
    public $investor;
    protected $listeners = ['update' => 'mount'];
    public function mount($id = null)
    {
        $this->investor = Investors::find($id);
        if ($this->investor) {
            $this->fullname = $this->investor->fullname;
            $this->username = $this->investor->username;
            $this->wallet_address = $this->investor->wallet_address;
            $this->email = $this->investor->email;
        }
    }
    public function submit()
    {
        $this->validate(
            [
                'fullname' => 'required|string|',
                'email' => 'required|email',
                "wallet_address" => "required|regex:/^0x[a-fA-F0-9]{40}$/",
            ]
        );
        $this->investor->username = $this->username;
        $this->investor->fullname = $this->fullname;
        $this->investor->email = $this->email;
        $this->investor->wallet_address = $this->wallet_address;
        if ($this->password) {
            $this->investor->password = Hash::make($this->password);
        }
        $this->investor->save();
        $this->dispatch('success', 'Successfully edited investor information.');
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.admin.investors.update-investor');
    }
}
