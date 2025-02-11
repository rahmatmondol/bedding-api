<x-app-layout>
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
                            <div class="widget-history" id="all-notifications">
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="widget-history" id="unread-notifications">
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <div class="widget-history" id="read-notifications">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </div>

    <script>
        // Function to read data
        function readData() {
            const user_id = '<?php echo auth()->user()->id; ?>'
            database.ref(`notifications/user_${user_id}`).on('value', (snapshot) => {
                const data = snapshot.val();
                let all_notifications = '';
                let unread_notifications = '';
                let read_notifications = '';
                let no_notifications = `<div class="widget-creators-item flex items-center">
                                            <div class="widget-creators-item text-center">
                                            <h6>No Notifications</h6>
                                        </div>
                                    </div>`
                if (data) {
                    Object.entries(data).forEach(([key, value]) => {
                        all_notifications += `
                                    <div class="widget-creators-item flex items-center">
                                        <div class="author flex items-center flex-grow">
                                            <img src="${value.data?.avatar}" alt="avatar">
                                            <div class="info">
                                                <h6>${value.data.message}</h6>
                                                <span>${value.data.details}</span>
                                            </div>
                                        </div>
                                        <span class="time">${new Date(value.created_at).toLocaleString()}</span>
                                        <a class="btn btn-primary px-5 mx-4" href="/auth/notification?key=${key}&url=${value.data.url}">view</a>
                                    </div>`;

                        if (value.read_at) {
                            read_notifications += `
                                   <div class="widget-creators-item flex items-center">
                                        <div class="author flex items-center flex-grow">
                                            <img src="${value.data?.avatar}" alt="avatar">
                                            <div class="info">
                                                <h6>${value.data.message}</h6>
                                                <span>${value.data.details}</span>
                                            </div>
                                        </div>
                                        <span class="time">${new Date(value.created_at).toLocaleString()}</span>
                                        <a class="btn btn-primary px-5 mx-4" href="/auth/notification?key=${key}&url=${value.data.url}">view</a>
                                    </div>`;
                        }
                        if (value.read_at == false) {
                            unread_notifications += `
                                <div class="widget-creators-item flex items-center">
                                        <div class="author flex items-center flex-grow">
                                            <img src="${value.data?.avatar}" alt="avatar">
                                            <div class="info">
                                                <h6>${value.data.message}</h6>
                                                <span>${value.data.details}</span>
                                            </div>
                                        </div>
                                        <span class="time">${new Date(value.created_at).toLocaleString()}</span>
                                        <a class="btn btn-primary px-5 mx-4" href="/auth/notification?key=${key}&url=${value.data.url}">view</a>
                                    </div>`;
                        }
                    });
                }

                $('#all-notifications').html(all_notifications ? all_notifications : no_notifications);
                $('#unread-notifications').html(unread_notifications ? unread_notifications :
                    no_notifications);
                $('#read-notifications').html(read_notifications ? read_notifications : no_notifications);
            }).catch((error) => {
                console.error('Error reading data: ' + error);
            });
        }
        readData()
    </script>
</x-app-layout>
