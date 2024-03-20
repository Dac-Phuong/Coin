<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor_with_plants extends Model
{
    use HasFactory;
    protected $table = 'investor_with_plants';

    protected $fillable = [
        'plan_id',
        'investor_id',
        'wallet_id',
        'total_last_seconds',
        'profit',
        'amount',
        'total_amount',
        'number_days',
        'type_payment',
        'name_coin',
        'calculate_money',
        'status',
    ];
    public function scopeSearch($query, $value)
    {
        $query->where('name_coin', 'like', "%{$value}%")->orwhere('total_Amount', 'like', "%{$value}%");
    }
    public function plan()
    {
        return $this->hasMany(PlanModel::class);
    }
    public function investor()
    {
        return $this->hasMany(Investors::class);
    }
}
