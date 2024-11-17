@extends('admin.layouts.master')
@section('style')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        #map {
            width: 50%;
            height: 300px;
        }

        .map-container {
            position: relative;

            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .controls {
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            border: 1px solid transparent;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            margin-top: 10px;
            outline: none;
            padding: 5px 10px;
            text-overflow: ellipsis;
            width: 300px;
        }

        .controls:focus {
            border-color: #4d90fe;
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
                    <form class="row g-3" id="categoryForm" method="Post" action="{{ route('service.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="input1" placeholder="Name">
                        </div>
                        <div class="col-md-4">
                            <label for="zoneSelect" class="form-label">Select Zone</label>
                            <select name="zone_id" id="zoneSelect" class="form-select" required>
                                <option disabled  >Choose...</option>
                                @foreach($zones as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="categorySelect" class="form-label">Select Category</label>
                            <select name="category_id" id="categorySelect" class="form-select" required>

                            </select>
                        </div>
{{--                        <div class="confirmation-popup" id="locationPermissionPopup">--}}
{{--                            <h3>Location Access Required</h3>--}}
{{--                            <p>Please allow access to your location to use this feature.</p>--}}
{{--                            <div class="btn-container">--}}
{{--                                <button class="btn btn-confirm" id="allowLocationAccess">Allow</button>--}}
{{--                                <button class="btn btn-cancel" id="cancelLocationAccess">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-4">
                            <label for="subcategorySelect" class="form-label">Sub Category</label>
                            <select name="subcategory_id" id="subcategorySelect" class="form-select" required></select>
                        </div>
                        <div class="col-md-4">
                            <label for="input4" class="form-label">Assign Service To Customer</label>
                            <select id="input4" name="customer_id" class="form-select" required>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="input5" class="form-label">Price Type</label>
                            <select id="input5" name="price_type" class="form-select" required>
                                <option selected value="fixed">Fixed</option>
                                <option value="negotiable">Negotiable</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" id="input6" placeholder="100">
                        </div>
                        <div class="col-md-4">
                            <label for="input7" class="form-label">Level</label>
                            <select id="input7" name="level" class="form-select" required>
                                <option selected value="entry">Entry</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="input8" class="form-label">Currency</label>
                            <select id="input8" class="form-select" name="currency" required>
                                <option value="usd" selected>USD</option>
                                <option value="aed">AED</option>
                            </select>
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <label for="input1" class="form-label">Duration (Hours:Minutes)</label>--}}
{{--                            <input type="text" class="form-control" name="duration" id="duration" placeholder="1:00">--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Skill</label>
                            <input type="text" class="form-control" name="skill"  placeholder="PHP, Laravel">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address"  placeholder="Dhaka,Bangladesh">
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Long description</label>
                            <textarea class="form-control" name="description" id="editor" placeholder="Address ..." rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <div class="col-md-12">
                            <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                            <div id="map"></div>
                        </div>

                        <!-- Hidden input fields to store latitude and longitude values -->
{{--                        <input type="hidden" id="coordinates" name="coordinates">--}}
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">


                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="input12">
                                <label class="form-check-label" for="input12">Set as featured</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid justify-content-end gap-3">

                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="button" class="btn btn-light px-4" onclick="resetForm()">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(document).ready(function() {
            $('#duration').on('input', function() {
                var input = $(this).val();
                var isValid = /^([01]?[0-9]|2[0-3]):([0-5][0-9])$/.test(input);
                $(this).toggleClass('is-invalid', !isValid);
            });

            // Set the base URL for your Laravel project here
            const BASE_URL = "{{ url('/') }}";

            // Function to fetch categories based on the selected zone using AJAX
            function fetchCategoriesByZone() {
                const zoneId = $('#zoneSelect').val();

                if (!zoneId) {
                    // If zoneId is null, clear the category select dropdown
                    $('#categorySelect').empty().append('<option disabled selected>Choose...</option>');
                    return;
                }

                $.ajax({
                    url: `${BASE_URL}/api/zones/${zoneId}/categories`,
                    type: 'GET',
                    success: function(categories) {
                        const categorySelect = $('#categorySelect');
                        categorySelect.empty();
                        categorySelect.append('<option disabled selected>Choose...</option>');

                        $.each(categories, function(index, category) {
                            categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Function to fetch providers based on the selected zone using AJAX
            function fetchProvidersByZone() {
                const zoneId = $('#zoneSelect').val();

                if (!zoneId) {
                    // If zoneId is null, clear the provider select dropdown
                    $('#input4').empty().append('<option selected>Choose...</option>');
                    return;
                }

                $.ajax({
                    url: `${BASE_URL}/api/zones/${zoneId}/providers`,
                    type: 'GET',
                    success: function(providers) {
                        const providerSelect = $('#input4');
                        providerSelect.empty();
                        providerSelect.append('<option selected>Choose...</option>');

                        $.each(providers, function(index, provider) {
                            providerSelect.append(`<option value="${provider.id}">${provider.name}</option>`);
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Attach the event listener to the zone select dropdown
            $('#zoneSelect').on('change', function() {
                fetchCategoriesByZone();
                fetchProvidersByZone();
            });

            // Trigger the initial fetch of categories and providers when the page loads
            fetchCategoriesByZone();
            fetchProvidersByZone();
        });
    </script>
    <script>
        // Function to update the subcategory options based on the selected category
        function updateSubcategories() {
            // Get the selected category ID
            const categoryId = $('#categorySelect').val();

            if (!categoryId) {
                // If categoryId is null, clear the subcategory select dropdown
                $('#subcategorySelect').empty().append('<option disabled selected>Open this select menu</option>');
                return;
            }

            // Set the base URL for your Laravel project here
            const BASE_URL = "{{ url('/') }}";

            // Send an AJAX request to fetch the subcategories based on the selected category
            $.ajax({
                url: `${BASE_URL}/api/categories/${categoryId}/subcategories`,
                type: 'GET',
                success: function(subcategories) {
                    const subcategorySelect = $('#subcategorySelect');
                    subcategorySelect.empty();
                    subcategorySelect.append('<option disabled selected>Open this select menu</option>');

                    $.each(subcategories, function(index, subcategory) {
                        subcategorySelect.append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        // Attach the event listener to the category select dropdown
        $('#categorySelect').on('change', function() {
            updateSubcategories();
        });

        // Trigger the initial update of subcategories when the page loads
        updateSubcategories();
    </script>
    <script>

        function submitForm() {
            const BASE_URL = "{{ url('/') }}";
            const form = document.getElementById('categoryForm');

            // Perform AJAX form submission
            $.ajax({
                url: form.getAttribute('action'),
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function resetForm() {
            document.getElementById("categoryForm").reset();
        }
    </script>
    <script>

        var map;
        var marker;

        function initialize() {
            // Check if geolocation is available
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var myOptions = {
                        zoom: 13,
                        center: userLatlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById("map"), myOptions);

                    // Create a marker for the user's current location
                    marker = new google.maps.Marker({
                        map: map,
                        position: userLatlng,
                        draggable: true // Allow marker to be moved
                    });

                    // Create a search box for location search
                    const input = document.getElementById("pac-input");
                    const searchBox = new google.maps.places.SearchBox(input);
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                    // Listen for the place selected event
                    searchBox.addListener("places_changed", function() {
                        const places = searchBox.getPlaces();

                        if (places.length == 0) {
                            return;
                        }

                        // Get the first place and set the marker position
                        const place = places[0];
                        marker.setPosition(place.geometry.location);

                        // Get the latitude and longitude
                        const latitude = place.geometry.location.lat();
                        const longitude = place.geometry.location.lng();

                        // Update hidden input fields with latitude and longitude
                        document.getElementById("latitude").value = latitude;
                        document.getElementById("longitude").value = longitude;

                        // Center the map on the selected location
                        map.setCenter(place.geometry.location);
                    });

                    // Listen for marker dragend event
                    marker.addListener("dragend", function(event) {
                        const latitude = event.latLng.lat();
                        const longitude = event.latLng.lng();

                        // Update hidden input fields with latitude and longitude
                        document.getElementById("latitude").value = latitude;
                        document.getElementById("longitude").value = longitude;
                    });
                }, function(error) {
                    // Handle geolocation error, ask for permission here
                    if (error.code === 1) {
                        alert("Please allow access to your location to use this feature.");
                    }
                });
            } else {
                // Geolocation is not available, set a default location
                var defaultLatlng = { lat: 23.8103, lng: 90.4125 }; // Replace with your desired default coordinates

                var myOptions = {
                    zoom: 13,
                    center: defaultLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map"), myOptions);
            }
        }

        // Load the Google Maps API with your API key and callback
        function loadMapScript() {
            const script = document.createElement("script");
            script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCc9NIB-ScnkTvQZzrB53TfaCwo1XUegHM&callback=initialize&libraries=places";
            script.defer = true;
            document.head.appendChild(script);
        }

        // Call the loadMapScript function to load the map
        loadMapScript();
    </script>


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
            opacity: 0; /* Start with 0 opacity */
            transition: opacity 0.3s ease; /* Add a transition effect for opacity */
        }

        .confirmation-popup.show {
            display: block; /* Show the pop-up */
            opacity: 1; /* Make it fully opaque when visible */
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
