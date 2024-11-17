<div class="tf-section-2 pt-60 widget-box-icon">
    <div class="themesflat-container w920">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section-1">
                    <h2 class="tf-title pb-16">Create Account</h2>
                    <p class="pb-40">Explore the SMART BIDDING World</p>
                </div>
            </div>
            <div class="col-12">
                <div class="widget-login">
                    <form id="commentform" class="comment-form">

                        <fieldset class="name">
                            <label>Account Type *</label>
                            <select id="name" wire:model="account_type" name="account_type" tabindex="2" value=""
                                aria-required="true" required>
                                <option value="provider">Provider</option>
                                <option value="customer">Customer</option>
                            </select>
                            @error('account_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </fieldset>

                        <fieldset class="name">
                            <label>Name *</label>
                            <input type="text" wire:model="name" id="name" placeholder="Your name*" name="name"
                                tabindex="2" value="" aria-required="true" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </fieldset>

                        <fieldset class="email">
                            <label>Email *</label>
                            <input type="email" wire:model="email" id="email" placeholder="mail@website.com"
                                name="email" tabindex="2" value="" aria-required="true" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>


                        <fieldset class="name">
                            <label>Mobile Number *</label>
                            <input type="tel" wire:model="phone" id="mobile" placeholder="Your mobile number*"
                                name="mobile" tabindex="2" value="" aria-required="true" required>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>


                        <fieldset class="name">
                            <label>Country *</label>
                            <select id="name" wire:model="country" name="country" tabindex="2" value=""
                                aria-required="true" required>
                                @foreach($countries as $country)
                                <option value="{{$country['code']}}">{{$country['name']}}</option>
                                @endforeach
                            </select>
                            @error('country')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>


                        <fieldset class="password">
                            <label>Password *</label>
                            <input class="password-input" wire:model="password" type="password" id="password"
                                placeholder="Min. 8 character" name="password" tabindex="2" value=""
                                aria-required="true" required>
                            <i class="icon-show password-addon" id="password-addon" onclick="showPassword()"></i>
                        </fieldset>
                        @error('password')
                        <span class="text-danger" style="position: relative;top: -25px;">{{ $message }}</span>
                        @enderror
                        <br>
                        <fieldset class="password">
                            <label>Confirm Password *</label>
                            <input class="password-input" type="password" wire:model="confirmpassword"
                                id="password_confirmation" placeholder="Confirm password" name="confirmpassword"
                                tabindex="2" value="" aria-required="true" required>
                            <i class="icon-show password-addon" id="password-addon"
                                onclick="password_confirmation()"></i>
                        </fieldset>
                        @error('confirmpassword')
                        <span class="text-danger" style="position: relative;top: -25px;">{{ $message }}</span>
                        @enderror

                        <br>
                        <div class="btn-submit mb-30">
                            <button type="button" wire:click="register" wire:loading.attr="disabled" class="tf-button style-1 h50 w-100">
                                <span wire:loading.remove>Sign up<i class="icon-arrow-up-right2"></i></span>
                                <span wire:loading>Loading...</span>
                            </button>
                        </div>
                    </form>

                    <div class="no-account">Already have an account? <a href="/auth" wire:navigate
                            class="tf-color">Log in</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showPassword() {
        var password = document.getElementById("password");
        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }
    function password_confirmation() {
        var password_confirmation = document.getElementById("password_confirmation");
        if (password_confirmation.type === "password") {
            password_confirmation.type = "text";
        } else {
            password_confirmation.type = "password";
        }
    }
</script>