<div id="history" class="tabcontent active">
    <div class="wrapper-content">
        <div class="inner-content">
            <div class="heading-section">
                <h2 class="tf-title pb-30">All Bids</h2>
            </div>
            <div class="widget-tabs relative">
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
                                        @if (auth()->user()->hasRole('customer'))
                                            <img src="{{ $bid->customer->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->customer->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @else
                                            <img src="{{ $bid->provider->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->provider->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @endif

                                    </div>
                                    <span class="time">{{ $bid->updated_at->diffForHumans() }}</span>

                                    @if (request()->routeIs('auth-bid-auction-list') && auth()->user()->hasRole('provider'))
                                        <button data-toggle="modal" data-target="#popup_bid-{{ $bid->id }}"
                                            class="btn btn-primary px-5 mx-4">Accept</button>
                                        <button wire:click="rejectbid({{ $bid->id }})"
                                            class="btn btn-danger px-5">Reject</button>
                                    @elseif (auth()->user()->hasRole('customer'))
                                        <button data-toggle="modal" data-target="#popup_bid-{{ $bid->id }}"
                                            class="btn btn-primary px-5 mx-4">Accept</button>
                                        <button wire:click="rejectbid({{ $bid->id }})"
                                            class="btn btn-danger px-5">Reject</button>
                                    @endif

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
                                        @if (auth()->user()->hasRole('customer'))
                                            <img src="{{ $bid->customer->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->customer->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @else
                                            <img src="{{ $bid->provider->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->provider->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @endif
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
                                        @if (auth()->user()->hasRole('customer'))
                                            <img src="{{ $bid->customer->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->customer->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @else
                                            <img src="{{ $bid->provider->profile->image ?? '' }}" alt="">
                                            <div class="info">
                                                <h6><a href="#">{{ $bid->provider->name ?? '' }}</a></h6>
                                                <span><a href="#">{{ $bid->message }}</a></span>
                                            </div>
                                        @endif
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
                                <input type="text" class="style-1" id="Bid" placeholder="Bid" name="Bid"
                                    tabindex="2" value="{{ $bid->service->price }}" aria-required="true" readonly>
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
                                <textarea id="message" name="message" rows="4" tabindex="2"
                                    aria-required="true" readonly style="background: #232323;margin-top: 9px;">{{ $bid->message ?? 'No message' }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button wire:click="rejectbid({{ $bid->id }})" class="tf-button btn-danger style-4 h50 w-100 mt-30">reject</i></button>
                            </div>
                            <div class="col">
                                <button wire:click="acceptbid({{ $bid->id }})"
                                    class="tf-button style-1 h50 w-100 mt-30" style="color: black">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
