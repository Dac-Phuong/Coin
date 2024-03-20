<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class InvestorController extends Controller
{
    public function index()
    {
        return view("admin.investors.index");
    }
    public function history_deposit($id)
    {
        return view("admin.investors.history-deposit", ['id' => $id]);
    }
    public function history_withdraw($id)
    {
        return view("admin.investors.history-withdraw", ['id' => $id]);
    }
}
