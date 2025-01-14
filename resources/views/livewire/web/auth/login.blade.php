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
                <div class="head content_text ml9">
                    <h3>Login Form</h3>
                </div>
                <div class="content_subtext"></div>
            </div>
        </div>
    </div>
    <div class="admin_bg login_bg">
        <div class="container">
            <div class="head2">
                <h2>login <span> Details</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="head_img">
                        <img src="images/content_img4.png" class="img1" alt="content_img3" />
                    </div>
                    <div class="rem_text text-center">
                        <h3>You have create an account? or Recover ?</h3>
                        <div class="text_but text-center">
                            <a href="{{ url('register') }}" wire:navigate class="but"> Signup</a>
                            <a href="?a=forgot_password" class="but"> Recover</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    @if (session('error'))
                        <div class="error">{{ session('error') }}</div>
                    @endif
                    <div class="form1">
                        <div class="form_text">
                            <a href="?home">
                                <img src="images/form_img1.png" class="form_img" /></a>
                            <h2>login <span> form</span></h2>
                        </div>
                        <form wire:submit.prevent="submit" action="#">
                            <div class="form_box">
                                <h3>Username</h3>
                                <h4> <input type="text" required wire:model.defer="username" class="inpts"
                                        size="30" autofocus="autofocus" data-gtm-form-interact-field-id="0" />
                                    <i class="ri-shield-user-line"></i>
                                </h4>
                            </div>
                            <div class="form_box">
                                <h3>Password</h3>
                                <h4>
                                    <input type="password" required name="password" wire:model.defer="password"
                                        class="inpts" size="30" data-gtm-form-interact-field-id="1" />
                                    <i class="ri-file-lock-line"></i>
                                </h4>
                            </div>
                            <div class="form_but">
                                <input type="submit" class="sbmt" />
                            </div>
                        </form>
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
