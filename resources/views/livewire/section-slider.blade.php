<div class="tf-section-1 featured-item">
    <div class="themesflat-container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section pb-20">
                    <h2 class="tf-title ">{{ $name }}</h2>
                    <a href="explore-3.html" class="">Discover more <i class="icon-arrow-right2"></i></a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="featured pt-10 swiper-container carousel"
                    data-swiper='{
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
                        @forelse ($services as $service)
                            <livewire:service-card :service="$service" key="{{ $service->id }}"/>
                        @empty
                            <div class="widget-creators-item flex items-center">
                                <div class="widget-creators-item text-center">
                                    <h6>No services</h6>
                                </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
