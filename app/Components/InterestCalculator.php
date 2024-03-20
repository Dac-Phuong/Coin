<?php

namespace App\Components;

use App\Models\Investor_with_plants;
use App\Models\Referal_detail;
use App\Models\Referals;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class InterestCalculator
{
    public $interval;
    protected function getInvestorPlansFixed($investor)
    {
        return DB::table('investor_with_plants')
            ->join('investors', 'investor_with_plants.investor_id', '=', 'investors.id')
            ->join('plan_models', 'investor_with_plants.plan_id', '=', 'plan_models.id')
            ->select('plan_models.*', 'investor_with_plants.id as Investor_with_plants_id', 'investor_with_plants.number_days as number_days', 'investor_with_plants.profit as profit', 'investor_with_plants.id as Investor_with_plants_id', 'investor_with_plants.total_last_seconds as total_last_seconds', 'investor_with_plants.created_at as purchase_date', 'investor_with_plants.status as Investor_with_plants_status', 'investor_with_plants.total_amount as total_amount', 'investor_with_plants.amount as amount', 'investors.fullname as investor_name', 'plan_models.name as plan_name', 'plan_models.title as plan_title', 'plan_models.discount as plan_discount', 'plan_models.to_date as to_date', 'plan_models.from_date as start_date')
            ->where('investor_id', $investor->id)
            ->where('package_type', 1)
            ->where('investor_with_plants.status', '!=', 3)
            ->get();
    }
    protected function getInvestorPlansDaily($investor)
    {
        return DB::table('investor_with_plants')
            ->join('investors', 'investor_with_plants.investor_id', '=', 'investors.id')
            ->join('plan_models', 'investor_with_plants.plan_id', '=', 'plan_models.id')
            ->select('plan_models.*', 'investor_with_plants.id as Investor_with_plants_id', 'investor_with_plants.number_days as number_days', 'investor_with_plants.profit as profit', 'investor_with_plants.id as Investor_with_plants_id', 'investor_with_plants.total_last_seconds as total_last_seconds', 'investor_with_plants.created_at as purchase_date', 'investor_with_plants.status as Investor_with_plants_status', 'investor_with_plants.total_amount as total_amount', 'investor_with_plants.amount as amount', 'investors.fullname as investor_name', 'plan_models.name as plan_name', 'plan_models.title as plan_title', 'plan_models.discount as plan_discount', 'plan_models.to_date as to_date', 'plan_models.from_date as start_date')
            ->where('package_type', 0)
            ->where('investor_id', $investor->id)
            ->where('investor_with_plants.status', '!=', 3)
            ->get();
    }
    public function calculator_interest($investor)
    {
        $this->calculatorInterestPlanFixed($investor);
        $this->calculatorInterestPlanDaily($investor);
        $this->check_referal($investor);
    }
    // tính toán gói cố định
    public function calculatorInterestPlanFixed($investor)
    {
        $currentDate = Carbon::now();
        $list_plan = $this->getInvestorPlansFixed($investor);
        foreach ($list_plan as $plan) {
            $purchase_date = Carbon::parse($plan->purchase_date);
            $to_date = Carbon::parse($plan->to_date);
            // tính số ngày từ ngày bắt đầu đến ngày kết thúc.
            $this->interval = $purchase_date->diff($to_date);
            // thêm ngày
            $end_date = $purchase_date->addDays($plan->number_days)->format('Y-m-d H:i:s');
            // lấy ra investor_with_plants
            $investor_with_plants = Investor_with_plants::find($plan->Investor_with_plants_id);
            // tính số giây hiện tại đến khi kết thúc
            $curent_seconds = $currentDate->diffInSeconds($plan->purchase_date);
            // kiểm tra $curent_date nằm trong khoảng $start_date đến $end_date và tính theo gói cố định.
            if ($currentDate->greaterThanOrEqualTo(Carbon::parse($plan->purchase_date)) && $currentDate->lessThanOrEqualTo($end_date) && $plan->type_date == 0 && $plan->package_type == 1 && $plan->Investor_with_plants_status == 1) {
                // tính lại số giây mới
                $new_seconds = $curent_seconds - $investor_with_plants->total_last_seconds;
                // tính số giây mới * với số tiền và lưu lại 
                $investor->balance += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / $plan->number_days) / 24 / 60 / 60);
                // tính số giây mới * với số tiền và lưu lại vào investor_with_plants
                $investor_with_plants->calculate_money += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / $plan->number_days) / 24 / 60 / 60);
                // tính số giây mới * với số tiền và lưu lại 
                $investor->earned_toatl += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / $plan->number_days) / 24 / 60 / 60);
                // lưu lại số giây mới
                $investor_with_plants->total_last_seconds = $curent_seconds;
                $investor_with_plants->save();
                $investor->save();
                // kiểm tra nếu là kiểu gói ngày và là loại "affter"
            } elseif ($currentDate->gte($end_date) && $plan->Investor_with_plants_status == 1 && $plan->type_date == 1 && $plan->package_type == 1) {
                // nếu hoàn thành gói thì cộng lại tiền và lãi.
                $investor->balance += $plan->total_amount;
                $investor_with_plants->status = 2;
                $investor->save();
                $investor_with_plants->save();
                // kiểm tra xem có phải gói ngày không và kiểm tra thời gian từ bắt đầu đến khi kết thúc.
            } elseif ($currentDate->gte($end_date) && $plan->package_type == 1 && $plan->Investor_with_plants_status == 1) {
                // cộng lại số tiền đã gửi.
                $investor->balance += $plan->amount;
                // thay đổi trạng thái sang hoàn thành.
                $investor_with_plants->status = 2;
                // lưu lại.
                $investor_with_plants->save();
                $investor->save();
                // tính toán lại
            }
            $investor_with_plants = Investor_with_plants::find($plan->Investor_with_plants_id);
            $this->recalculationPlanFixed($plan, $investor_with_plants, $end_date, $investor, $currentDate);
        }
    }

    protected function recalculationPlanFixed($plan, $investor_with_plants, $end_date, $investor, $currentDate)
    {
        if ($currentDate->gte($end_date) && $plan->type_date == 0 && $plan->package_type == 1 &&  $investor_with_plants->status == 2) {
            $profit_money = $investor_with_plants->total_amount - $investor_with_plants->amount;
            // kiểm tra nếu số giây đã tính ở trên còn thiếu.
            if ($profit_money > $investor_with_plants->calculate_money) {
                // tính số giây còn thiếu 
                $missing_amount = $profit_money - $investor_with_plants->calculate_money;
                // cộng lại số tiền còn thiếu.
                $investor_with_plants->calculate_money += $missing_amount;
                //  cộng lại số tiền còn thiếu,
                $investor->earned_toatl += $missing_amount;
                //  cộng lại số tiền còn thiếu,
                $investor->balance += $missing_amount;
                // lưu lại
                $investor->save();
                $investor_with_plants->save();
            } elseif ($profit_money < $investor_with_plants->calculate_money) {
                // tính số tiền bị thừa
                $missing_amount = $investor_with_plants->calculate_money - $profit_money;
                // trừ đi số tiền bị thừa.
                $investor_with_plants->calculate_money -= $missing_amount;
                //  trừ đi số tiền bị thừa.
                $investor->earned_toatl -= $missing_amount;
                //   trừ đi số tiền bị thừa.
                $investor->balance -= $missing_amount;
                // lưu lại
                $investor->save();
                $investor_with_plants->save();
            }
        }
    }
    // tính toán gói ngày
    public function calculatorInterestPlanDaily($investor)
    {
        $currentDate = Carbon::now();
        $list_plan = $this->getInvestorPlansDaily($investor);
        foreach ($list_plan as $plan) {
            $purchase_date = Carbon::parse($plan->purchase_date);
            $from_date = Carbon::parse($plan->start_date);
            $to_date = Carbon::parse($plan->to_date);
            // tính số ngày từ ngày bắt đầu đến ngày kết thúc.
            $this->interval = $purchase_date->diff($to_date);
            // lấy ra investor_with_plants
            $investor_with_plants = Investor_with_plants::find($plan->Investor_with_plants_id);
            // tính số giây hiện tại đến khi kết thúc
            $curent_seconds = $currentDate->diffInSeconds($plan->purchase_date);
            // kiểm tra $curent_date nằm trong khoảng $start_date đến $end_date và tính theo gói cố định.
            if ($currentDate->greaterThanOrEqualTo($from_date) && $currentDate->lessThanOrEqualTo($to_date) && $plan->package_type == 0 && $plan->Investor_with_plants_status == 1) {
                // tính lại số giây mới
                $new_seconds = $curent_seconds - $investor_with_plants->total_last_seconds;
                // lấy ngày mua
                $purchase_date = Carbon::parse($plan->purchase_date);
                // tính số giây từ ngày mua đến ngày kết thúc.
                $interval = $purchase_date->diffInSeconds($to_date);
                // đổi 1 ngày ra giây.
                $seconds = 86400;
                // tính số giây
                $total_seconds = $this->interval->days * $seconds;
                // tính số giây từ ngày mua đến ngày kết thúc - số giây của số ngày.
                $remaining_seconds = $interval - $total_seconds;
                // tính số giây mới * với số tiền và lưu lại .
                $investor->balance += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / ($this->interval->days + ($remaining_seconds / $seconds))) / 24 / 60 / 60);
                // tính số giây mới * với số tiền và lưu lại vào investor_with_plants 
                $investor_with_plants->calculate_money += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / ($this->interval->days + ($remaining_seconds / $seconds))) / 24 / 60 / 60);
                // tính số giây mới * với số tiền và lưu lại .
                $investor->earned_toatl += $new_seconds * ((((preg_replace('/[^0-9]/', '', $plan->profit) / 10000) * $plan->amount) / ($this->interval->days + ($remaining_seconds / $seconds))) / 24 / 60 / 60);
                $investor_with_plants->total_last_seconds = $curent_seconds;
                $investor_with_plants->save();
                $investor->save();
                // kiểm tra xem gói đã hoàn thành chưa  nếu hoàn thành thì thay đổi trạng thái và lưu lại và + lại số tiền đã gửi.
            } elseif ($currentDate->gte($from_date) && $currentDate >= $to_date && $plan->package_type == 0) {
                // cộng lại số tiền đã gửi.
                $investor->balance += $plan->amount;
                // thay đổi trạng thái sang hoàn thành.
                $investor_with_plants->status = 2;
                // lưu lại.
                $investor_with_plants->save();
                $investor->save();
            }
            $investor_with_plants = Investor_with_plants::find($plan->Investor_with_plants_id);
            $this->recalculationPlanDaily($plan, $investor_with_plants, $investor, $currentDate, $from_date);
        }
    }
    protected function recalculationPlanDaily($plan, $investor_with_plants, $investor, $currentDate, $from_date)
    {
        if ($plan->package_type == 0 &&  $investor_with_plants->status == 2) {
            // lấy ra ngày mua
            $profit_money = $investor_with_plants->total_amount - $investor_with_plants->amount;
            // kiểm tra nếu số giây đã tính ở trên còn thiếu.
            if ($profit_money > $investor_with_plants->calculate_money) {
                // tính số tiền còn thiếu
                $missing_amount = $profit_money - $investor_with_plants->calculate_money;
                // cộng lại số tiền còn thiếu.
                $investor_with_plants->calculate_money += $missing_amount;
                //  cộng lại số tiền còn thiếu,
                $investor->earned_toatl += $missing_amount;
                //  cộng lại số tiền còn thiếu,
                $investor->balance += $missing_amount;
                // lưu lại
                $investor->save();
                $investor_with_plants->save();
            } elseif ($profit_money < $investor_with_plants->calculate_money) {
                // tính số tiền bị thừa
                $missing_amount = $investor_with_plants->calculate_money - $profit_money;
                // trừ đi số tiền bị thừa.
                $investor_with_plants->calculate_money -= $missing_amount;
                // trừ đi số tiền bị thừa.
                $investor->earned_toatl -= $missing_amount;
                // trừ đi số tiền bị thừa.
                $investor->balance -= $missing_amount;
                // lưu lại
                $investor->save();
                $investor_with_plants->save();
            }
        }
    }
    // kiểm tra giới thiệu check đã nạp tiền 
    public function check_referal($investor)
    {
        $checkDeposit = Investor_with_plants::where('investor_id', $investor->id)
            ->whereIn('status', [1, 2])
            ->first();
        $referal_details = Referal_detail::where('investor_id', $investor->id)
            ->where('status', 0)
            ->get();
        if ($checkDeposit && $referal_details->isNotEmpty()) {
            foreach ($referal_details as $referal_detail) {
                $referal = Referals::find($referal_detail->referal_id);
                if ($referal) {
                    $investor->balance += $referal->amount_money;
                    $referal_detail->status = 1;
                    $referal_detail->save();
                }
            }
            $investor->save();
        }
    }
}
