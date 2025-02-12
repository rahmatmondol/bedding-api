    <div class="product-item offers">
        <h6><i class="icon-description"></i>Offers</h6>
        <i class="icon-keyboard_arrow_down"></i>
        <div class="content">
            <div class="table-heading">
                <div class="column">Provider Name</div>
                <div class="column">Bidding Price</div>
                <div class="column">Time</div>
            </div>
            @forelse ($bids as $bid)
                <div class="table-item">
                    <div class="column">{{ $bid->provider ? $bid->provider->name : $bid->customer->name  }}</div>
                    <div class="column">{{ $bid->amount }}</div>
                    <div class="column">{{ $bid->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <div class="table-item">
                    <div class="column text-center">
                        <h6 class="price gem">No bids</h6>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
