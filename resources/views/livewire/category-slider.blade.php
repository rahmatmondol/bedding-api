<div class="tf-section seller ">
    <div class="themesflat-container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section pb-30">
                    <h2 class="tf-title ">{{ $name }}</h2>
                    <a href="{{ route('services') }}" class="">Discover more <i class="icon-arrow-right2"></i></a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="swiper-container seller seller-slider2"
                    data-swiper='{
                            "loop":false,
                            "slidesPerView": 2,
                            "observer": true,
                            "grabCursor": true,
                            "observeParents": true,
                            "spaceBetween": 30,
                            "navigation": {
                                "clickable": true,
                                "nextEl": ".seller-next",
                                "prevEl": ".seller-prev"
                            },
                            "breakpoints": {
                                "500": {
                                    "slidesPerView": 3
                                },
                                "640": {
                                    "slidesPerView": 4
                                },
                                "768": {
                                    "slidesPerView": 5
                                },
                                "1070": {
                                    "slidesPerView": 6
                                }
                            }
                        }'>
                    <div class="swiper-wrapper">
                        @forelse ($categories as $category)
                            <div class="swiper-slide">
                                <div class="tf-category text-center">
                                    <div class="card-media">
                                        <img src="{{ $category->image }}"
                                            alt="">
                                        <a href="/services?category={{ $category->slug }}"><i class="icon-arrow-up-right2"></i></a>
                                    </div>
                                    <h6>{{ $category->name }}</h6>
                                </div>
                            </div>
                        @empty
                            <div class="widget-creators-item flex items-center">
                                <div class="widget-creators-item text-center">
                                    <h6>No categories</h6>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="swiper-button-next seller-next over active"></div>
                <div class="swiper-button-prev seller-prev over "></div>
            </div>
        </div>
    </div>
</div>
