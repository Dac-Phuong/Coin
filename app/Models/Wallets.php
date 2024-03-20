<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;
    protected $table = 'wallets';

    protected $fillable = [
        'wallet_address_bsc',
        'wallet_address_tron',
        'status',
        'plan_id',
    ];
    public function scopeSearch($query, $value)
    {
        $query->where('wallet_address_bsc', 'like', "%{$value}%")->orwhere('wallet_address_tron', 'like', "%{$value}%");
    }
    public function investors()
    {
        return $this->belongsTo(Investors::class);
    }
    public function planModel()
    {
        return $this->belongsTo(PlanModel::class);
    }
}
