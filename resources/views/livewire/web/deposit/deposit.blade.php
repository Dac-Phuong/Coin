<div class="wrapper">
    @include('web.layouts.navbar')
    <section class="home-section mb-8">
        <div class="headerall_top" wire:poll.10s>
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ url('/') }}" wire:navigate> <h2 class="pl-2 pt-3 items-center" style="font-size: 26px;text-transform: uppercase;font-weight: 700">
                            Stakingcoins</h2></a>
                </div>
                <div class="col-lg-5">
                    <div class="home-content">
                        <i class="ri-menu-line"></i>
                        <h1 class="head">deposit </h1> <br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="home-content1">
                        <li>
                            <h3> <i class="ri-map-pin-user-line"></i> user :<span> {{ $investor->fullname }}</span></h3>
                            <h3> <i class="ri-mail-open-line"></i> Email: <span> {{ $investor->email }}</span> </h3>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="refer_copy">
                        <img src="images/acc_img3.png" class="img-fluid acc_img2">
                        <h3>
                            Referal link
                            <input type="text" wire:model.refer="ref" readonly id="myInput"
                                onclick="this.select();">
                            <button onclick="copyToClipboard()"><i class="ri-link-unlink-m"></i></button>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="text_but">
                        <a href="{{ url('/deposit') }}" wire:navigate class="but2"> Deposit </a>
                        <a href="{{ url('/withdraw') }}" wire:navigate class="but"> Withdraw</a>
                        <a href="{{ url('/logout') }}" wire:navigate class="but2"> logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin1_bg">
            <div class="container-fluid">
                <div class="depo_bg">
                    <h1 class="head3"> 01.Balance Details</h1>
                    <div class="form_block1">
                        <img src="images/acc_img4.png" class="acc_img4 img-fluid">
                        <h3> Account Balance</h3>
                        <h4>$<b>{{ number_format($investor->balance, 4, '.', ',') }} </b></h4>
                    </div>
                    <h1 class="head3"> 02.Plan Fixed</h1>
                    <div style="max-width: 1600px ; margin: auto; margin-bottom:30px">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-5">
                            @if (isset($plan_fixeds))
                                @foreach ($plan_fixeds as $key => $plan_fixed)
                                    <div class="col relative">
                                        <div class="nina-col-hosting" data-id="{{ $plan_fixed->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update">
                                                <div class="nina-item-hosting">
                                                    <div class="nina-header-hosting alex-nina-header-hosting{{$key}}">
                                                        <div class="nina-title-hosting"><h2>{{ $plan_fixed->name }}</h2></div>
                                                        <div class="nina-desc-hosting"></div>
                                                        <div class="nina-price-hosting alex-nina-price-hosting{{$key}}">
                                                            <div>
                                                                <div class="nina-text-price1">Package</div>
                                                                <div class="nina-text-price2"> ${{ number_format($plan_fixed->min_deposit,0) }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nina-body-hosting nina-host-pho-thong{{$key}}">
                                                        <ul>
                                                            <li>
                                                                <div class="nina-info-hosting">Every day received</div>
                                                                <div class="nina-info-parameter">
                                                                    ${{ isset($plan_fixed->deposit_days) ? number_format($plan_fixed->deposit_days, 2) : 0 }}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="nina-info-hosting">Every month received</div>
                                                                <div class="nina-info-parameter">
                                                                    ${{ isset($plan_fixed->deposit_week) ? number_format($plan_fixed->deposit_week, 2) : 0 }}
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="nina-info-hosting">Total received after the end of the plan</div>
                                                                <div class="nina-info-parameter">
                                                                    ${{ isset($plan_fixed->deposit_year) ? number_format($plan_fixed->deposit_year, 2) : 0 }}
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="btn-support cl-1">
                                                            <a href="#" data-id="{{ $plan_fixed->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update" class="btn-views">
                                                                <span>Join</span> <span>Now</span><span>
                                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <livewire:web.deposit.deposit-modal />
                        </div>
                    </div>
                    <h1 class="head3"> 03.Plan Daily</h1>
                    <div style="max-width: 1600px ; margin: auto">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 row-cols-xl-5">
                            @if (isset($plan_daily))
                                @foreach ($plan_daily as $key => $plan)
                                    <div class="col relative">



                                        <div class="nina-col-hosting" data-id="{{ $plan->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update">
                                            <div class="nina-item-hosting">
                                                <div class="nina-header-hosting alex-nina-header-hosting{{$key}}">
                                                    <div class="nina-title-hosting"><h2>{{ $plan->name }}</h2></div>
                                                    <div class="nina-desc-hosting"> {{ $plan->title }}</div>
                                                    <div class="nina-price-hosting alex-nina-price-hosting{{$key}}">
                                                        <div>
                                                            <div class="nina-text-price2">{{ $plan->discount }} %</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nina-body-hosting nina-host-pho-thong{{$key}}">

                                                    <ul>
                                                        <li>
                                                            <div class="nina-info-hosting">Profit Percent</div>
                                                            <div class="nina-info-parameter">
                                                                {{ $plan->discount }}%
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="nina-info-hosting">Min Deposit</div>
                                                            <div class="nina-info-parameter">
                                                                ${{ $plan->min_deposit }}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="nina-info-hosting">Max Deposit</div>
                                                            <div class="nina-info-parameter">
                                                                ${{ $plan->max_deposit }}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="nina-info-hosting">Start day</div>
                                                            <div class="nina-info-parameter">
                                                                {{ \Carbon\Carbon::parse($plan->from_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="nina-info-hosting">Closing date</div>
                                                            <div class="nina-info-parameter">
                                                                {{ \Carbon\Carbon::parse($plan->end_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="nina-info-hosting">End date</div>
                                                            <div class="nina-info-parameter">
                                                                {{ \Carbon\Carbon::parse($plan->to_date)->setTimezone('Asia/Ho_Chi_Minh')->toDateString() }}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="btn-support cl-1">
                                                        <a href="#" data-id="{{ $plan->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update" class="btn-views">
                                                            <span>Join</span> <span>Now</span><span>
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255,255,255);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
