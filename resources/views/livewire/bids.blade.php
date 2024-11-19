<div id="history" class="tabcontent active">
    <div class="wrapper-content">
        <div class="inner-content">
            <div class="heading-section">
                <h2 class="tf-title pb-30">All Bids</h2>
            </div>
            <div class="widget-tabs relative">
                <div class="tf-soft">
                    <div class="soft-right">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.125 5.625H16.875M3.125 10H16.875M3.125 14.375H10" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span>Sort by: 7 Day</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <h6>Sort by</h6>
                                <a href="#" class="dropdown-item">
                                    <div class="sort-filter" href="#">
                                        <span>1 Day</span>
                                        <span class="icon-tick"><span class="path2"></span></span>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="sort-filter active" href="#">
                                        <span>7 Day</span>
                                        <span class="icon-tick"><span class="path2"></span></span>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="sort-filter" href="#">
                                        <span>1 Month</span>
                                        <span class="icon-tick"><span class="path2"></span></span>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="sort-filter" href="#">
                                        <span>1 Year</span>
                                        <span class="icon-tick"><span class="path2"></span></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="widget-menu-tab">
                    <li class="item-title active">
                        <span class="inner">Pending</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Accepted</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Rejected</span>
                    </li>
                </ul>
                <div class="widget-content-tab pt-10">
                    <div class="widget-content-inner active">
                        <div class="widget-history">
                            @forelse ($pending as $bid)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <img src="{{ $bid->provider->profile->image }}" alt="">
                                        <div class="info">
                                            <h6><a href="#">{{ $bid->provider->name }}</a></h6>
                                            <span><a href="#">{{ $bid->message }}</a></span>
                                        </div>
                                    </div>
                                    <span class="time">{{ $bid->updated_at->diffForHumans() }}</span>
                                    <button data-toggle="modal" data-target="#popup_bid-{{ $bid->id }}"
                                        class="btn btn-primary px-5 mx-4">Accept</button>
                                    <button wire:click="rejectbid({{ $bid->id }})"
                                        class="btn btn-danger px-5">Reject</button>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bids</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="widget-content-inner">
                        <div class="widget-history">
                            @forelse ($accepted as $bid)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <img src="{{ $bid->provider->profile->image }}" alt="">
                                        <div class="info">
                                            <h6><a href="#">{{ $bid->provider->name }}</a></h6>
                                            <span><a href="#">{{ $bid->message }}</a></span>
                                        </div>
                                    </div>
                                    <span class="time">{{ $bid->updated_at->diffForHumans() }}</span>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bids</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="widget-content-inner">
                        <div class="widget-history">
                            @forelse ($rejected as $bid)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <img src="{{ $bid->provider->profile->image }}" alt="">
                                        <div class="info">
                                            <h6><a href="#">{{ $bid->provider->name }}</a></h6>
                                            <span><a href="#">{{ $bid->message }}</a></span>
                                        </div>
                                    </div>
                                    <span class="time">{{ $bid->updated_at->diffForHumans() }}</span>

                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No bids</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @foreach ($pending as $bid)
        <div class="modal fade popup" id="popup_bid-{{ $bid->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <h4 class="text-center">Getting ready at your service</h4>
                        <p class="text-center mt-4">See your service has been added on the booking page.</p>
                        <div class="row mt-40">
                            <div class="col">
                                <p style="margin: 0;text-align: left;">The amount you set</p>
                                <span style="font-size: 15px;position: relative;top: 20px;">10% Service fee </span>
                            </div>
                            <div class="col">
                                <input type="text" class="style-1" id="Bid" placeholder="Bid"
                                    name="Bid" tabindex="2" value="{{ $bid->service->price }}" aria-required="true" readonly>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col">
                                <p style="margin: 0;text-align: left;">The amount provider ask</p>
                            </div>
                            <div class="col">
                                <input type="text" class="style-1" wire:model="amount" placeholder="price"
                                    value="{{ $bid->amount }}" min="1" max="" readonly>
                            </div>
                        </div>
                        <div class="row mt-40">
                            <div class="col">
                                <label style="font-size: 15px;">Additional Massage *</label>
                                <textarea  id="message" name="message" rows="4" placeholder="Type here..."
                                    tabindex="2" aria-required="true" readonly style="background: #232323;margin-top: 9px;">{{ $bid->message }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="tf-button btn-danger style-4 h50 w-100 mt-30">Cancel</i></button>
                            </div>
                            <div class="col">
                                <button wire:click="acceptbid({{ $bid->id }})" class="tf-button style-1 h50 w-100 mt-30"
                                    style="color: black">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
