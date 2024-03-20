<?php

namespace App\Livewire\Web\Account;

use App\Models\Investors;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class EditAccount extends Component
{
    #[Title('Edit Account')]
    public $ref;
    public $investor;
    public $email;
    public $username;
    public $fullname;
    public $password;
    public $wallet_address;
    public function mount()
    {
        $data_investor = session()->get('investor');
        $this->investor = Investors::find($data_investor ? $data_investor->id : '');
        if (!$this->investor) {
            return $this->redirect('/login', navigate: true);
        }
        $ref = url()->to('/');
        if ($ref && $this->investor) {
            $this->ref = $ref . '/register?ref=' . $this->investor->username;
        }
        $this->username = $this->investor->username;
        $this->email = $this->investor->email;
        $this->fullname = $this->investor->fullname;
        $this->wallet_address = $this->investor->wallet_address;
    }
    public function submit()
    {
        $validationRules = [
            "email" => "required|email",
            "username" => "required",
            "fullname" => "required",
            "wallet_address" => "required|regex:/^0x[a-fA-F0-9]{40}$/",
        ];
        $this->validate($validationRules);
        $this->investor->username = $this->username;
        $this->investor->fullname = $this->fullname;
        $this->investor->email = $this->email;
        if ($this->wallet_address) {
            $this->investor->wallet_address = $this->wallet_address;
        }
        if ($this->password) {
            $this->investor->password = Hash::make($this->password);
        }
        $this->investor->save();
        session()->flash('success', 'Update successfully');
    }
    public function render()
    {
        return view('livewire.web.account.edit-account')->extends('components.layouts.app')->section('content');
    }
}
