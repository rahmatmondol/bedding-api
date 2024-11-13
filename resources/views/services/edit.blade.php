<x-app-layout>
    <div id="create" class="tabcontent">
        <div class="wrapper-content-create">
            <div class="heading-section">
                <h2 class="tf-title pb-30">edit service </h2>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert" style="width: 100%;font-size: 16px;margin: 25px 0px;">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>

            <form action="{{ route('auth-service-update', $service->id) }}" method="post"
                enctype="multipart/form-data">
                <div class="widget-content-inner description">
                    @csrf
                    <div class="wrap-content w-full">
                        <div id="commentform" class="comment-form" novalidate="novalidate">
                            <fieldset class="title">
                                <label>Service Name *</label>
                                <input type="text" id="title" placeholder="Service Name" name="title"
                                    tabindex="2" value="{{ $service->title }}" aria-required="true" required="">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="message">
                                <label>Service Description *</label>
                                <!-- Editor container -->
                                <div id="editor" style="height: 400px;border-color: #111;background: #161616;">
                                    {!! $service->description !!}
                                </div>
                                <!-- Hidden input to store the editor's content in HTML -->
                                <input type="hidden" name="description" value="{{ $service->description }}"
                                    id="messageContent" required>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="message">
                                <label>Skill and Expertice *</label>
                                <textarea id="message" name="skills" rows="4"
                                    placeholder="Add Up to 10 keyword to help pepole discover your project..." tabindex="2" aria-required="true"
                                    required="">{{ $service->skills }}</textarea>
                                @error('skills')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>
                            <fieldset class="category_id">
                                <label>Select Service Category</label>
                                <select id="category_id" name="category_id" tabindex="2" aria-required="true"
                                    required>
                                    <option value="">Select a Service Name</option>
                                    @foreach ($categories as $category)
                                        <option @if ($service->category_id == $category->id) selected @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="subcategory" style="display: none">
                                <label>Select SubCategory</label>
                                <select id="subcategory" name="subCategory_id" tabindex="2" aria-required="true"
                                    required>
                                    <option value="">Select SubCategory Name</option>
                                </select>
                                @error('subcategory')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <div class="flex gap30">
                                <fieldset class="curency">
                                    <label>Currency</label>
                                    <select id="currency" value="{{ old('currency') }}" name="currency" tabindex="2"
                                        aria-required="true" required>
                                        <option @if ($service->currency == 'USD') selected @endif value="USD">USD
                                        </option>
                                        <option @if ($service->currency == 'AED') selected @endif value="AED">AED
                                        </option>
                                    </select>
                                    @error('currency')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="Pricetyoe">
                                    <label>Price type</label>
                                    <select value="{{ old('priceType') }}" id="priceType" name="priceType"
                                        tabindex="2" aria-required="true" required>
                                        <option @if ($service->priceType == 'Fixed') selected @endif value="Fixed">Fixed
                                        </option>
                                        <option @if ($service->priceType == 'Negotiable') selected @endif value="Negotiable">
                                            Negotiable</option>
                                    </select>
                                    @error('price_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="price">
                                    <label>Price</label>
                                    <input type="number" id="price" placeholder="Price" name="price"
                                        tabindex="2" value="{{ $service->price }}" aria-required="true"
                                        required="" step="0.01">
                                </fieldset>
                            </div>
                            <div class="mb-4">
                                <fieldset class="location">
                                    <label>Location</label>
                                    <input type="text" id="pac-input" placeholder="Enter a location" name="location"
                                        tabindex="2" value="{{ $service->location }}" aria-required="true" required>
                                </fieldset>
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('latitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('longitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div id="map" style="height: 300px"></div>
                                <input type="hidden" id="latitude" name="latitude"
                                    value="{{ $service->latitude }}">
                                <input type="hidden" id="longitude" name="longitude"
                                    value="{{ $service->longitude }}">
                                <input type="hidden" id="location-name" name="location_name" value="{{ $service->location }}">
                                <!-- Reset Button -->
                                <button type="button" onclick="resetMap()" class="">Reset Location</button>
                            </div>

                            <div class="btn-submit flex gap30 justify-center">
                                <a href="{{ route('service.details', $service->id) }}" wire:navigate
                                    class="tf-button style-1 h50 active">Preview<i
                                        class="icon-arrow-up-right2"></i></a>
                                <button type="submit">Update<i class="icon-arrow-up-right2"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-upload">
                        <label class="uploadfile flex items-center justify-center"
                            style="border-radius: 0;padding: 10px 0;">
                            <div class="text-center">
                                @foreach ($service->images as $image)
                                    <img id="uploadedImagePreview" src="{{ $image->path }}"
                                        alt="Uploaded Image Preview" style="height: auto;margin: 10px;">
                                @endforeach
                                <h5>Upload file</h5>
                                <p class="text">Drag or choose your file to upload</p>
                                <div class="text filename">PNG, GIF, WEBP, MP4 or MP3. Max 1Gb.</div>
                                <input type="file" name="image" value=""
                                    onchange="previewUploadedImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
<script>
    $(document).ready(function() {

        // Get subcategories on category change
        $('#category_id').on('change', function() {
            var category = $(this).val();
            if (category) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get-subcategories') }}?category_id=" + category,
                    success: function(res) {
                        if (res.success) {
                            $('#subcategory').empty();
                            res.data.forEach(function(subcategory) {
                                $('#subcategory').append(
                                    `<option value="${subcategory.id}">${subcategory.name}</option>`
                                );
                                $('.subcategory').show();
                            })
                        }
                    }
                });
            }
        });

        // set initial subcategory
        var category = {{ $service->category_id }};

        if (category) {
            $.ajax({
                type: "GET",
                url: "{{ route('get-subcategories') }}?category_id=" + category,
                success: function(res) {
                    if (res.success) {
                        $('#subcategory').empty();
                        res.data.forEach(function(subcategory) {
                            $('#subcategory').append(
                                `<option value="${subcategory.id}">${subcategory.name}</option>`
                            );
                        })
                        $('#subcategory').val({{ $service->sub_category_id }});
                        $('.subcategory').show();
                    }
                }
            })
        }

        // submit form
        $('form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('auth-service-update', $service->id) }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    if (res.success) {
                        // show success message
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: res.message,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: res.message,
                        });

                        // show error message
                        $('.alert-danger').html(res.message).show();
                    }
                },
                error: function({
                    responseJSON
                }) {
                    console.log(responseJSON);
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: responseJSON.message,
                    });
                }
            });
        })
    });
</script>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    var map;
    var marker;
    var markerSearchByName;
    var initialCenter = {
        lat: {{ $service->latitude }},
        lng: {{ $service->longitude }}
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

    function resetMap() {
        map.setCenter(initialCenter);
        map.setZoom(13);
        document.getElementById('pac-input').value = '';
        document.getElementById('latitude').value = '';
        document.getElementById('longitude').value = '';
        document.getElementById('location-name').value = '';
        if (marker) {
            marker.setMap(null);
            marker = null;
        }
    }

    function previewUploadedImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const imgElement = document.getElementById('uploadedImagePreview');
            imgElement.src = reader.result;
            imgElement.style.height = 'auto';
        }
        reader.readAsDataURL(event.target.files[0]);
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

<style>
    .ql-toolbar.ql-snow {
        border-color: #111;
    }

    .ql-formats {
        color: #fff;
    }
</style>
