@php
    $investor = session()->get('investor');
@endphp
<div class="footer_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="footer_text">
                    <a href="{{ url('/') }}" wire:navigate class="footer-logo">
                        <img src="images/staking_logo.png" alt="logo" class="logo" width="60" height="60" />
                        <h2 class="pl-2" style="font-size: 26px;text-transform: uppercase;font-weight: 700">Stakingcoins</h2>
                    </a>
                    <p>
                        <span> Cryptown Investment Limited</span> main business includes
                        high-frequency automated trading of crypto currencies, research
                        and development of blockchain applications; we are in the
                        leading position in the industry, and Safe reliable crypto
                        currency investment strategies for investors.
                    </p>
                    <div class="text_but">
                        <a class="but1 hvr-float-shadow" href="{{ $investor ? url('logout') : url('login') }}"
                            wire:navigate>
                            {{ $investor ? 'logout' : 'login' }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h5>
                            <a href="{{ url('/') }}" wire:navigate ><img
                                    src="images/footer_img1.png" alt="footer_img1" class="footer_img" />
                                support@cryptown.biz</a>
                        </h5>
                        <div class="footer_link">
                            <a href="{{ url('/') }}" wire:navigate class="link hvr-underline-from-center">
                                Home</a>
                            <a href="{{ url('/aboutus') }}" wire:navigate class="link hvr-underline-from-center">
                                About us</a>
                            <a href="{{ url('/faq') }}" wire:navigate class="link hvr-underline-from-center">
                                Faq</a>
                            <a href="{{ url('/rules') }}" wire:navigate class="link hvr-underline-from-center">
                                Rules</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h5>
                            <a  href="{{ url('/') }}" wire:navigate><img src="images/footer_img2.png" alt="footer_img2"
                                    class="footer_img" />
                                14 Wharf Road, London, England, N1 7RW</a>
                        </h5>
                        <div class="footer_link">
                            <a class="link hvr-underline-from-center"
                                href="{{ $investor ? url('logout') : url('login') }}" wire:navigate
                                wire:click.prevent="render">
                                {{ $investor ? 'logout' : 'login' }}
                            </a>
                            <a href="{{ $investor ? url('account') : url('register') }}" wire:navigate class="link hvr-underline-from-center">
                                {{ $investor ? 'Account' : 'signup' }} </a>
                            <a href="{{ url('/faq') }}" wire:navigate class="link hvr-underline-from-center">
                                Paidouts</a>
                            <a href="{{ url('/support') }}" wire:navigate class="link hvr-underline-from-center">
                                Support</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <h6>
                    Copyright <span>CRYPTOWN INVESTMENT LIMITED </span> 2024, All
                    Rights Reserved.
                </h6>
            </div>
        </div>
    </div>
</div>
