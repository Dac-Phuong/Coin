<?php

namespace App\Livewire\Admin\Wallets;

use App\Models\Wallets;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListWallet extends Component
{
    use WithPagination;

    public $search = '';
    public $perpage = 20;
    public $wallets;
    protected $listeners = [
        'success' => 'update',
        'delete' => 'delete'
    ];
    public function update()
    {
        $this->wallets = Wallets::all();
    }
    public function delete($id)
    {
        $wallet = Wallets::find($id);
        if (!is_null($wallet)) {
            $wallet->delete();
        }
        $this->dispatch('success', 'Wallet deleted successfully.');
    }
    public function render()
    {
        $list_wallet = DB::table('wallets')
            ->join('plan_models', 'wallets.plan_id', '=', 'plan_models.id')
            ->select('wallets.*', 'plan_models.name as plan_name', 'plan_models.title as plan_title', 'plan_models.min_deposit as min_deposit')
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('wallets.wallet_address_bsc', 'like', '%' . $this->search . '%')
                        ->orWhere('wallets.wallet_address_tron', 'like', '%' . $this->search . '%')
                        ->orWhere('plan_models.name', 'like', '%' . $this->search . '%');
                }
            })
            ->orderBy('plan_id', 'desc')
            ->paginate($this->perpage);
        return view('livewire.admin.wallets.list-wallet', ['list_wallet' => $list_wallet]);
    }
}
