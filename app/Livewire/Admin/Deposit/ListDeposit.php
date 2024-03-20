<?php

namespace App\Livewire\Admin\Deposit;

use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\Wallets;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class ListDeposit extends Component
{
    use WithPagination;
    public $search = '';
    public $perpage = 20;
    public $from_date;
    public $wallet;
    public $to_date;
    protected $listeners = [
        'success' => 'render',
    ];
    public function mount()
    {
        $this->from_date = Carbon::now()->startOfMonth()->toDateString();
        $this->to_date = Carbon::now()->endOfMonth()->toDateString();
    }
    public function updateStatus($id)
    {
        $investor_with_plants = Investor_with_plants::find($id);
        $this->wallet = Wallets::where('id', $investor_with_plants->wallet_id)->first();
        if ($investor_with_plants) {
            $investor_with_plants->status = 1;
            $this->wallet->status = 0;
            $investor_with_plants->save();
            $this->wallet->save();
            $this->dispatch('success', 'Confirm the plan successfully.');
        }
    }
    public function cancel($id)
    {
        $investor_with_plants = Investor_with_plants::find($id);
        $investor = Investors::find($investor_with_plants->investor_id);
        $this->wallet = Wallets::where('id', $investor_with_plants->wallet_id)->first();
        if ($investor_with_plants->status == 1 && $investor) {
            $investor_with_plants->status = 3;
            $investor->balance += $investor_with_plants->amount;
            $this->wallet->status = 0;
            $this->wallet->save();
            $investor->save();
            $investor_with_plants->save();
            $this->dispatch('success', 'Cancel plan successfully.');
        } else {
            $investor_with_plants->status = 3;
            $investor_with_plants->save();
            $this->wallet->status = 0;
            $this->wallet->save();
            $this->dispatch('success', 'Cancel plan successfully.');
        }
    }
    public function render()
    {
        $list_deposit = DB::table('investor_with_plants')
            ->join('investors', 'investor_with_plants.investor_id', '=', 'investors.id')
            ->join('plan_models', 'investor_with_plants.plan_id', '=', 'plan_models.id')
            ->select('investor_with_plants.*', 'investors.fullname as investor_name', 'plan_models.name as plan_name', 'plan_models.title as plan_title', 'plan_models.discount as plan_discount')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('investors.fullname', 'like', '%' . $this->search . '%')
                        ->orWhere('investor_with_plants.name_coin', 'like', '%' . $this->search . '%')
                        ->orWhere('plan_models.name', 'like', '%' . $this->search . '%');
                }
            })
            ->where(function ($query) {
                if ($this->from_date) {
                    $query->where('investor_with_plants.created_at', '>=', $this->from_date);
                }
                if ($this->to_date) {
                    $query->where('investor_with_plants.created_at', '<=', $this->to_date);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perpage);
        return view('livewire.admin.deposit.list-deposit', ['list_deposit' => $list_deposit]);
    }
}
