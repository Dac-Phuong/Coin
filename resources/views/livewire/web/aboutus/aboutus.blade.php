<div>
    <div class="header_bg header1_bg">
        <div class="container">
            <div class="banner_bg">
                <header>
                    @include('web.layouts.nav')
                </header>
            </div>
        </div>
        <div class="content_bg banner">
            <div class="container">
                <div class="content_text head ml9">
                    <h3>About Us</h3>
                </div>
                <div class="content_subtext"></div>
            </div>
        </div>
    </div>
    <div class="about_bg mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about_vedio">
                        <a href="https://youtu.be/fn6eLH4VHAI" alt="certificate" data-fancybox="gallary">
                            <img src="images/vedio_but.png" class="vedio_but" alt="vedio_but" />
                        </a>
                        <img src="images/about_img.png" class="about_img" alt="about_img" />
                    </div>
                    <div class="about_text">
                        <img src="images/about_img1.png" class="img1" alt="about_img1" />
                        <h5>DDOS PROTECTION</h5>
                        <p>
                            Our state-of-the-art software provides advanced DDoS protection.
                        </p>
                    </div>
                    <div class="about_text">
                        <img src="images/about_img1.png" class="img1" alt="about_img1" />
                        <h5>SSL SECURITY</h5>
                        <p>
                            A green EV-SSL icon in the browser window indicates that your
                            information is secure.
                        </p>
                    </div>
                    <div class="text_but">
                        <a href="{{ $investor ? url('/account') : url('/register') }}" wire:navigate class="but2"> Join now</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="head">
                        <h2>About Company</h2>
                        <h3><span> Cryptown</span> investment <span> Limited</span></h3>
                        <p>
                            <span> Cryptown Investment Limited</span> is an international
                            financial company headquartered in the United Kingdom (Company
                            Mumber:14800184). We provide intelligent and quantitative
                            trading tools on major decentralized exchanges, as well as
                            cryptocurrency storage, cold wallet services, and cryptocurrency
                            ATM services.Our team members are leaders in various fields and
                            serve to ensure the safety and efficient use of your funds. Just
                            one step to register on our official platform, You will have the
                            opportunity to obtain stable and safe passive income and grow
                            your wealth in the long term.
                        </p>
                    </div>
                    <div class="cert_detail">
                        <a href="images/certificate.jpg" alt="certificate" data-fancybox="gallary">
                            <img src="images/certificate.png" alt="certificate" class="img2" />
                        </a>
                        <h2>
                            company detail
                            <a href="https://find-and-update.company-information.service.gov.uk/company/14800184"
                                target="_blank" class="hvr-float-shadow">
                                #14800184
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/googleTranslate.js') }}"></script>
    <script>
        function loadGoogleTranslate() {
            new google.translate.TranslateElement("google_element");
        }
        document.addEventListener("livewire:navigated", function() {
            loadGoogleTranslate()
        });
    </script>
@endpush
