<?php

namespace App\Livewire\Web\Deposit;

use App\Components\InterestCalculator;
use App\Models\Daily_discounts;
use App\Models\Investor_with_plants;
use App\Models\Investors;
use App\Models\plan_number_days;
use App\Models\PlanModel;
use App\Models\Wallets;
use Carbon\Carbon;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DepositModal extends Component
{
    public $plan;
    public $min_deposit;
    public $investor;
    public $daily_discounts;
    public $interestCalculator;
    public $wallet;
    public $amount = 0;
    public $total = 0;
    public $type_payment = 0;
    public $profit = 0;
    public $number_days_id;
    public $plan_number_days;
    public $current_discount;
    public $currentTab = 'tab1';
    public $isOpen = true;
    public $total_amount;
    public $number_days;
    public $curent_date;
    public $query_plan_number_days;
    protected $listeners = ['update' => 'mount'];
    public function mount($id = null)
    {
        $data_investor = session()->get('investor');
        if (!$data_investor) {
            return $this->redirect('/login', navigate: true);
        }
        $this->investor = Investors::find($data_investor->id);
        $this->plan = PlanModel::find($id);
        $this->curent_date = Carbon::now();
        $this->isOpen = true;
        if ($this->plan) {
            $this->wallet = Wallets::where('status', 0)->where('plan_id', $this->plan->id)->first();
            $this->min_deposit = $this->plan->min_deposit;
            $this->plan_number_days = plan_number_days::where('plan_id', $this->plan->id)->get();
            if ($this->plan->package_type == 1) {
                $this->total_amount = (preg_replace('/[^0-9]/', '',  $this->plan_number_days[0]->profit)  / 10000) * preg_replace('/[^0-9]/', '', $this->plan->min_deposit) / 100;
                $this->number_days_id = $this->plan_number_days[0]->id;
            }
            $this->daily_discounts = Daily_discounts::where('plan_id', $this->plan->id)
                ->orderBy('start_date')
                ->get()
                ->toArray();
            $this->calculateCurrentDiscount($this->curent_date);
        }
    }
    public function calculateCurrentDiscount($curent_date)
    {
        $this->current_discount = $this->plan->discount;
        $from_date = Carbon::parse($this->plan->from_date);
        $to_date = Carbon::parse($this->plan->to_date);
        $end_date = Carbon::parse($this->plan->end_date);
        if ($curent_date->greaterThanOrEqualTo($from_date) && $curent_date->lessThanOrEqualTo($to_date)) {
            foreach ($this->daily_discounts as $value) {
                $start_date = Carbon::parse($value['start_date']);
                $end_date = Carbon::parse($value['end_date']);
                if ($curent_date->greaterThanOrEqualTo($start_date) && $curent_date->lessThanOrEqualTo($end_date)) {
                    $this->current_discount = $value['discount'];
                    break;
                } else {
                    $this->current_discount = $this->plan->discount;
                }
            }
        } elseif ($curent_date > $end_date) {
            $this->isOpen = false;
        }
    }
    public function switchTab($tab)
    {
        $this->currentTab = $tab;
        if ($this->currentTab == 'tab2') {
            $this->type_payment = 1;
        } else {
            $this->type_payment = 0;
        }
    }
    public function generateQrCode()
    {
        return $this->wallet && $this->wallet->wallet_address_bsc ? QrCode::size(120)->generate($this->wallet->wallet_address_bsc) : null;
    }
    public function generateQrCode1()
    {
        return $this->wallet && $this->wallet->wallet_address_tron ? QrCode::size(120)->generate($this->wallet->wallet_address_tron) : null;
    }

    public function sendMesageTelegram($invertPlant)
    {
        $status = '';
        switch ($invertPlant['status']) {
            case 0:
                $status = 'Pending';
                break;
            case 1:
                $status = 'Running';
                break;
            default:
                break;
        }

        $botApiToken = env('TELEGRAM_TOKEN');
        $channelId = env('TELEGRAM_CHANEL_ID');
        $txtMesage = "
            ✨================🌟🌟🌟🌟🌟===================✨
            ✨============= LỆNH ĐẦU TƯ =============
            ✨=================🌟🌟🌟🌟🌟==================
            ✨Coin : " . $invertPlant['name_coin'] . "
            ✨Gói : $" . $invertPlant['amount'] . "
            ✨Trạng Thái : " . $status . "
            ✨Tên : " . $this->investor->username . "
            ✨Email : " . $this->investor->email . "
            ✨Địa chỉ ví chuyển : " . $this->investor->wallet_address . "
            ✨==================🌟🌟🌟🌟🌟==================✨";
        $query = http_build_query([
            'chat_id' => $channelId,
            'text' => $txtMesage,
        ]);
        $url = "https://api.telegram.org/bot{$botApiToken}/sendMessage?{$query}";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        curl_exec($curl);
        curl_close($curl);
    }
    public function submit()
    {
        if ($this->type_payment == 1) {
            if ($this->investor->balance < $this->amount) {
                session()->flash('error', 'Your account balance is not enough to purchase the package.');
            } else {
                if ($this->plan->package_type == 1) {
                    $this->investor->balance -= preg_replace("/[^0-9]/", "", $this->plan->min_deposit) / 100;
                    $this->investor->save();
                    $invertPlant = array(
                        'investor_id' => $this->investor->id,
                        'plan_id' => $this->plan->id,
                        'name_coin' => 'USDT',
                        'profit' => $this->query_plan_number_days->profit,
                        'number_days' => $this->query_plan_number_days->number_days,
                        'amount' => preg_replace("/[^0-9]/", "", $this->plan->min_deposit) / 100,
                        'total_amount' => $this->total_amount + preg_replace("/[^0-9]/", "", $this->plan->min_deposit) / 100,
                        'type_payment' => $this->type_payment,
                        'total_last_seconds' => 0,
                        'wallet_id' => $this->wallet->id,
                        'status' => 1,
                    );
                    $deposit = Investor_with_plants::create($invertPlant);
                    $this->sendMesageTelegram($invertPlant);
                    $deposit->save();
                } else {
                    $this->investor->balance -= $this->amount;
                    $this->investor->save();
                    $invertPlant = [
                        'investor_id' => $this->investor->id,
                        'plan_id' => $this->plan->id,
                        'name_coin' => 'USDT',
                        'profit' => $this->current_discount ?? $this->plan->discount,
                        'number_days' => $this->curent_date->diffInDays($this->plan->to_date),
                        'amount' => preg_replace("/[^0-9.]/", "", $this->amount),
                        'total_amount' => preg_replace("/[^0-9.]/", "", $this->total),
                        'type_payment' => $this->type_payment,
                        'total_last_seconds' => 0,
                        'wallet_id' => $this->wallet->id,
                        'status' => 1,
                    ];
                    $deposit = Investor_with_plants::create($invertPlant);
                    $this->sendMesageTelegram($invertPlant);
                    $deposit->save();
                }
                $this->dispatch('success', 'T');
                return $this->redirect('/list-deposit', navigate: true);
            }
        } else {
            if ($this->plan->package_type == 1) {
                $invertPlant = [
                    'investor_id' => $this->investor->id,
                    'plan_id' => $this->plan->id,
                    'name_coin' => 'USDT',
                    'profit' => $this->query_plan_number_days->profit,
                    'number_days' => $this->query_plan_number_days->number_days,
                    'amount' => preg_replace("/[^0-9]/", "", $this->plan->min_deposit) / 100,
                    'total_amount' => $this->total_amount + preg_replace("/[^0-9]/", "", $this->plan->min_deposit) / 100,
                    'type_payment' => $this->type_payment,
                    'wallet_id' => $this->wallet->id,
                    'total_last_seconds' => 0,
                    'status' => 0,
                ];
                $deposit = Investor_with_plants::create($invertPlant);
                $this->sendMesageTelegram($invertPlant);
                $this->wallet->status = 1;
                $this->wallet->save();
                $deposit->save();
            } else {
                $invertPlant = [
                    'investor_id' => $this->investor->id,
                    'plan_id' => $this->plan->id,
                    'name_coin' => 'USDT',
                    'profit' => $this->current_discount ?? $this->plan->discount,
                    'number_days' => $this->curent_date->diffInDays($this->plan->to_date),
                    'amount' => preg_replace("/[^0-9.]/", "", $this->amount),
                    'total_amount' => preg_replace("/[^0-9.]/", "", $this->total),
                    'type_payment' => $this->type_payment,
                    'wallet_id' => $this->wallet->id,
                    'total_last_seconds' => 0,
                    'status' => 0,
                ];
                $deposit = Investor_with_plants::create($invertPlant);
                $this->sendMesageTelegram($invertPlant);
                $this->wallet->status = 1;
                $this->wallet->save();
                $deposit->save();
            }
            $this->dispatch('success', 'T');
            return $this->redirect('/list-deposit', navigate: true);
        }
    }
    public function render()
    {
        if ($this->plan) {
            $this->query_plan_number_days = plan_number_days::find($this->number_days_id);
            $cleanedStr = preg_replace('/[^0-9.]/', '', $this->min_deposit);
            if ($cleanedStr <= $this->plan->min_deposit) {
                $this->amount = $this->plan->min_deposit;
            } elseif ($cleanedStr >= $this->plan->max_deposit) {
                $this->amount = $this->plan->max_deposit;
            } else {
                $this->amount = number_format($cleanedStr, 2, '.', ',');
            }
            $totalAmout = (preg_replace('/[^0-9]/', '', $this->amount) / 100) + (preg_replace('/[^0-9]/', '', $this->current_discount)  / 10000) * preg_replace('/[^0-9]/', '', $this->amount) / 100;
            if ($this->min_deposit > 0) {
                $filteredValue = preg_replace('/[^0-9.,]/', '', $this->min_deposit);
                if (!empty($filteredValue)) {
                    if (is_numeric($filteredValue)) {
                        $this->min_deposit = number_format($filteredValue, 2, '.', ',');
                    } else {
                        $this->min_deposit = $filteredValue;
                    }
                }
            }
            $this->total = number_format($totalAmout, 2, '.', ',');
            if ($this->query_plan_number_days) {
                $this->number_days = $this->query_plan_number_days->number_days;
                $this->total_amount = (preg_replace('/[^0-9]/', '',  $this->query_plan_number_days->profit)  / 10000) * preg_replace('/[^0-9]/', '', $this->plan->min_deposit) / 100;
            }
        }
        $calculator = new InterestCalculator();
        $this->interestCalculator = $calculator->calculator_interest($this->investor);
        return view('livewire.web.deposit.deposit-modal');
    }
}
