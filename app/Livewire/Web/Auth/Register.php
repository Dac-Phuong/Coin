<?php

namespace App\Livewire\Web\Auth;

use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\Referal_detail;
use App\Models\Referals;
use App\Models\Wallets;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    #[Title('Register')]

    public $wallets;
    public $email;
    public $confirm_email;
    public $username;
    public $fullname;
    public $password;
    public $confirm_password;
    public $question;
    public $answer;
    public $agree;
    public $ref;
    public $error = null;
    public function mount()
    {
        $this->ref = request()->input('ref');
    }
    public function submit()
    {
        $validationRules = [
            'fullname' => 'required|min:3|max:255',
            'username' => [
                'required',
                'min:6',
                'max:255',
                'unique:investors,username',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'email' => 'required|email|unique:investors,email',
            'confirm_email' => 'required|email|same:email',
            'question' => 'required',
            'answer' => 'required',
            'agree' => 'accepted',
        ];
        $this->validate($validationRules);
        if ($this->ref) {
            $investor = Investors::where('username',  $this->ref)->first();
            $checkDeposit = Investor_with_plants::where('investor_id',  $investor->id)->where('status', 1)->orwhere('status', 2)->first();
            $referal = Referals::first();
            if ($referal) {
                $referal_detail = Referal_detail::create([
                    'investor_id' => $investor->id,
                    'referal_id' => $referal->id,
                    'number_referals' => 1,
                    'amount_received' => $referal->amount_money,
                    'status' => $checkDeposit ? 1 : 0,
                ]);
                $referal_detail->save();
            }
            if ($checkDeposit) {
                $investor->balance += $referal->amount_money;
                $investor->save();
            }
        }
        $investors = Investors::create([ 
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'referal_code' => $investor->username ?? null,
            'password' => Hash::make($this->password),
        ]);
        $investors->save();
        return $this->redirect('/login', navigate: true);
    }
    public function render()
    {
        return view('livewire.web.auth.register')->extends('components.layouts.app')->section('content');
    }
}
