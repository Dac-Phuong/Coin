<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $table = 'withdraws';

    protected $fillable = [
        'investor_id',
        'amount',
        'status',
    ];
    public function scopeSearch($query, $value)
    {
        $query->where('amount', 'like', "%{$value}%")->orwhere('status', 'like', "%{$value}%");
    }
    public function investors()
    {
        return $this->belongsTo(Investors::class);
    }
}
