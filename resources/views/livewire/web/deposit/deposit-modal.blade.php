<div class="modal fade" id="kt_modal_update" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-scrollable mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <div class="card-header d-flex align-items-center">
                    <h4 class="mb-0 text-white">Enter Amount
                    </h4>
                    <div class="check_box check_box2" style="margin-left: 10px;">
                        <label class="radio_btn">
                            <input type="radio" name="type" value="process_18" data-fiat="USD" checked=""
                                style="display:none">
                            <span class="checkmark1">
                                <p class="text-white font-weight-bold"><img src="images/18.png" class="pay">
                                    USDT</p>
                            </span>
                        </label>
                    </div>
                </div>
                <!--end::Modal title-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </div>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <div class="nav nav-pills check_tab" id="pills-tab" role="tablist">
                    <button class="nav-link active" id="pills-touch-tab" type="button" wire:click="switchTab('tab1')">
                        Spend Processor</button>
                    <button class="nav-link" id="pills-touch1-tab" type="button" wire:click="switchTab('tab2')"> Spend
                        Account
                        Balance</button>

                </div>
                <form action="#" wire:submit.prevent="submit">
                    <div class="tab-content wd_box" id="pills-tabContent">
                        @if ($currentTab === 'tab1')
                            <div class="tab-pane fade active show" id="pills-touch" role="tabpanel"
                                aria-labelledby="pills-touch-tab">
                                <div class="checkmark_bg">
                                    <div class="tab-content wd_box" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-touch" role="tabpanel"
                                            aria-labelledby="pills-touch-tab">
                                            <div class="table-responsive ">
                                                <table cellspacing="0" cellpadding="2"
                                                    class="form deposit_confirm relative">
                                                    <tbody>
                                                        <tr>
                                                            <th>Plan:</th>
                                                            @if (isset($plan) && $plan->package_type == 1)
                                                                <td>{{ $plan->name ?? 0 }}</td>
                                                            @else
                                                                <td>{{ $plan->title ?? 0 }}</td>
                                                            @endif
                                                            @if ($this->generateQrCode())
                                                                <td rowspan="6"
                                                                    style="width: 150px !important; position: relative;">
                                                                    {!! $this->generateQrCode() !!}
                                                                    <span
                                                                        style="position: absolute;  right: 60px; {{ isset($plan) && $plan->package_type == 1 ? 'bottom: 0' : 'bottom: 35px ;' }}">BSC</span>
                                                                </td>
                                                            @endif
                                                            @if ($this->generateQrCode1())
                                                                <td rowspan="6"
                                                                    style="width: 150px !important;position: relative;">
                                                                    {!! $this->generateQrCode1() !!}
                                                                    <span
                                                                        style="position: absolute; bottom: 35px; right: 60px; {{ isset($plan) && $plan->package_type == 1 ? 'bottom: 0' : 'bottom: 35px ;' }}">TRON</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            @if (isset($plan->package_type) && $plan->package_type == 0)
                                                                <th>Profit:</th>
                                                                <td
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    {{ $current_discount ?? $plan->discount }}%
                                                                    <div class="plan-daily-model "><svg
                                                                            style="width: 20px;height: 20px; margin-left: 10px;"
                                                                            fill="#fff"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512">
                                                                            <path
                                                                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z" />
                                                                        </svg></div>
                                                                    <div class="daily-profit" style="margin-left: 20px">
                                                                        <table style="min-width: 300px;max-width: 300px"
                                                                            class="form deposit_confirm p-0 m-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Profit (%)</th>
                                                                                    <th>Start date</th>
                                                                                    <th>End date</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @if (count($daily_discounts) > 0)
                                                                                    @foreach ($daily_discounts as $value)
                                                                                        <tr>
                                                                                            <td
                                                                                                style="max-width: 50px !important;">
                                                                                                {{ $value['discount'] }}%
                                                                                            </td>
                                                                                            <td>{{ \Carbon\Carbon::parse($value['start_date'])->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                                                            </td>
                                                                                            <td>{{ \Carbon\Carbon::parse($value['end_date'])->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <th>Deposit:</th>
                                                                <td>${{ $plan->min_deposit ?? 0 }}</td>
                                                            @endif
                                                        </tr>
                                                        @if (isset($plan->package_type) && $plan->package_type == 0)
                                                            <tr>
                                                                <th>Start date:</th>
                                                                <td>{{ \Carbon\Carbon::parse($plan->from_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Closing date:</th>
                                                                <td>{{ \Carbon\Carbon::parse($plan->end_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>End date:</th>
                                                                <td>{{ \Carbon\Carbon::parse($plan->to_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Min deposit:</th>
                                                                <td>${{ $plan->min_deposit ?? 0 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Max deposit:</th>
                                                                <td>${{ $plan->max_deposit ?? 0 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Debit Amount:</th>
                                                                <td>${{ $amount }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Amount Received:</th>
                                                                <td>${{ $total }}</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <th>Number of days sent:</th>
                                                                <td>{{ $number_days ?? 1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Amount received:</th>
                                                                <td>${{ number_format($total_amount, 2) }}</td>
                                                            </tr>
                                                        @endif

                                                    </tbody>
                                                </table>
                                                @if ($isOpen)
                                                    @if (!isset($wallet))
                                                        <div class="payment_status ">The current wallet is
                                                            used up please wait a few minutes</div>
                                                    @else
                                                        <div class="coin_form btc_form btc6" id="btc_form">Please send
                                                            <b class="text-bg-warning">{{ $amount }}
                                                                USDT</b> to
                                                            <i> <a
                                                                    class="text-bg-warning text-warning">{{ $wallet->wallet_address_bsc ?? '' }}</a></i>
                                                            {{ $wallet->wallet_address_bsc && $wallet->wallet_address_tron ? 'or' : '' }}
                                                            <i><a
                                                                    class="text-bg-warning text-warning">{{ $wallet->wallet_address_tron ?? '' }}</a></i><br>
                                                        </div>
                                                        <div id="placeforstatus">
                                                            <div class="payment_status"><b>Order status:</b> <span
                                                                    class="status_text">Waiting for payment</span></div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($currentTab === 'tab2')
                            <div class="">
                                <div class="table-responsive text-center">
                                    <table cellspacing="0" cellpadding="2" class="form ">
                                        <tbody>
                                            <tr>
                                                <th>Plan:</th>
                                                @if (isset($plan) && $plan->package_type == 1)
                                                    <td>{{ $plan->name ?? 0 }}</td>
                                                @else
                                                    <td>{{ $plan->title ?? 0 }}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                @if (isset($plan->package_type) && $plan->package_type == 0)
                                                    <th>Profit:</th>
                                                    <td>{{ $plan->title ?? 0 }}</td>
                                                @else
                                                    <th>Deposit:</th>
                                                    <td>${{ $plan->min_deposit ?? 0 }}</td>
                                                @endif
                                            </tr>
                                            @if (isset($plan->package_type) && $plan->package_type == 0)
                                                <tr>
                                                    <th>Start day:</th>
                                                    <td>{{ \Carbon\Carbon::parse($plan->from_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Closing date:</th>
                                                    <td>{{ \Carbon\Carbon::parse($plan->end_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>End date:</th>
                                                    <td>{{ \Carbon\Carbon::parse($plan->to_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Min deposit:</th>
                                                    <td>${{ $plan->min_deposit ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Max deposit:</th>
                                                    <td>${{ $plan->max_deposit ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Amount Received:</th>
                                                    <td>${{ $total }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <th>Number of days sent:</th>
                                                    <td>{{ $number_days ?? 1 }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Amount received:</th>
                                                    <td>${{ number_format($total_amount, 2) }}</td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                    @if (session('error'))
                                        <div class="error">{{ session('error') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if ($isOpen && isset($plan) && $plan->package_type == 0)
                            @if ((isset($wallet) && $wallet->wallet_address_bsc) || (isset($wallet) && $wallet->wallet_address_tron))
                                <div class="form1">
                                    <div class="form_box">
                                        <h3> Amount to Spend ($) </h3>
                                        <h4>
                                            <i class="ri-money-dollar-circle-line"></i>
                                            <input type="text" required name="amount"
                                                wire:model.live.debounce.850ms="min_deposit" size="15"
                                                class="inpts" id="inv_amount">
                                        </h4>
                                    </div>
                                    <div class="form_but">
                                        <button type="submit" class="sbmt">Spend</button>
                                    </div>
                                </div>
                            @endif
                        @elseif(isset($plan) && $plan->package_type == 1)
                            @if ($wallet->wallet_address_bsc || $wallet->wallet_address_tron)
                                <div class="form1">
                                    <div class="form_box">
                                        <h3> Choose the number of investment days</h3>
                                        <h4>
                                            <i class="ri-money-dollar-circle-line"></i>
                                            <select type="text" name="amount" wire:model.live="number_days_id"
                                                class="inpts" id="inv_amount">
                                                @foreach ($plan_number_days as $number_days)
                                                    <option value="{{ $number_days->id }}">
                                                        {{ $number_days->number_days }}</option>
                                                @endforeach
                                            </select>
                                        </h4>
                                    </div>
                                    <div class="form_but">
                                        <button type="submit" class="sbmt">Spend</button>
                                    </div>

                                </div>
                            @endif
                        @else
                            <div class="text-center text-white">This plan has ended.</div>
                        @endif

                    </div>
                </form>

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
