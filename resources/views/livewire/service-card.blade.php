<div class="swiper-slide">
    <div class="tf-card-box style-1">
        <div class="card-media">
            <a href="{{ route('service.details', $service->slug) }}">
                <img src="{{ $service->images()->first()->path }}" alt="">
            </a>
           
            <div class="button-place-bid">
                <a href="{{ route('service.details', $service->slug) }}"
                    class="tf-button"><span>Place Bid</span></a>
            </div>
        </div>
        <h5 class="name"><a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a></h5>
        <div class="author flex items-center">
            <div class="info">
                <span>Posted by:</span>
                <h6>{{ $service->customer->name }}</h6>
            </div>
        </div>
        <div class="divider"></div>
        <div class="meta-info flex items-center justify-between">
            <span class="text-bid">Current Bid</span>
            <h6 class="price gem">{{ $service->currency == "USD" ? "$" : $service->currency }}{{ $service->price }}</h6>
        </div>
    </div>
</div>