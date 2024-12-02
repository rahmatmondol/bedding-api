<div>
    <div class="tf-section-2 product-detail">
        <div class="themesflat-container">

            <div class="row">
                <div class="col-md-6">
                    <div data-wow-delay="0s" class="wow fadeInLeft tf-card-box style-5">
                        <div class="card-media mb-0">
                            @foreach ($service->images as $image)
                                <a href="#">
                                    <img src="{{ $image->path }}" alt="">
                                </a>
                            @endforeach
                        </div>
                        <div wire:click="toggleWishlist"
                            class="wishlist-button @if ($hasWishlist) active @endif">
                            {{ $wishlistCount }}<i class="icon-heart"></i></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div data-wow-delay="0s" class="wow fadeInRight infor-product">
                        <div class="text">{{ $service->category->name }} <span class="icon-tick"><span
                                    class="path1"></span><span class="path2"></span></span></div>

                        <h2>{{ $service->title }}</h2>

                        <div class="author flex items-center mb-30">
                            <div class="info">
                                <span>Owned by:</span>
                                <h6><a href="author-1.html">{{ $service->customer->name ?? '' }}</a> </h6>
                            </div>
                        </div>
                    </div>
                    <div data-wow-delay="0s" class="wow fadeInRight product-item time-sales">
                        <h6><i class="icon-clock"></i>Sale ends May 22 at 9:39</h6>
                        <div class="content">
                            <div class="text">Current price</div>
                            <div class="flex justify-between">
                                <p>{{ $service->currency == 'usd' ? "$" : $service->currency }}{{ $service->price }}</p>
                                @if (auth()->check() && auth()->user()->hasRole('provider'))
                                    @if (auth()->user()->id !== $service->user_id)
                                        <a href="#" data-toggle="modal" data-target="#popup_bid"
                                            class="tf-button style-1 h50 w216">Place a bid<i
                                                class="icon-arrow-up-right2"></i></a>
                                    @endif
                                @elseif (auth()->check() && auth()->user()->hasRole('customer'))
                                    @if (auth()->user()->id !== $service->user_id)
                                        <a href="#" data-toggle="modal" data-target="#popup_bid"
                                            class="tf-button style-1 h50 w216">Place a bid<i
                                                class="icon-arrow-up-right2"></i></a>
                                    @endif
                                @else
                                    <a href="{{ route('auth-login') }}" wire:navigate
                                        class="tf-button style-1 h50 w216">Login to bid<i
                                            class="icon-arrow-up-right2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div data-wow-delay="0s" class="wow fadeInRight product-item description">
                        <h6><i class="icon-description"></i>Description</h6>
                        <i class="icon-keyboard_arrow_down"></i>
                        <div class="content" style="font-size: 16px;">
                            {!! $service->description !!}
                        </div>
                    </div>
                    <div data-wow-delay="0s" class="wow fadeInRight product-item description">
                        <h6><i class="icon-description"></i>Address</h6>
                        <i class="icon-keyboard_arrow_down"></i>
                        <div class="content" style="font-size: 16px;">
                            <p> {{ $service->location }}</p>
                        </div>
                    </div>
                </div>

                <div data-wow-delay="0s" class="wow fadeInUp col-12">
                    <div data-wow-delay="0s" class="wow fadeInRight product-item details">
                        <div id="map" style="height: 400px;width: 100%"></div>
                    </div>
                    <livewire:service.show-bids :service_id="$service->id">
                </div>

            </div>
        </div>
    </div>

    <livewire:releted-services-slider :categoryId="$service->category_id" />
    <livewire:service.bid-popup :service="$service" />

</div>



<script>
    var map;
    var marker;
    var initialCenter = {
        lat: {{ $service->latitude }},
        lng: {{ $service->longitude }}
    };

    function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialCenter,
            zoom: 16,
            mapTypeId: 'roadmap',
            clickableIcons: false
        });

        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);


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
                draggable: false
            });
        }
    }

    // function updateAddress(latLng) {
    //     document.getElementById('latitude').value = latLng.lat();
    //     document.getElementById('longitude').value = latLng.lng();
    //     var geocoder = new google.maps.Geocoder();
    //     geocoder.geocode({
    //         'location': latLng
    //     }, function(results, status) {
    //         if (status === 'OK' && results[0]) {
    //             document.getElementById('location-name').value = results[0].formatted_address;
    //             document.getElementById('pac-input').value = results[0].formatted_address;
    //         }
    //     });
    // }

    // Calculate Distance
    // function calculateDistance(lat1, lon1, lat2, lon2, elementId) {
    //     var R = 3959; // Radius of Earth in miles
    //     var dLat = (lat2 - lat1) * Math.PI / 180;
    //     var dLon = (lon2 - lon1) * Math.PI / 180;
    //     lat1 = lat1 * Math.PI / 180;
    //     lat2 = lat2 * Math.PI / 180;

    //     var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    //             Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
    //     var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    //     var distance = R * c;

    //     document.getElementById(elementId).innerHTML = distance.toFixed(2) + ' miles';
    // }



    // Example usage of calculateDistance function
    // calculateDistance(initialCenter.lat, initialCenter.lng, 40.7128, -74.0060, 'distance'); // Replace with your target coordinates
</script>

<!-- Include Google Maps API -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCc9NIB-ScnkTvQZzrB53TfaCwo1XUegHM&libraries=places,geometry&callback=initAutocomplete"
    async defer></script>
