@php
$investor = session()->get('investor');
@endphp
<div class="header_bg">
    <div class="container">
        <div class="banner_bg">
            <header>
                @include('web.layouts.nav')
            </header>
            <div class="live_bg">
                <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script>
                <div class="live_bg">
            <script
              type="text/javascript"
              src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"
            ></script>
            <div
              id="coinmarketcap-widget-marquee"
              coins="1,1027,825,1839,2,74,131,512,1831,52,1958"
              currency="USD"
              theme="light"
              transparent="false"
              show-symbol-logo="true"
            ></div>
          </div>
            </div>
            <div class="banner">
                <div class="head">
                    <h2>Welcome to</h2>
                    <h3>Cryptown Investment</h3>
                    <h4>limited</h4>
                    <p>
                        The success of Cryptown Investment Limited is directly linked to
                        the success of each of our investors. That's why we are aiming
                        for the maximum profit for our partners.Take the opportunity
                        with us! Get rich with us!
                    </p>
                </div>
                <div class="text_but">
                    <a href="{{ $investor ? url('account') : url('register') }}" class="but hvr-float-shadow"
                        wire:navigate>
                        {{ $investor ? 'Get Invest' : 'Get Started' }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- <video autoplay="" loop="" muted="" playsinline="">
        <source src="images/ban_vedio.mp4" type="video/mp4" />
        <source src="images/ban_vedio.ogg" type="video/ogg" />
    </video> -->
</div>
