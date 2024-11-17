<div class="modal fade popup" id="popup_bid" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <h4>What is the full amount you’d like to bid for this job?</h4>
                <div class="row mt-40">
                    <div class="col">
                        <p style="margin: 0;text-align: left;">Total amount the client will seen on your proposal</p>
                        <span style="font-size: 15px;position: relative;top: 20px;">10% Service fee </span>
                    </div>
                    <div class="col">
                        <input type="text" class="style-1" id="Bid" placeholder="Bid" name="Bid"
                            tabindex="2" value="{{ $service->currency == 'usd' ? "$" : 'AED' }}{{ $service->price }}"
                            aria-required="true" readonly>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col">
                        <p style="margin: 0;text-align: left;">Total amount the client will seen on your proposal {{ $service->price }}</p>
                    </div>
                    <div class="col">
                        <input type="number" class="style-1" wire:model="amount" placeholder="price"
                            value="100" min="1" max="{{ $service->price }}">
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col">
                        <label style="font-size: 15px;">Additional detalis *</label>
                        <textarea wire:model="message" id="message" name="message" rows="4" placeholder="Type here..."
                            tabindex="2" aria-required="true" required="" style="background: #232323;margin-top: 9px;"></textarea>
                    </div>
                </div>
                <button wire:click="submitBid" class="tf-button style-1 h50 w-100 mt-30" style="color: black">Submit<i
                        class="icon-arrow-up-right2"></i></button>
            </div>
        </div>
    </div>
</div>
