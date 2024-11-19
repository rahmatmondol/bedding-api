<div id="history" class="tabcontent active">
    <div class="wrapper-content">
        <div class="inner-content">
            <div class="heading-section">
                <h2 class="tf-title pb-30">All Bookings</h2>
            </div>
            <div class="widget-tabs relative">
                <ul class="widget-menu-tab">
                    <li class="item-title active">
                        <span class="inner">All Bookings</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Accepted</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Completed</span>
                    </li>
                </ul>
                <div class="widget-content-tab pt-10">
                    <div class="widget-content-inner active">
                        <div class="wrap-inner row">
                            @forelse ($bookings as $booking)
                                <div class="col-md-6 col-12">
                                    <article class="tf-card-article">
                                        <div class="meta-info flex">
                                            <div class="item active "><span class="text-bid">Price
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->service->price }}
                                            </div>
                                            <div class="item active"><span class="text-bid">Bid
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->bid->amount }}
                                            </div>
                                            <div class="item date active">{{ $booking->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="card-title">
                                            <h5>
                                                <a href="{{ route('service.details', $booking->service->slug) }}"
                                                    wire:navigate.hover>{{ $booking->service->title }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="widget-tag widget-tag mt-4"
                                            style="display: flex;justify-content: flex-start;align-items: baseline;gap: 10px;">
                                            <span class="text-bid">Skills:</span>
                                            <ul class="flex flex-wrap gap4 items-center">
                                                @foreach ($booking->service->skills as $skill)
                                                    <li><a class="tag px-2 py-1" href="">{{ $skill->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-bottom flex items-center justify-between">
                                            <div class="author flex items-center justify-between">
                                                <div class="avatar">
                                                    <img src="{{ $booking->provider?->profile?->image }}"
                                                        alt="Image">
                                                </div>
                                                <div class="info">
                                                    <span>Provider:</span>
                                                    <h6><a href="{{ route('provider-profile', $booking->provider->id) }}"
                                                            wire:navigate>{{ $booking->provider->name }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                            @if ($booking->status == 'accepted')
                                                <button class="btn btn-primary"
                                                    wire:click="acceptbooking({{ $booking->id }})">Complete
                                                    Service</button>
                                            @elseif($booking->status == 'completed' && !$reviews->pluck('service_id')->contains($booking->service_id))
                                                <button class="btn btn-success" data-toggle="modal"
                                                    data-target="#popup_review">Review now</button>
                                            @endif
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bookings</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                    <div class="widget-content-inner">
                        <div class="wrap-inner row">
                            @forelse ($accepted as $booking)
                                <div class="col-md-6 col-12">
                                    <article class="tf-card-article">
                                        <div class="meta-info flex">
                                            <div class="item active "><span class="text-bid">Price
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->service->price }}
                                            </div>
                                            <div class="item active"><span class="text-bid">Bid
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->bid->amount }}
                                            </div>
                                            <div class="item date active">{{ $booking->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="card-title">
                                            <h5>
                                                <a href="{{ route('service.details', $booking->service->slug) }}"
                                                    wire:navigate.hover>{{ $booking->service->title }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="widget-tag widget-tag mt-4"
                                            style="display: flex;justify-content: flex-start;align-items: baseline;gap: 10px;">
                                            <span class="text-bid">Skills:</span>
                                            <ul class="flex flex-wrap gap4 items-center">
                                                @foreach ($booking->service->skills as $skill)
                                                    <li><a class="tag px-2 py-1" href="">{{ $skill->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-bottom flex items-center justify-between">
                                            <div class="author flex items-center justify-between">
                                                <div class="avatar">
                                                    <img src="{{ $booking->provider?->profile?->image }}"
                                                        alt="Image">
                                                </div>
                                                <div class="info">
                                                    <span>Provider:</span>
                                                    <h6><a href="{{ route('provider-profile', $booking->provider->id) }}"
                                                            wire:navigate>{{ $booking->provider->name }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                            @if ($booking->status == 'accepted')
                                                <button class="btn btn-primary"
                                                    wire:click="acceptbooking({{ $booking->id }})">Complete
                                                    Service</button>
                                            @elseif($booking->status == 'completed' && !$reviews->pluck('service_id')->contains($booking->service_id))
                                                <button class="btn btn-success" data-toggle="modal"
                                                    data-target="#popup_review">Review now</button>
                                            @endif
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bookings</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="widget-content-inner">
                        <div class="wrap-inner row">
                            @forelse ($completed as $booking)
                                <div class="col-md-6 col-12">
                                    <article class="tf-card-article">
                                        <div class="meta-info flex">
                                            <div class="item active "><span class="text-bid">Price
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->service->price }}
                                            </div>
                                            <div class="item active"><span class="text-bid">Bid
                                                </span>{{ $booking->service->currency == 'USD' ? "$" : $booking->service->currency }}{{ $booking->bid->amount }}
                                            </div>
                                            <div class="item date active">{{ $booking->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="card-title">
                                            <h5>
                                                <a href="{{ route('service.details', $booking->service->slug) }}"
                                                    wire:navigate.hover>{{ $booking->service->title }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="widget-tag widget-tag mt-4"
                                            style="display: flex;justify-content: flex-start;align-items: baseline;gap: 10px;">
                                            <span class="text-bid">Skills:</span>
                                            <ul class="flex flex-wrap gap4 items-center">
                                                @foreach ($booking->service->skills as $skill)
                                                    <li><a class="tag px-2 py-1" href="">{{ $skill->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="card-bottom flex items-center justify-between">
                                            <div class="author flex items-center justify-between">
                                                <div class="avatar">
                                                    <img src="{{ $booking->provider?->profile?->image }}"
                                                        alt="Image">
                                                </div>
                                                <div class="info">
                                                    <span>Provider:</span>
                                                    <h6><a href="{{ route('provider-profile', $booking->provider->id) }}"
                                                            wire:navigate>{{ $booking->provider->name }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                            @if ($booking->status == 'accepted')
                                                <button class="btn btn-primary"
                                                    wire:click="acceptbooking({{ $booking->id }})">Complete
                                                    Service</button>
                                            @elseif($booking->status == 'completed' && !$reviews->pluck('service_id')->contains($booking->service_id))
                                                <button class="btn btn-success" data-toggle="modal"
                                                    data-target="#popup_review">Review now</button>
                                            @endif
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bookings</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade popup" id="popup_review" tabindex="-1" role="dialog" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <h4 class="text-center">Give Review</h4>
                    <p class="text-center mt-4">How was your experience with this provider?</p>
                    <div class="row mt-4">
                        <div class="col">
                            <select wire:model="rating" id="review_stars" class="form-control" tabindex="2"
                                aria-required="true">
                                <option value="1">1 star</option>
                                <option value="2">2 stars</option>
                                <option value="3">3 stars</option>
                                <option value="4">4 stars</option>
                                <option value="5">5 stars</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <textarea wire:model="comment" id="message" name="message" rows="4" placeholder="Type your review here..."
                                tabindex="2" aria-required="true" class="form-control" style="background: #232323; color: #fff;"></textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col">
                            <button wire:click="makereview({{ $booking->id }})" type="button"
                                class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
