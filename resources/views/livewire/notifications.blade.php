<div class="avatar_popup">
    <h5 class="mb-30">{{ count($notifications) }} Notification </h5>
    <div class="widget-recently">
        @foreach ($notifications as $notification)
            <div class="card-small">
                <div class="author">
                    <div class="info">
                        <h6><a href="#">{{ $notification->user }}</a></h6>
                        <p><a href="#">{{ $notification->data['message'] }}</a></p>
                    </div>
                </div>
                <span class="date">{{ $notification->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>
</div>
