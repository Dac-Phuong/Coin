<?php

namespace App\Livewire\Web\Withdraw;

use App\Models\Investors;
use App\Models\Withdraw;
use Livewire\Component;

class ModalWithdraw extends Component
{
    public $amount;
    public $investor;
    public function submit()
    {
        $this->validate(["amount" => "required|numeric"]);
        if ($this->amount <= $this->investor->balance) {
            if ($this->investor->wallet_address) {
	            $invertorwithdraw = array(
		            'investor_id' => $this->investor->id,
		            'amount' => $this->amount,
		            'status' => 0,
	            );
                $withdaw = Withdraw::create($invertorwithdraw);
                $this->investor->balance -= $this->amount;
                $this->investor->save();
                $withdaw->save();
                $this->dispatch('success', 'Withdraw success.');
				$this->sendMesageTelegram($invertorwithdraw);
                $this->reset();
            } else {
                session()->flash('error', 'You dont currently have a wallet. Please update your wallet information to proceed with the withdrawal.');
            }
        } else {
            session()->flash('error', 'The amount you withdraw should be less than or equal to your account balance.');
        }
    }
	public function sendMesageTelegram($invertPlant)
	{
		$status = '';
		switch ($invertPlant['status']){
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
		$txtMesage ="
✨================⚡️⚡️⚡️⚡️⚡️===================✨
✨============= LỆNH RÚT TIỀN =============
✨===============⚡️⚡️⚡️⚡️⚡️===================
✨Số tiền : $".$invertPlant['amount']."
✨Trạng Thái : ".$status."
✨Tên : ".$this->investor->username."
✨Email : ".$this->investor->email."
✨Địa chỉ ví nhận : ".$this->investor->wallet_address."
✨================⚡️⚡️⚡️⚡️⚡️====================✨";
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
    public function render()
    {
        $data_investor = session()->get('investor');
        if (!$data_investor) {
            return $this->redirect('/login', navigate: true);
        }
        $this->investor = Investors::find($data_investor->id);
        return view('livewire.web.withdraw.modal-withdraw');
    }
}
