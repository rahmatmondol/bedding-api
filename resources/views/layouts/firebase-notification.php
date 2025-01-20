<div class="notification">
    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
            d="M12 18.8476C17.6392 18.8476 20.2481 18.1242 20.5 15.2205C20.5 12.3188 18.6812 12.5054 18.6812 8.94511C18.6812 6.16414 16.0452 3 12 3C7.95477 3 5.31885 6.16414 5.31885 8.94511C5.31885 12.5054 3.5 12.3188 3.5 15.2205C3.75295 18.1352 6.36177 18.8476 12 18.8476Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M14.3888 21.8574C13.0247 23.3721 10.8967 23.3901 9.51947 21.8574" stroke="white" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" />
        <circle class="notification-circle" style="visibility: hidden;" cx="17" cy="5" r="4" fill="#DDF247"
            stroke="#1D1D1D" stroke-width="1.5" />
    </svg>
</div>

<div class="avatar_popup">
    <h5 class="mb-30"><span id="notification_count"></span> Notification </h5>
    <div class="widget-recently">
    </div>
</div>

<script>
    // Function to read data
    function readData() {
        const user_id = '<?php echo auth()->user()->id; ?>'
        database.ref(`notifications/user_${user_id}`).on('value', (snapshot) => {
            const data = snapshot.val();
            let notifications = '';
            let count = '';
            if (data) {
                Object.entries(data).forEach(([key, value]) => {
                    if (!value.status) {
                        count++;
                        notifications += `
                            <div class="card-small">
                                <div class="author">
                                    <div class="info">
                                        <p><a href="#">${value.message}</a></p>
                                    </div>
                                </div>
                                <span class="date">${new Date(value.created_at).toLocaleString()}</span>
                            </div>
                        `
                    }
                    // console.log(value.massage);
                });
            }
            if (count == 0) {
                notifications = `<div class="card-small">
                    <div class="author">
                        <div class="info">
                            <p><a href="#">No Notification</a></p>
                        </div>
                    </div>
                </div>`
                $('.notification-circle').css('visibility', 'hidden');
            } else {
                $('#notification_count').text(count);
                $('.notification-circle').css('visibility', 'visible');
            }
            $('.widget-recently').html(notifications);

        }).catch((error) => {
            console.error('Error reading data: ' + error);
        });
    }
    readData()
</script>