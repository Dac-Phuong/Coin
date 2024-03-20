<?php

namespace App\Livewire\Admin\Investors;

use App\Models\Investors;
use Livewire\Component;
use Livewire\WithPagination;

class ListInvestor extends Component
{
    use WithPagination;
    public $investors;
    public $search = '';
    public $perpage = 20;
    protected $listeners = [
        'success' => 'update',
        'delete' => 'delete'
    ];

    public function update()
    {
        $this->investors = Investors::all();
    }
    public function delete($id)
    {
        $investor = Investors::find($id);
        if (!is_null($investor)) {
            $investor->delete();
        }
        $this->dispatch('success', 'Successful investor deletion.');
    }
    public function render()
    {
        return view('livewire.admin.investors.list-investor', ['list_investor' => Investors::search($this->search)->orderBy('created_at','desc')->paginate($this->perpage)]);
    }
}
