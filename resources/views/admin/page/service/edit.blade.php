@php use function Laravel\Prompts\select; @endphp
@extends('admin.layouts.master')
@section('style')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <style>
        #uploadedImagePreviewList img {
            width: 25%;
            padding: 5px;
        }

        #uploadedImagePreviewList {
            display: flex;
            flex-wrap: wrap;
        }

        #map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection
@section('title')
    <title>Add Service Page</title>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Service Inputs</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <form class="row g-3" id="serviceForm" method="Post" action=""
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Name</label>
                            <input type="text" name="title" class="form-control" value="{{ $service->title }}"
                                id="input1" placeholder="Title">
                        </div>
                        <div class="col-md-4">
                            <label for="zoneSelect" class="form-label">Select Zone</label>
                            <select name="zone_id" id="zoneSelect" class="form-select">
                                <option disabled>Choose...</option>
                                @foreach ($zones as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="categorySelect" class="form-label">Select Category</label>
                            <select name="category_id" id="categorySelect" class="form-select" required>
                                @foreach ($categories as $item)
                                    <option {{ $service->category_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="subcategorySelect" class="form-label">Sub Category</label>
                            <select name="subCategory_id" id="subcategorySelect" class="form-select" required>
                                <option disabled>Choose...</option>
                                @foreach ($subcategories as $item)
                                    <option {{ $service->sub_category_id == $item->id ? 'selected' : '' }}
                                        {{ $service->subCategory_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="input4" class="form-label">Assign Service To Customer</label>
                            <select id="input4" name="customer_id" class="form-select" required>
                                @foreach ($providers as $item)
                                    <option {{ $service->user_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="input5" class="form-label">Price Type</label>
                            <select id="input5" name="priceType" class="form-select" required>
                                <option {{ $service->priceType == 'Fixed' ? 'selected' : '' }} value="Fixed">Fixed
                                </option>
                                <option {{ $service->priceType == 'Negotiable' ? 'selected' : '' }} value="Negotiable">
                                    Negotiable</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Price</label>
                            <input type="number" value="{{ $service->price }}" name="price" class="form-control"
                                id="input6" placeholder="100" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label for="input7" class="form-label">Level</label>
                            <select id="input7" name="level" class="form-select" required>
                                <option {{ $service->level == 'Entry' ? 'selected' : '' }} value="Entry">Entry</option>
                                <option {{ $service->level == 'Intermediate' ? 'selected' : '' }} value="Intermediate">
                                    Intermediate</option>
                                <option {{ $service->level == 'Expert' ? 'selected' : '' }} value="Expert">Expert</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="input8" class="form-label">Currency</label>
                            <select id="input8" class="form-select" name="currency" required>
                                <option {{ $service->currency == 'USD' ? 'selected' : '' }} value="USD" selected>USD
                                </option>
                                <option {{ $service->currency == 'AED' ? 'selected' : '' }} value="AED">AED</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="skill" class="form-label">Skill</label>
                            <input type="text" class="form-control" id="skills"
                                name="skill" value="{{ implode(',', json_decode($service->skills)) }}" placeholder="PHP, Laravel, JavaScript"
                                data-role="tagsinput" />
                        </div>


                        <div class="col-md-12">
                            <label for="input11" class="form-label">Long description</label>
                            <div id="editor" style="height: 400px;">
                                {!! $service->description !!}

                            </div>

                            <!-- Hidden input to store the editor's content in HTML -->
                            <input type="hidden" name="description" value="{{ $service->description }}"
                                id="messageContent" required />
                        </div>
                        <div class="mb-3">
                            <div id="uploadedImagePreviewList">
                                @foreach ($service->images as $image)
                                    <img src="{{ $image->path }}" alt=" " style="height: auto;">
                                @endforeach
                            </div>

                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" name="images[]" id="formFile"
                                onchange="previewUploadedImage(event)" multiple>
                        </div>

                        <div class="col-md-12">
                            <label for="input1" class="form-label">Address</label>
                            <input type="text" value="{{ $service->location }}" id="pac-input"
                                class="form-control" name="location" placeholder="Dhaka,Bangladesh">
                        </div>


                        <div class="col-md-12">
                            <div id="map"></div>
                        </div>
                        <input type="hidden" id="location-name" value="{{ $service->location }}"
                            name="location_name">
                        <input type="hidden" id="latitude" name="latitude" value="{{ $service->latitude }}">
                        <input type="hidden" id="longitude" name="longitude" value="{{ $service->longitude }}">

                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" @if ($service->is_featured == 1) checked @endif
                                    type="checkbox" name="is_featured" id="input12">
                                <label class="form-check-label" for="input12">Set as featured</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid justify-content-end gap-3">

                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="button" class="btn btn-light px-4" onclick="resetMap()">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        $(document).ready(function() {

            // Get subcategories on category change
            $('#categorySelect').on('change', function() {
                var category = $(this).val();
                if (category) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get-subcategories') }}?category_id=" + category,
                        success: function(res) {
                            if (res.success) {
                                $('#subcategorySelect').empty();
                                res.data.forEach(function(subcategory) {
                                    $('#subcategorySelect').append(
                                        `<option value="${subcategory.id}">${subcategory.name}</option>`
                                    );
                                })
                            }
                        }
                    });
                }
            });

            // submit form
            $('#serviceForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var skills = $('#skills').val();
                formData.append('skills', JSON.stringify(skills.split(',')));

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
        .confirmation-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            padding: 20px;
            opacity: 0;
            /* Start with 0 opacity */
            transition: opacity 0.3s ease;
            /* Add a transition effect for opacity */
        }

        .confirmation-popup.show {
            display: block;
            /* Show the pop-up */
            opacity: 1;
            /* Make it fully opaque when visible */
        }

        .confirmation-popup h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .confirmation-popup .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .confirmation-popup .btn-container button {
            margin: 0 10px;
            padding: 8px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirmation-popup .btn-confirm {
            background-color: #5cb85c;
            color: #ffffff;
        }

        .confirmation-popup .btn-cancel {
            background-color: #d9534f;
            color: #ffffff;
        }
    </style>
@endsection
