<div class="tf-section-2 featured-item style-bottom">
    <div class="themesflat-container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section pb-20">
                    <h2 class="tf-title ">Related services</h2>
                    <a href="explore-3.html" class="">Discover more <i class="icon-arrow-right2"></i></a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="featured pt-10 swiper-container carousel" data-swiper='{
                "loop":false,
                "slidesPerView": 1,
                "observer": true,
                "observeParents": true,
                "spaceBetween": 30,
                "navigation": {
                    "clickable": true,
                    "nextEl": ".slider-next",
                    "prevEl": ".slider-prev"
                },
                "pagination": {
                    "el": ".swiper-pagination",
                    "clickable": true
                },
                "breakpoints": {
                    "768": {
                        "slidesPerView": 2,
                        "spaceBetween": 30
                    },
                    "1024": {
                        "slidesPerView": 3,
                        "spaceBetween": 30
                    },
                    "1300": {
                        "slidesPerView": 4,
                        "spaceBetween": 30
                    }
                }
            }'>
                    <div class="swiper-wrapper">
                        @foreach ($services as $service)
                        <div class="swiper-slide">
                            <div class="tf-card-box style-1">
                                <div class="card-media">
                                    <a href="/service/{{ $service->slug }}">
                                        <img src="{{ optional($service->images->first())->path }}" alt="">
                                    </a>
                                    <div class="featured-countdown">
                                        <span class="js-countdown" data-timer="7500" data-labels="d,h,m,s"></span>
                                    </div>
                                    <div class="button-place-bid">
                                        <a href="/service/{{ $service->slug }}"
                                            class="tf-button"><span>Place Bid</span></a>
                                    </div>
                                </div>
                                <h5 class="name"><a href="/service/{{ $service->slug }}">{{ $service->title }}</a></h5>
                                <div class="author flex items-center">
                                    <div class="info">
                                        <span>Posted by:</span>
                                        <h6><a href="author-2.html">{{ $service->customer->name }}</a> </h6>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="meta-info flex items-center justify-between">
                                    <span class="text-bid">Current Bid</span>
                                    <h6 class="price gem">{{ $service->price }}{{ $service->currency == "usd" ? "$" : $service->currency }}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="slider-next swiper-button-next"></div>
                    <div class="slider-prev swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>