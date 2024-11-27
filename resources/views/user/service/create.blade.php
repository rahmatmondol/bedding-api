<x-app-layout>
    <div id="create" class="tabcontent">
        <div class="wrapper-content-create">
            <div class="heading-section">
                <h2 class="tf-title pb-30">Create a service</h2>
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
                <div class="alert alert-danger" role="alert" style="display: none">

                </div>
            </div>
            <form action="{{ route('auth-service-store') }}" method="post" enctype="multipart/form-data">
                <div class="widget-content-inner description">
                    @csrf
                    <div class="wrap-content w-full">
                        <div id="commentform" class="comment-form" novalidate="novalidate">

                            <fieldset class="title">
                                <label>Service Name *</label>
                                <input type="hidden" name="postType" value="Service">
                                <input type="text" id="title" placeholder="Service Name" name="title"
                                    tabindex="2" value="{{ old('title') }}" aria-required="true" required="">

                            </fieldset>
                           
                            <fieldset class="message">
                                <label>Service Description *</label>
                                <!-- Editor container -->
                                <div id="editor" style="height: 400px;border-color: #111;background: #161616;">
                                    {!! old('description') !!}

                                </div>
                                <!-- Hidden input to store the editor's content in HTML -->
                                <input type="hidden" name="description" value="{{ old('description') }}"
                                    id="messageContent" required>

                            </fieldset>

                            <fieldset class="message">
                                <label>Skill and Expertice *</label>
                                <input type="text" id="skills" name="skill"
                                    placeholder="PHP, Laravel, JavaScript" data-role="tagsinput">
                                @error('skills')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </fieldset>

                            <fieldset class="category">
                                <label>Select Service Category</label>
                                <select id="category" name="category_id" tabindex="2" aria-required="true" required>
                                    <option value="">Select a Service Name</option>
                                    @foreach ($categories as $category)
                                        <option @if (old('category') == $category->id) selected @endif
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
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
                                        <option @if (old('currency') == 'USD') selected @endif value="USD">$ USD
                                        </option>
                                        <option @if (old('currency') == 'AED') selected @endif value="AED">AED
                                        </option>
                                    </select>
                                    @error('currency')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <fieldset class="priceType">
                                    <label>Price type</label>
                                    <select value="{{ old('priceType') }}" id="priceType" name="priceType"
                                        tabindex="2" aria-required="true" required>
                                        <option @if (old('priceType') == 'Fixed') selected @endif value="Fixed">Fixed
                                        </option>
                                        <option @if (old('priceType') == 'Negotiable') selected @endif value="Negotiable">
                                            Negotiable</option>
                                    </select>
                                    @error('priceType')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                            </div>
                            <div class="flex gap30">
                                <fieldset class="price">
                                    <label>Price</label>
                                    <input type="number" id="price" placeholder="Price" name="price"
                                        tabindex="2" value="{{ old('price') }}" aria-required="true" required=""
                                        step="0.01">
                                </fieldset>


                                <fieldset class="Pricetyoe">
                                    <label for="input7" class="form-label">Level</label>
                                    <select id="input7" name="level" class="form-select" required>
                                        <option selected value="entry">Entry</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="expert">Expert</option>
                                    </select>
                                    @error('price_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>


                            </div>

                            <div class="mb-4">
                                <fieldset class="location_name">
                                    <label>Location</label>
                                    <input type="text" id="pac-input" placeholder="Enter a location"
                                        name="location_name" tabindex="2" value="{{ old('location_name') }}"
                                        aria-required="true" required>
                                </fieldset>
                                @error('location_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('latitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('longitude')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div id="map" style="height: 300px"></div>
                                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                                <input type="hidden" id="longitude" name="longitude"
                                    value="{{ old('longitude') }}">
                                <input type="hidden" id="location-name" name="location_name">
                                <!-- Reset Button -->
                                <button type="button" onclick="resetMap()" class="">Reset Location</button>
                            </div>

                            <div class="btn-submit flex gap30 justify-center">
                                <button class="tf-button style-1 h50 active">Preview<i
                                        class="icon-arrow-up-right2"></i></button>
                                <button type="submit">Submit item<i class="icon-arrow-up-right2"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-upload">
                        <label class="uploadfile flex items-center justify-center"
                            style="border-radius: 0;padding: 10px 0;">
                            <div class="text-center">
                                <img id="uploadedImagePreviewList"
                                    src="{{ old('images') ? asset('storage/' . old('images')) : asset('assets/img/upload.png') }}"
                                    alt="Uploaded Image Preview" style="height: auto;">
                                <h5>Upload file</h5>
                                <p class="text">Drag or choose your file to upload</p>
                                <div class="text filename">PNG, GIF, WEBP, MP4 or MP3. Max 1Gb.</div>
                                <input type="file" name="images[]" value="{{ old('images') }}"
                                    onchange="previewUploadedImage(event)" multiple>
                                @error('images')
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
        $('#category').on('change', function() {
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

        // submit form
        $('form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var skills = $('#skills').val();
            formData.append('skills', JSON.stringify(skills.split(',')));
            $.ajax({
                type: "POST",
                url: "{{ route('auth-service-store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    if (res.success) {
                        // reset form
                        $('form')[0].reset();
                        // reset map
                        resetMap();
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
        lat: 23.8103,
        lng: 90.4125
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
        const files = event.target.files;
        const imgElement = document.getElementById('uploadedImagePreview');
        const previewList = document.getElementById('uploadedImagePreviewList');
        previewList.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.createElement('img');
                img.src = reader.result;
                img.style.height = 'auto';
                previewList.appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }
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
