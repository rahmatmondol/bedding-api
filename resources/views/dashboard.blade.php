<x-app-layout>
    <livewire:service.service-list page="all"/>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Echo
            window.Pusher = require('pusher-js');
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: 'your-app-key', // Your Pusher app key
                cluster: 'your-app-cluster', // Your Pusher cluster
                forceTLS: true
            });

            // Listen for the NewBidNotification
            window.Echo.channel('your-channel-name')
                .listen('NewBidNotification', (e) => {
                    console.log(e); // Log the event for debugging
                    // Display the notification
                    document.getElementById('notifications').innerHTML += `<p>${e.message}</p>`;
                });
        });
    </script>
</x-app-layout>
