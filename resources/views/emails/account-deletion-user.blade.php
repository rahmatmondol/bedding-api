@component('mail::message')
    # Account Deletion Confirmation

    Dear {{ $userName }},

    We're sorry to see you go. This email confirms that your Dirham App account has been successfully deleted as requested.

    **Deletion completed on:** {{ $deletionDate }}

    All your personal data and account information have been removed from our system according to our privacy policy. If you
    have any pending transactions or services, they have been canceled.

    If you did not request this deletion or believe this was done in error, please contact our support team immediately at
    [{{ $supportEmail }}](mailto:{{ $supportEmail }}).

    Should you wish to use our services again in the future, you're always welcome to create a new account.

    Thank you for being a part of Dirham App. We appreciate the time you spent with us.

    @component('mail::button', ['url' => config('app.url')])
        Return to Dirham App
    @endcomponent

    Best regards,<br>
    The Dirham App Team

    @component('mail::subcopy')
        If you have any questions or concerns, please contact our support team at {{ $supportEmail }}.
    @endcomponent
@endcomponent
