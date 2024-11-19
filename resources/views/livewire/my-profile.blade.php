<div class="wrapper-content">
    <div class="inner-content">
        <div class="heading-section">
            <h2 class="tf-title pb-30">Setting</h2>
        </div>
        <div class="widget-edit mb-30 avatar">
            <div class="title">
                <h4>Edit your avatar</h4>
                <i class="icon-keyboard_arrow_up"></i>
            </div>
            <form action="#">
                <div class="uploadfile flex">
                    <img src="assets/images/avatar/avatar-07.png" alt="">
                    <div>
                        <h6>Upload a new avatar”</h6>
                        <label>
                            <input type="file" class="" name="file">
                            <span class="text filename">No files selected</span>
                        </label>
                        <p class="text">JPEG 100x100</p>
                    </div>
                </div>
            </form>
        </div>
        <div class="widget-edit mb-30 profile">
            <div class="title">
                <h4>Edit your profile</h4>
                <i class="icon-keyboard_arrow_up"></i>
                <button class="w242 active">Cancel</button>
            </div>
            <form id="commentform" class="comment-form" novalidate="novalidate">
                <div class="flex gap30">
                    <fieldset class="name">
                        <label>name*</label>
                        <input type="text" id="name" wire:model="name" placeholder="Your name" name="name"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="last_name">
                        <label>Last Name*</label>
                        <input type="text" id="last_name" wire:model="last_name" placeholder="Your last name"
                            name="name" tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="email">
                        <label>Email address*</label>
                        <input type="email" id="email" wire:model="email" placeholder="Your email" name="email"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset class="mobile">
                        <label>Mobile number</label>
                        <input type="tel" id="mobile" wire:model="mobile" placeholder="Your phone" name="mobile"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                </div>
                <fieldset class="bio">
                    <label>Your Bio</label>
                    <textarea id="bio" name="bio" wire:model="bio" rows="4" placeholder="Say something about yourself"
                        tabindex="4" aria-required="true" required=""></textarea>
                </fieldset>
                <div class="flex gap30">
                    <fieldset class="Country">
                        <label>Country</label>
                        <select class="select" name="curency" id="curency" wire:model="country">
                            @foreach ($countries as $country)
                                <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                    <fieldset class="curency">
                        <label>Curency</label>
                        <select class="select" name="curency" id="curency" wire:model="curency">
                            <option>Selecte Curency</option>
                            <option value="USD">USD</option>
                            <option value="AED">AED</option>
                        </select>
                    </fieldset>
                </div>
                <div class="flex gap30">
                    <fieldset class="Language">
                        <label>Language</label>
                        <select class="select" name="Language" id="Language" wire:model="language">
                            <option>Selecte Language</option>
                            <option value="English">English</option>
                            <option value="Arabic">Arabic</option>
                        </select>
                    </fieldset>
                    <fieldset class="Category">
                        <label>Category</label>
                        <select class="select" name="category" id="category" wire:model="category">
                            <option>Selecte Language</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>
            </form>
            <div class="btn-submit">
                <button class="w242 active mr-30">Cancel</button>
                <button class="w242" type="submit">Save</button>
            </div>
        </div>
        <div class="widget-edit mb-30 setting">
            <div class="mb-4">
                <fieldset class="location_name">
                    <label style="color: #FFF;font-family: 'Manrope';font-size: 14px;font-weight: 700;line-height: 19px;margin-bottom: 16px;">Location</label>
                    <input type="text" id="pac-input" placeholder="Enter a location" wire:model="location_name" name="location_name"
                        tabindex="2" aria-required="true" required>
                </fieldset>
                <div id="map" style="height: 300px"></div>
                <input type="hidden" id="latitude" wire:model="latitude" name="latitude">
                <input type="hidden" id="longitude" wire:model="longitude" name="longitude">
                <input type="hidden" id="location-name" name="location_name">
                <!-- Reset Button -->
            </div>
            <div class="btn-submit">
                <button class="w242 active mr-30">Cancel</button>
                <button class="w242" type="submit">Save</button>
            </div>
        </div>
        
        <div class="widget-edit mb-30 password">
            <div class="title">
                <h4>Change password</h4>
                <i class="icon-keyboard_arrow_up"></i>
            </div>
            <form id="commentform" class="comment-form" novalidate="novalidate">
               
                <fieldset class="password">
                    <label>Old password</label>
                    <input type="text" id="password" placeholder="Enter your Old password" name="password"
                        tabindex="2" value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="password">
                    <label>New password</label>
                    <input type="text" id="password" placeholder="Enter your New password" name="password"
                        tabindex="2" value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="password">
                    <label>Confirm password</label>
                    <input type="text" id="password" placeholder="Confirm password" name="password"
                        tabindex="2" value="" aria-required="true" required="">
                </fieldset>
                <div class="btn-submit">
                    <button class="w242 active mr-30">Cancel</button>
                    <button class="w242" type="submit">Save</button>
                </div>
            </form>
        </div>

    </div>
   
</div>
