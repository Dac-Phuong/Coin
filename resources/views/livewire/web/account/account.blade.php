<div class="wrapper" wire:poll.15s>
    @include('web.layouts.navbar')
    <section class="home-section">
        <div class="headerall_top">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ url('/') }}" wire:navigate>
                        <h2 class="pl-2 pt-3 items-center" style="font-size: 26px;text-transform: uppercase;font-weight: 700">
                            Stakingcoins</h2>
                    </a>
                </div>
                <div class="col-lg-5">
                    <div class="home-content head">
                        <i class="ri-menu-line"></i>
                        <h1 class="head">account as </h1> <br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="home-content1">
                        <li>
                            <h3> <i class="ri-map-pin-user-line"></i> user:<span> {{ $investor->fullname }}</span></h3>
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
                    <div class="text_but d-flex justify-content-end ">
                        <a href="{{ url('/deposit') }}" wire:navigate class="but2"> Deposit </a>
                        <a href="{{ url('/withdraw') }}" wire:navigate class="but"> Withdraw</a>
                        <div wire:click="logout" class="but2 cursor-pointer" style="cursor: pointer"> logout</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin1_bg">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <h1 class="head3"> 01.User Details</h1>
                        <div class="user_acc">
                            <img src="images/user_img1.png" class="user_img1">
                            <h3> <i class="ri-star-fill"></i> Welcome</h3>
                            <h4><i class="ri-star-fill"></i> {{ $investor->fullname }}</h4>
                            <h5><i class="ri-star-fill"></i> Registration Date <span>
                                    {{ $investor->created_at }}</span></h5>
                            <h5><i class="ri-star-fill"></i> Last acces date <span> {{ $investor->updated_at }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h1 class="head3"> 02.Payment Details</h1>
                        <div class="payment_detail">
                            <marquee width="100%" direction="right" height="180px" onmouseout="this.start()"
                                onmouseover="this.stop()">
                                <p> <img src="images/18.png" class="payment"> PerfectMoney <span> $0.00 </span> </p>
                                <p> <img src="images/51.png" class="payment"> ePayCore <span> $0.00 </span> </p>
                                <p> <img src="images/48.png" class="payment"> Bitcoin <span> $0.00 </span> </p>
                                <p> <img src="images/68.png" class="payment"> Litecoin <span> $0.00 </span> </p>
                                <p> <img src="images/69.png" class="payment"> Ethereum <span> $0.00 </span> </p>
                                <p> <img src="images/71.png" class="payment"> Dash <span> $0.00 </span> </p>
                                <p> <img src="images/72.png" class="payment"> Ripple <span> $0.00 </span> </p>
                                <p> <img src="images/79.png" class="payment"> Dogecoin <span> $0.00 </span> </p>
                                <p> <img src="images/82.png" class="payment"> Tether ERC20 <span> $0.00 </span> </p>
                                <p> <img src="images/85.png" class="payment"> Tron <span> $0.00 </span> </p>
                                <p> <img src="images/92.png" class="payment"> Tether TRC20 <span> $0.00 </span> </p>
                                <p> <img src="images/94.png" class="payment"> BNB <span> $0.00 </span> </p>
                                <p> <img src="images/102.png" class="payment"> Tether BEP20 <span> $0.00 </span> </p>
                                <p> <img src="images/77.png" class="payment"> Bitcoin Cash <span> $0.00 </span> </p>
                            </marquee>
                        </div>
                    </div>
                </div>
                <h1 class="head3"> 03.Menu Details</h1>
                <ul class="but_detail">
                    <li>
                        <div class="text_but">
                            <a href="{{ url('deposit') }}" wire:navigate class="but2"> Deposit </a>
                        </div>
                    </li>
                    <li>
                        <div class="text_but">
                            <a href="{{ url('withdraw') }}" wire:navigate class="but"> Withdraw </a>
                        </div>
                    </li>

                    <li>
                        <div class="text_but">
                            <div wire:click="logout" class="but" style="cursor: pointer"> logout </div>
                        </div>
                    </li>
                </ul>
                <h1 class="head3"> 04.Account Details</h1>
                <ul class="user_detail">
                    <li>
                        <div class="form_block">
                            <img src="images/acc_img4.png" class="acc_img4 img-fluid">
                            <h3> Account Balance </h3>
                            <h4> ${{ number_format($investor->balance, 4, '.', ',') }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="form_block">
                            <img src="images/acc_img5.png" class="acc_img4 img-fluid">
                            <h3> Total Deposit </h3>
                            <h4> ${{ number_format($total_deposit, 2, '.', ',') }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="form_block">
                            <img src="images/acc_img6.png" class="acc_img4 img-fluid">
                            <h3> Withdraw Total </h3>
                            <h4> ${{ number_format($total_withdraw, 2, '.', ',') }}</h4>
                        </div>
                    </li>
                    <li>
                        <div class="form_block">
                            <img src="images/acc_img7.png" class="acc_img4 img-fluid">
                            <h3> Earned Total </h3>
                            <h4> ${{ number_format($investor->earned_toatl, 4, '.', ',') }}</h4>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <h1 class="head3"> 05.Deposit Details</h1>
                        <ul class="form_detail">
                            <li>
                                <h3>
                                    Active Deposit <span> ${{ $active_deposit ?? 0 }}</span>
                                </h3>
                            </li>
                            <li>
                                <h3>
                                    Last Depoait <span>${{ $last_deposit ?? 0 }} </span>
                                </h3>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <h1 class="head3"> 06.Withdraw Details</h1>
                        <ul class="form_detail">
                            <li>
                                <h3>
                                    Pending Withdraw <span> ${{ $pending_withdraw ?? 0 }}</span>
                                </h3>
                            </li>
                            <li>
                                <h3>
                                    Last Withdraw <span>${{ $last_withdraw ?? 0 }} </span>
                                </h3>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="col-lg-6 col-md-12">
                        <h1 class="head3"> 07.Security Details</h1>
                        <h4 class="security_detail"> Security Note: please, activate <a href="?a=security">Two Factor
                                Authentication</a> to keep your account safe</h4>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
</div>
