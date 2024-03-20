<div class="main_wrapper">
    <div class="plan_bg">
        <div class="container">
            <div class="plan">
                <div class="head">
                    <h3>INVESTMENT PLAN</h3>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
                    @if (isset($plan_fixeds))
                        @foreach ($plan_fixeds as $key => $plan_fixed)
                            <div class="col">
                                <div class="nina-col-hosting">
                                    <a href="{{ $investor ? url('account') : url('register') }}" wire:navigate>
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
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
                    @if (isset($plan_daily))
                        @foreach ($plan_daily as $key => $plan)
                            <div class="col">
                                <div class="nina-col-hosting">
                                    <a href="{{ $investor ? url('account') : url('register') }}" wire:navigate>
                                        <div class="nina-item-hosting">
                                            <div class="nina-header-hosting alex-nina-header-hosting{{$key}}">
                                                <div class="nina-title-hosting"><h2>{{ $plan->name }}</h2></div>
                                                <div class="nina-desc-hosting">{{ $plan->title }}</div>
                                                <div class="nina-price-hosting alex-nina-price-hosting{{$key}}">
                                                    <div>
                                                        <div class="nina-text-price2">{{ $plan->discount }} %</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nina-body-hosting nina-host-pho-thong{{$key}}">
                                                <ul>
                                                    <li>
                                                        <div class="nina-info-hosting">Min Deposit </div>
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
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="about_plan">
        <div class="container">
            <div class="calci_bg">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="calci">
                            <div class="head"></div>
                            <div class="modal fade calci_popup" id="calciModal" tabindex="-1"
                                 aria-labelledby="calciModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Select plan
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="calci_detail">
                                                <li>
                                                    <h3>Select plan</h3>
                                                    <select class="" id="Ultra">
                                                        <option value="1" class="opts">Plan1</option>
                                                        <option value="2" class="opts">Plan2</option>
                                                        <option value="3" class="opts">Plan3</option>
                                                        <option value="4" class="opts">Plan4</option>
                                                    </select>
                                                </li>
                                                <li>
                                                    <h3>Enter Amount</h3>
                                                    <input type="text" class="inpts" id="money" placeholder=""
                                                           value="" />
                                                </li>
                                                <li>
                                                    <h3>Daily Profit</h3>
                                                    <h4 id="profitDaily">0.90</h4>
                                                </li>
                                                <li>
                                                    <h3>Total Profit</h3>
                                                    <h4 id="profitTotal">11.70</h4>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="calci_img">
                                <img src="images/calci_img3.png" class="img1 img-fluid" alt="calci_img1" />
                                <img src="images/calci_img4.png" class="img2 img-fluid" alt="calci_img1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="head aos-init" data-aos="fade-left" data-aos-duration="2200">
                            <h2>Facts &amp; Projects</h2>
                            <h3>Our Achivements</h3>
                            <p>
                                Cryptown Investment Limited is the ultimate platform for all
                                Cryptocurrency enthusiasts! Our innovative platform offers a
                                range of features With Novamining, you can earn money and
                                enjoy financial freedom in the exciting world of
                                cryptocurrency. Join us now and experience the future of the
                                crypto world!
                            </p>
                        </div>
                        <div class="text_but ">
                            <a href="{{ $investor ? url('account') : url('register') }}" wire:navigate
                               class="but hvr-float-shadow">
                                {{ $investor ? 'deposit now' : 'invest now' }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="campaign">
        <div class="container">
            <div class="section-title head">
                <h2>stakingcoins.net</h2>
                <h3>Development roadmap</h3>
            </div>
            <div class="owl-carousel">
                <div><img src="{{ URL::to('/') }}/images/invet.jpeg" alt=""></div>
                <div><img src="{{ URL::to('/') }}/images/inverter.jpeg" alt=""></div>
                <div><img src="{{ URL::to('/') }}/images/invet2.jpeg" alt=""></div>
                <div><img src="{{ URL::to('/') }}/images/invert3.jpeg" alt=""></div>
            </div>
        </div>
    </div>
    <div class="refer_plan">
        <div class="container">
            <div class="refer_bg">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="refer">
                            <div class="head aos-init" data-aos="fade-right" data-aos-duration="2500">
                                <h2>AFFILIATE PROGRAM</h2>
                                <h3>Referral Commision</h3>
                                <p>
                                    <span> Cryptown</span> Forming partnerships is critical to
                                    the success of any business. This also applies to large
                                    investment projects. Developing partnerships is key to
                                    ensuring success for all. Keeping in mind the importance of
                                    partnerships, we have designed a very profitable affiliate
                                    program.
                                </p>
                                <p>
                                    Share your referral link and invite your friends and family
                                    to sign up on the Cryptown platform and earn passive income
                                    with our affiliate program up to 3 levels. You don't need to
                                    be actively investing to earn affiliate income.
                                </p>
                            </div>
                            <div class="text_but">
                                <a href="{{ $investor ? url('account') : url('register') }}" wire:navigate
                                   class="but hvr-float-shadow"> {{ $investor ? 'invest now' : 'Join now' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="refer_level">
                            <img src="images/refer_img.png" class="img1" alt="refer_img" />
                            <ul class="level_detail">
                                <li>
                                    <h3>5%</h3>
                                    <h4>Level1</h4>
                                </li>
                                <li>
                                    <h3>2%</h3>
                                    <h4>Level2</h4>
                                </li>
                                <li>
                                    <h3>1%</h3>
                                    <h4>Level3</h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
