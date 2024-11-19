<x-app-layout>
    <div class="wrapper-content">
        <div class="inner-content">
            <div class="heading-section">
                <h2 class="tf-title pb-30">Setting</h2>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="accountForm">
                @csrf
                <div class="widget-edit mb-30 avatar">
                    <div class="title">
                        <h4>Edit your avatar</h4>
                    </div>
                    <div class="uploadfile flex">
                        <img id="uploadedImagePreview" src="{{ $user->profile->image }}" alt="Profile Image"
                            class="img-thumbnail profile-img" style="width: 125px; height: 125px;">
                        <div>
                            <h6>Upload a new avatar</h6>

                            <input type="file" name="image" id="uploadedImage" />
                        </div>
                    </div>
                </div>

                <div class="widget-edit mb-30 profile">
                    <div class="title">
                        <h4>Edit your profile</h4>
                        <i class="icon-keyboard_arrow_up"></i>
                    </div>

                    <div class="flex gap30">
                        <fieldset class="name">
                            <label>name*</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                tabindex="2" aria-required="true" required>
                        </fieldset>
                        <fieldset class="last_name">
                            <label>Last Name*</label>
                            <input type="text" id="last_name" name="last_name"
                                value="{{ $user->profile->last_name }}" tabindex="2" aria-required="true" required>
                        </fieldset>
                        <fieldset class="email">
                            <label>Email address*</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                tabindex="2" aria-required="true" required>
                        </fieldset>
                        <fieldset class="mobile">
                            <label>Mobile number</label>
                            <input type="tel" id="mobile" name="mobile" value="{{ $user->mobile }}"
                                tabindex="2" aria-required="true" required>
                        </fieldset>
                    </div>
                    <fieldset class="bio">
                        <label>Your Bio</label>
                        <textarea id="bio" name="bio" rows="4" placeholder="Say something about yourself" tabindex="4"
                            aria-required="true" required>{{ $user->profile->bio }}</textarea>
                    </fieldset>
                    <div class="flex gap30">
                        <fieldset class="Country">
                            <label>Country</label>
                            <select class="select" name="country">
                                @foreach ($countries as $country)
                                    <option {{ $user->profile->country == $country['name'] ? 'selected' : '' }}
                                        value="{{ $country['name'] }}">{{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="flex gap30">
                        <fieldset class="Language">
                            <label>Language</label>
                            <select class="select" name="language">
                                <option value="English" {{ $user->profile->language == 'English' ? 'selected' : '' }}>
                                    English</option>
                                <option value="Arabic" {{ $user->profile->language == 'Arabic' ? 'selected' : '' }}>
                                    Arabic</option>
                            </select>
                        </fieldset>
                        <fieldset class="Category">
                            <label>Category</label>
                            <select class="select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $user->profile->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="widget-edit mb-30 setting">
                    <div class="mb-4">
                        <fieldset class="location_name">
                            <label
                                style="color: #FFF;font-family: 'Manrope';font-size: 14px;font-weight: 700;line-height: 19px;margin-bottom: 16px;">Location</label>
                            <input type="text" value="{{ $user->profile->location }}" id="pac-input"
                                placeholder="Enter a location" name="location" tabindex="2" aria-required="true"
                                required>
                        </fieldset>
                        <div id="map" style="height: 300px"></div>
                        <input type="hidden" id="latitude" value="{{ $user->profile->latitude }}" name="latitude">
                        <input type="hidden" id="longitude" value="{{ $user->profile->longitude }}" name="longitude">
                        <input type="hidden" id="location-name" name="location_name"
                            value="{{ $user->profile->location }}">
                        <!-- Reset Button -->
                    </div>
                    <div class="btn-submit text-center">
                        <button class="w242" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>

<script>
    $(document).ready(function() {

        var input = $('#uploadedImage');
        input.on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var imgElement = $('#uploadedImagePreview');
                imgElement.attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $('#accountForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('auth-account-update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(function() {
                            window.location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });
        })
    });
</script>

<script>
    var map;
    var marker;
    var markerSearchByName;
    var initialCenter = {
        lat: {{ $user->profile->latitude }},
        lng: {{ $user->profile->longitude }}
    };

    function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialCenter,
            zoom: 13,
            mapTypeId: 'roadmap',
            clickableIcons: false
        });

        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        map.addListener('click', function(e) {
            setMarker(e.latLng);
            updateAddress(e.latLng);
        });

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                alert("Autocomplete's place geometry is missing: " + place.name);
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            setMarker(place.geometry.location);
            updateAddress(place.geometry.location);
        });

        // Set the initial marker
        setMarker(initialCenter);
    }

    function setMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true
            });
            marker.addListener('dragend', function(event) {
                updateAddress(event.latLng);
            });
        }
    }

    function updateAddress(latLng) {
        document.getElementById('latitude').value = latLng.lat();
        document.getElementById('longitude').value = latLng.lng();
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'location': latLng
        }, function(results, status) {
            if (status === 'OK' && results[0]) {
                document.getElementById('location-name').value = results[0].formatted_address;
                document.getElementById('pac-input').value = results[0].formatted_address;
            }
        });
    }

    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'header': [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['clean'] // Remove formatting button
            ]
        },
        placeholder: 'Type here...'
    });

    // Listen for text changes and save content to hidden input
    quill.on('text-change', function() {
        document.getElementById('messageContent').value = quill.root.innerHTML;
    });
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCc9NIB-ScnkTvQZzrB53TfaCwo1XUegHM&libraries=places,geometry&callback=initAutocomplete"
    async defer></script>
