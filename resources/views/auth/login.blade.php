<x-guest-layout>
    <div class="tf-section-2 pt-60 widget-box-icon">
        <div class="themesflat-container w920">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section-1">
                        <h2 class="tf-title pb-16">Hi, Welcome Back!</h2>
                        <p class="pb-40">Sing in to your Account</p>
                        @if (session()->has('message'))
                            <div class="alert alert-warning" style="font-size: 16px;">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="widget-login">
                        <form id="login_form" class="comment-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <fieldset class="email">
                                <label>Email *</label>
                                <input type="email" id="email" placeholder="mail@website.com" name="email"
                                    tabindex="2" value="" aria-required="true">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="password">
                                <label>Password *</label>
                                <input class="password-input" type="password" id="password"
                                    placeholder="Min. 8 character" name="password" tabindex="2" value=""
                                    aria-required="true">
                                <i class="icon-show password-addon" id="password-addon" onclick="showPassword()"></i>
                                <div class="forget-password">
                                    <a href="#">Forget password</a>
                                </div>
                            </fieldset>
                            @error('password')
                                <span class="text-danger" style="position: relative;top: -60px;">{{ $message }}</span>
                            @enderror

                            <div class="btn-submit mb-30">
                                <button type="submit" class="tf-button style-1 h50 w-100">
                                    <span>Login<i class="icon-arrow-up-right"></i></span>
                                </button>
                            </div>
                        </form>
                        <div class="other">or continue</div>
                        <div class="login-other">
                            <a href="#" class="login-other-item">
                                <img src="{{ asset('user') }}/assets/images/google.png" alt="">
                                <span>Sign with google</span>
                            </a>
                        </div>
                        <div class="no-account">Don't have an account? <a href="/auth/singup" wire:navigate
                                class="tf-color">Sign
                                up</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>

<script>
    // show password
    function showPassword() {
        var password = document.getElementById("password");
        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }
</script>
