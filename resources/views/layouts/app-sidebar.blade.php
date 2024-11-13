<div class="section-menu-left">
    <div class="box-logo">
        <a href="/" wire:navigate><img src="{{ asset('user') }}/assets/images/logo/logo.png" alt=""></a>
    </div>
    <ul class="menu-tab">
        <li class="tablinks {{ request()->routeIs('auth-dashboard') ? 'active' : '' }}" data-tabs="market">
            <a href="{{ route('auth-dashboard') }}" wire:navigate>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.2">
                        <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </svg>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                        fill="#DDF247" />
                </svg>
                Dashboard
            </a>
        </li>

    </ul>


    @if (auth()->user()->hasRole('customer') || auth()->user()->hasRole('admin'))
        {{-- manu for customer and admin --}}
        <div class="content">
            <h6>Services</h6>
            <ul class="menu-tab">
                <li class="tablinks {{ request()->routeIs('auth-service-create') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-service-create') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        Create
                    </a>
                </li>
                <li class="tablinks {{ request()->routeIs('auth-services') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-services') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        My services
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <h6>Booking</h6>
            <ul class="menu-tab">
                <li class="tablinks {{ request()->routeIs('auth-service-create') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-service-create') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        willing to work
                    </a>
                </li>
                <li class="tablinks {{ request()->routeIs('auth-services') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-services') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                       Accepted
                    </a>
                </li>
                <li class="tablinks {{ request()->routeIs('auth-services') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-services') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                       Completed
                    </a>
                </li>
            </ul>
        </div>
    @endif

    @if (auth()->user()->hasRole('provider') || auth()->user()->hasRole('admin'))
        {{-- manu for provider and admin --}}
        <div class="content">
            <h6>My Booking</h6>
            <ul class="menu-tab">
                <li class="tablinks {{ request()->routeIs('auth-service-list') ? 'active' : '' }}"
                    data-tabs="market">
                    <a href="{{ route('auth-service-list') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        All Service’s
                    </a>
                </li>
                <li class="tablinks {{ request()->routeIs('auth-services') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-services') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        Completed
                    </a>
                </li>
                <li class="tablinks {{ request()->routeIs('auth-services') ? 'active' : '' }}" data-tabs="market">
                    <a href="{{ route('auth-services') }}" wire:navigate>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.2">
                                <path d="M6.75731 9.35159V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.0351 6.34253V15.64" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.2431 12.6746V15.6401" stroke="white" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.2954 1.83334H6.70492C3.71048 1.83334 1.8335 3.95275 1.8335 6.95307V15.0469C1.8335 18.0473 3.70175 20.1667 6.70492 20.1667H15.2954C18.2986 20.1667 20.1668 18.0473 20.1668 15.0469V6.95307C20.1668 3.95275 18.2986 1.83334 15.2954 1.83334Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                        </svg>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.71982 1.83371H15.2806C18.3982 1.83371 20.1582 3.60196 20.1673 6.71954V15.2812C20.1673 18.3979 18.3982 20.167 15.2806 20.167H6.71982C3.60223 20.167 1.83398 18.3979 1.83398 15.2812V6.71954C1.83398 3.60196 3.60223 1.83371 6.71982 1.83371ZM11.0456 16.372C11.4407 16.372 11.7697 16.0787 11.8064 15.6845V6.34371C11.8431 6.05954 11.7065 5.77446 11.459 5.61954C11.2014 5.46371 10.8897 5.46371 10.6432 5.61954C10.3947 5.77446 10.2582 6.05954 10.2847 6.34371V15.6845C10.3315 16.0787 10.6606 16.372 11.0456 16.372ZM15.2628 16.372C15.6478 16.372 15.9769 16.0787 16.0237 15.6845V12.6779C16.0502 12.3836 15.9137 12.1095 15.6652 11.9537C15.4187 11.7979 15.107 11.7979 14.8503 11.9537C14.6019 12.1095 14.4653 12.3836 14.502 12.6779V15.6845C14.5387 16.0787 14.8677 16.372 15.2628 16.372ZM7.534 15.6845C7.49734 16.0787 7.16825 16.372 6.77317 16.372C6.379 16.372 6.049 16.0787 6.01325 15.6845V9.35038C5.98575 9.0653 6.12234 8.78205 6.37075 8.62621C6.61734 8.47038 6.92992 8.47038 7.17742 8.62621C7.424 8.78205 7.56242 9.0653 7.534 9.35038V15.6845Z"
                                fill="#DDF247" />
                        </svg>
                        Accepted
                    </a>
                </li>
                
            </ul>
        </div>
    @endif

    <div class="bottom">
        <p>© 2023 OpeN9</p>
        <p>Made By Themesflat</p>
    </div>
</div>
