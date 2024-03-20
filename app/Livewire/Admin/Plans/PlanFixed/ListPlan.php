<?php

namespace App\Livewire\Admin\Plans\PlanFixed;

use App\Models\PlanModel;
use Livewire\Component;
use Livewire\WithPagination;

class ListPlan extends Component
{
    use WithPagination;

    public $search = '';
    public $perpage = 20;
    public $plan;
    protected $listeners = [
        'success' => 'update',
        'delete' => 'delete'
    ];
    public function update()
    {
        $this->plan = PlanModel::all();
        $this->reset();
    }
    public function delete($id)
    {
        $plan = PlanModel::find($id);
        if (!is_null($plan)) {
            $plan->delete();
        }
        $this->dispatch('success', 'Delete fixed plan successfully.');
    }
    public function render()
    {
        return view('livewire.admin.plans.plan-fixed.list-plan', ['list_plans' => PlanModel::search($this->search)->where('package_type', 1)->orderBy('created_at', 'desc')->paginate($this->perpage)]);
    }
}
