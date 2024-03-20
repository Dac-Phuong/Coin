<div>
    <div class="header_bg header1_bg">
        <div class="container">
            <div class="banner_bg">
                <header>
                    @include('web.layouts.nav')
                </header>
            </div>
        </div>
        <div class="scroller">
            <a href="#" id="scroll" style="display: none">
                <img src="images/up.png" class="top_but" />
            </a>
        </div>
        <div class="content_bg banner">
            <div class="container">
                <div class="content_text ml9 head">
                    <h3>Signup form</h3>
                </div>
                <div class="content_subtext"></div>
            </div>
        </div>
    </div>
    <div class="admin_bg login_bg signup_bg">
        <div class="container">
            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif
            <div class="head2">
                <h2>Signup <span> Details</span></h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="head_img">
                        <img src="images/content_img4.png" class="img1" alt="content_img3" />
                    </div>
                    <div class="rem_text text-center">
                        <h3>You have already create an account? or Recover ?</h3>
                        <div class="text_but text-center">
                            <a href="{{ url('login') }}" wire:navigate class="but"> login</a>
                            <a href="" wire:navigate class="but"> Recover</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <form wire:submit.prevent="submit" name="regform">
                        <div class="form1">
                            <div class="form_text">
                                <a href="?home">
                                    <img src="images/form_img1.png" class="form_img" /></a>
                                <h2>Signup <span> form</span></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Full Name</h3>
                                        <h4>
                                            <input type="text" wire:model.defer="fullname" name="fullname"
                                                value="" class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Your Username</h3>
                                        <h4>
                                            <input type="text" wire:model.defer="username" name="username"
                                                class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Define Password</h3>
                                        <h4>
                                            <input type="password" wire:model.defer="password" name="password"
                                                class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Retype Password</h3>
                                        <h4>
                                            <input type="password" wire:model.defer="confirm_password" class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>E-mail Address</h3>
                                        <h4>
                                            <input type="text" wire:model.defer="email" name="email" class="inpts"
                                                size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Retype Your E-mail</h3>
                                        <h4> <input type="text" wire:model.defer="confirm_email" class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Secret question</h3>
                                        <h4>
                                            <input type="text" wire:model.defer="question" class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form_box">
                                        <h3>Secret answer</h3>
                                        <h4>
                                            <input type="text" wire:model.defer="answer" class="inpts" size="30" />
                                            <i class="ri-shield-user-line"></i>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form_box">
                                        <h3></h3>
                                        <h4>
                                            <input value="N/A (n/a)" wire:model.defer="ref" size="30" class="inpts" disabled="" />
                                            <i class="ri-money-dollar-circle-line"></i>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rem_text">
                            <p>
                                <input type="checkbox" wire:model.defer="agree" name="agree" value="1" /> I agree with
                                <a href="" wire:navigate>Terms and conditions</a>
                            </p>
                        </div>
                        <div class="form_but">
                            <input type="submit" value="Register" class="sbmt" />
                        </div>
                    </form>
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
