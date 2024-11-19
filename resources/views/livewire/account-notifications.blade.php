<div id="history" class="tabcontent active">
    <div class="wrapper-content">
        <div class="inner-content">
            <div class="heading-section">
                <h2 class="tf-title pb-30">All Notifications</h2>
            </div>

            <div class="widget-tabs relative">

                <ul class="widget-menu-tab">
                    <li class="item-title active">
                        <span class="inner">All</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Unread</span>
                    </li>
                    <li class="item-title">
                        <span class="inner">Read</span>
                    </li>
                </ul>
                <div class="widget-content-tab pt-10">
                    <div class="widget-content-inner active">
                        <div class="widget-history">
                            @forelse ($notifications as $notification)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <div class="info">
                                            <h6>{{ $notification->data['message'] }}
                                            </h6>
                                        </div>
                                    </div>
                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    <button wire:click="notification_read('{{ $notification->id }}')"
                                        class="btn btn-primary px-5 mx-4" @disabled($notification->read_at)>view</button>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No Notifications</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="widget-content-inner">
                        <div class="widget-history">
                            @forelse ($unread as $notification)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <div class="info">
                                            <h6>{{ $notification->data['message'] }}
                                            </h6>
                                        </div>
                                    </div>
                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    <button wire:click="notification_read('{{ $notification->id }}')"
                                        class="btn btn-primary px-5 mx-4" @disabled($notification->read_at)>view</button>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No Notifications</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="widget-content-inner">
                        <div class="widget-history">
                            @forelse ($read as $notification)
                                <div class="widget-creators-item flex items-center">
                                    <div class="author flex items-center flex-grow">
                                        <div class="info">
                                            <h6>{{ $notification->data['message'] }}
                                            </h6>
                                        </div>
                                    </div>
                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                    <button wire:click="notification_read('{{ $notification->id }}')"
                                        class="btn btn-primary px-5 mx-4" @disabled($notification->read_at)>view</button>
                                </div>
                            @empty
                                <div class="widget-creators-item flex items-center">
                                    <div class="widget-creators-item text-center">
                                        <h6>No Notifications</h6>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog" aria-hidden="true">
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
                                tabindex="2" value="" aria-required="true" readonly>
                        </div>
                    </div>
                    <div class="row mt-40">
                        <div class="col">
                            <p style="margin: 0;text-align: left;">The amount provider ask</p>
                        </div>
                        <div class="col">
                            <input type="text" class="style-1" wire:model="amount" placeholder="price" value=""
                                min="1" max="" readonly>
                        </div>
                    </div>
                    <div class="row mt-40">
                        <div class="col">
                            <label style="font-size: 15px;">Additional Massage *</label>
                            <textarea id="message" name="message" rows="4" placeholder="Type here..." tabindex="2" aria-required="true"
                                readonly style="background: #232323;margin-top: 9px;"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="tf-button btn-danger style-4 h50 w-100 mt-30">Cancel</i></button>
                        </div>
                        <div class="col">
                            <button wire:click="acceptbid()" class="tf-button style-1 h50 w-100 mt-30"
                                style="color: black">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
