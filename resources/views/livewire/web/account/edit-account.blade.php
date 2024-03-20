<div class="wrapper">
    @include('web.layouts.navbar')
    <section class="home-section">
        <div class="headerall_top">
            <div class="row">
                <div class="col-lg-3">
                    <a href="{{ url('/') }}" wire:navigate> <h2 class="pl-2 pt-3 items-center" style="font-size: 26px;text-transform: uppercase;font-weight: 700">
                            Stakingcoins</h2></a>
                </div>
                <div class="col-lg-5">
                    <div class="home-content">
                        <i class="ri-menu-line"></i>
                        <h1 class="head">Edit Account </h1> <br>
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
                        <a href="{{ url('logout') }}" wire:navigate class="but2"> logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin1_bg">
            <div class="container-fluid">
                <div class="depo_bg">
                    <div class="admin_bg login_bg signup_bg">
                        @if (session('success'))
                            <div class="error">{{ session('success') }}</div>
                        @endif
                        <div class="m-auto" style="max-width: 1500px ; width: 100%;">
                            <div class="head2">
                                <h2>Edit <span> Account</span></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <div class="head_img">
                                        <img src="images/content_img4.png" class="img1" alt="content_img3" />
                                    </div>

                                </div>
                                <div class="col-lg-7 col-md-12">
                                    @if (session('error'))
                                        <div class="error">{{ session('error') }}</div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="error">{{ $errors->first() }}</div>
                                    @endif
                                    <form onsubmit="return checkform()" wire:submit.prevent="submit" name="regform">
                                        <div class="form1">
                                            <div class="form_text">
                                                <a href="?home">
                                                    <img src="images/form_img1.png" class="form_img" /></a>
                                                <h2>Edit <span> form</span></h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Full Name</h3>
                                                        <h4>
                                                            <input type="text" wire:model.defer="fullname"
                                                                name="fullname" class="inpts" size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Your Username</h3>
                                                        <h4>
                                                            <input type="text" wire:model.defer="username"
                                                                name="username" class="inpts" size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Define Password</h3>
                                                        <h4>
                                                            <input type="password" wire:model.defer="password"
                                                                name="password" class="inpts" size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Retype Password</h3>
                                                        <h4>
                                                            <input type="password" name="password2" class="inpts"
                                                                size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>E-mail Address</h3>
                                                        <h4>
                                                            <input type="text" wire:model.defer="email"
                                                                name="email" class="inpts" size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Retype Your E-mail</h3>
                                                        <h4> <input type="text" name="email1"
                                                                wire:model.defer="email" class="inpts"
                                                                size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Wallet Address</h3>
                                                        <h4>
                                                            <input type="text" wire:model.defer="wallet_address"
                                                                name="wallet_address" class="inpts"
                                                                size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form_box">
                                                        <h3>Retype Your Wallet Address</h3>
                                                        <h4> <input type="text" name="wallet_address"
                                                                wire:model.defer="wallet_address" class="inpts"
                                                                size="30" />
                                                            <i class="ri-shield-user-line"></i>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form_box">
                                                    <h3></h3>
                                                    <h4>
                                                        <input value="N/A (n/a)" size="30" class="inpts"
                                                            disabled="" />
                                                        <i class="ri-money-dollar-circle-line"></i>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_but">
                                            <input type="submit" value="Save" class="sbmt" />
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script language="javascript">
    function checkform() {
        if (document.regform.fullname.value == "") {
            alert("Please enter your full name!");
            document.regform.fullname.focus();
            return false;
        }
        if (document.regform.username.value == "") {
            alert("Please enter your username!");
            document.regform.username.focus();
            return false;
        }
        if (
            !document.regform.username.value.match(/^[A-Za-z0-9_\-]+$/)
        ) {
            alert(
                "For username you should use English letters and digits only!"
            );
            document.regform.username.focus();
            return false;
        }
        if (document.regform.email.value == "") {
            alert("Please enter your e-mail address!");
            document.regform.email.focus();
            return false;
        }
        if (
            document.regform.email.value != document.regform.email1.value
        ) {
            alert("Please retype your e-mail!");
            document.regform.email.focus();
            return false;
        }
        for (i in document.regform.elements) {
            f = document.regform.elements[i];
            if (f.name && f.name.match(/^pay_account/)) {
                if (f.value == "") continue;
                var notice = f.getAttribute("data-validate-notice");
                var invalid = 0;
                if (f.getAttribute("data-validate") == "regexp") {
                    var re = new RegExp(
                        f.getAttribute("data-validate-regexp")
                    );
                    if (!f.value.match(re)) {
                        invalid = 1;
                    }
                } else if (f.getAttribute("data-validate") == "email") {
                    var re = /^[^\@]+\@[^\@]+\.\w{2,4}$/;
                    if (!f.value.match(re)) {
                        invalid = 1;
                    }
                }
                if (invalid) {
                    alert("Invalid account format. Expected " + notice);
                    f.focus();
                    return false;
                }
            }
        }
        return true;
    }

    function IsNumeric(sText) {
        var ValidChars = "0123456789";
        var IsNumber = true;
        var Char;
        if (sText == "") return false;
        for (i = 0; i < sText.length && IsNumber == true; i++) {
            Char = sText.charAt(i);
            if (ValidChars.indexOf(Char) == -1) {
                IsNumber = false;
            }
        }
        return IsNumber;
    }
</script>
