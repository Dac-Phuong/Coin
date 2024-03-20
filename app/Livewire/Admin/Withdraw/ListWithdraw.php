<?php

namespace App\Livewire\Admin\Withdraw;

use App\Models\Investors;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListWithdraw extends Component
{
    public $perpage = 20;
    public $search = '';
    public $from_date;
    public $to_date;
    public function mount()
    {
        $this->from_date = Carbon::now()->startOfMonth()->toDateString();
        $this->to_date = Carbon::now()->endOfMonth()->toDateString();
    }
    public function comfirm_withdraw($id)
    {
        $withdraw = Withdraw::find($id);
        if ($withdraw) {
            $withdraw->status = 1;
            $withdraw->save();
            $this->dispatch('success', 'Confirm successful withdrawal.');
        }
    }
    public function cancel($id)
    {
        $cancel_withdraw = Withdraw::find($id);
        $investor = Investors::find($cancel_withdraw->investor_id);
        if ($cancel_withdraw->status == 0) {
            $cancel_withdraw->status = 2;
            $investor->balance += $cancel_withdraw->amount;
            $investor->save();
            $cancel_withdraw->save();
            $this->dispatch('success', 'Withdrawal successfully canceled.');
        } else {
            $cancel_withdraw->status = 2;
            $cancel_withdraw->save();
            $this->dispatch('success', 'Withdrawal successfully canceled.');
        }
    }
    public function render()
    {
        $list_withdraw = DB::table('withdraws')
            ->join('investors', 'withdraws.investor_id', '=', 'investors.id')
            ->select('withdraws.*', 'investors.fullname as fullname', 'investors.wallet_address as wallet_address')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('investors.fullname', 'like', '%' . $this->search . '%')
                        ->orWhere('withdraws.amount', 'like', '%' . $this->search . '%');
                }
            })
            ->where(function ($query) {
                if ($this->from_date) {
                    $query->where('withdraws.created_at', '>=', $this->from_date);
                }
                if ($this->to_date) {
                    $query->where('withdraws.created_at', '<=', $this->to_date);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perpage);
        return view('livewire.admin.withdraw.list-withdraw', ['list_withdraw' => $list_withdraw]);
    }
}
