@component('mail::message')
    # Account Deletion Notification

    An account has been deleted from the Dirham App platform.

    ## Deletion Details:

    **User ID:** {{ $deletionInfo['user_id'] }}
    **Name:** {{ $deletionInfo['name'] }}
    **Email:** {{ $deletionInfo['email'] }}
    **Deletion Date:** {{ $deletionInfo['deleted_at'] }}

    ## Reason for Deletion:
    {{ $deletionInfo['reason'] }}

    ## User Feedback:
    {{ $deletionInfo['feedback'] }}

    This information has been logged in the system for record-keeping purposes.

    @component('mail::button', ['url' => config('app.url') . '/admin/deleted-accounts'])
        View Deleted Accounts
    @endcomponent

    Regards,<br>
    Dirham App System
@endcomponent
