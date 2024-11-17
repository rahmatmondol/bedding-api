<div id="create" class="tabcontent">
    <div class="wrapper-content-create">
        <div class="heading-section">
            <h2 class="tf-title pb-30">Create a service</h2>
        </div>
        <div class="widget-content-inner description">
            <div class="wrap-content w-full">
                <div id="commentform" class="comment-form" novalidate="novalidate">
                    <fieldset class="name">
                        <label>Service Name *</label>
                        <input type="text" id="name" wire:model="name" placeholder="Service Name" name="name"
                            tabindex="2" value="" aria-required="true" required="">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="message">
                        <label>Service Description *</label>
                        <!-- Editor container -->
                        <div id="editor" style="height: 400px;border-color: #111;background: #161616;">
                        </div>
                        <!-- Hidden input to store the editor's content in HTML -->
                        <input type="hidden" name="messageContent" wire:model='description' id="messageContent" required>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="message">
                        <label>Skill and Expertice *</label>
                        <textarea wire:model="skills" id="message" name="message" rows="4"
                            placeholder="Add Up to 10 keyword to help pepole discover your project..." tabindex="2" aria-required="true"
                            required=""></textarea>
                        @error('skills')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <label>Select Service Category</label>
                        <select id="name" name="name" tabindex="2" aria-required="true" required
                            wire:model="category">
                            <option value="">Select a Service Name</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <div class="flex gap30">
                        <fieldset class="curency">
                            <label>Currency</label>
                            <select wire:model="currency" id="currency" name="currency" tabindex="2" aria-required="true" required
                                wire:model="currency">
                                <option value="usd">$ USD</option>
                                <option value="aed">AED</option>
                            </select>
                            @error('currency')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="Pricetyoe">
                            <label>Price type</label>
                            <select wire:model="price_type" id="price_type" name="price_type" tabindex="2" aria-required="true" required
                                wire:model="price_type">
                                <option value="fixed">Fixed</option>
                                <option value="negotiable">Negotiable</option>
                            </select>
                            @error('price_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <fieldset class="price">
                            <label>Price</label>
                            <input wire:model="price" type="number" id="price" placeholder="Price" name="price" tabindex="2"
                                value="" aria-required="true" required="" step="0.01" wire:model="price">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                    </div>
                    <div class="mb-4">
                        <fieldset class="location">
                            <label>Location</label>
                            <input type="text" wire:model="location" id="pac-input" placeholder="Enter a location" name="location"
                                tabindex="2" value="" aria-required="true" required wire:model="location">
                            @error('location')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </fieldset>
                        <div id="map" style="height: 300px"></div>
                        <input type="hidden" wire:model="latitude" id="latitude" name="latitude" wire:model="latitude">
                        <input type="hidden" wire:model="longitude" id="longitude" name="longitude" wire:model="longitude">
                        <input type="hidden" id="location-name" name="location_name" wire:model="location_name">
                        <!-- Reset Button -->
                        <button type="button" onclick="resetMap()" class="">Reset Location</button>
                    </div>

                    <div class="btn-submit flex gap30 justify-center">
                        <button class="tf-button style-1 h50 active" wire:click="preview">Preview<i
                                class="icon-arrow-up-right2"></i></button>
                        <button  wire:click="store" >Submit item<i
                                class="icon-arrow-up-right2"></i></button>
                    </div>
                </div>
            </div>
            <div class="wrap-upload">
                <label class="uploadfile flex items-center justify-center" style="border-radius: 0;padding: 10px 0;">
                    <div class="text-center">
                        <img id="uploadedImagePreview" src="{{ asset('user') }}/assets/images/box-icon/upload.png"
                            alt="Uploaded Image Preview" style="height: auto;">
                        <h5>Upload file</h5>
                        <p class="text">Drag or choose your file to upload</p>
                        <div class="text filename">PNG, GIF, WEBP, MP4 or MP3. Max 1Gb.</div>
                        <input type="file" name="file" onchange="previewUploadedImage(event)"
                            wire:model="image">
                    </div>
                </label>
            </div>
        </div>
    </div>
</div>
