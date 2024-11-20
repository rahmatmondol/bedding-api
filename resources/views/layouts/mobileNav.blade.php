<div class="mobile-nav-wrap">
    <div class="overlay-mobile-nav"></div>
    <div class="inner-mobile-nav">
        <a href="index.html" rel="home" class="main-logo">
            <img id="mobile-logo_header" src="{{ asset('user') }}/assets/images/logo/logo.png"
                data-retina="{{ asset('user') }}/assets/images/logo/logo.png" style="width: 160px;">
        </a>
        <div class="mobile-nav-close">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="white" x="0px"
                y="0px" width="20px" height="20px" viewBox="0 0 122.878 122.88"
                enable-background="new 0 0 122.878 122.88" xml:space="preserve">
                <g>
                    <path
                        d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z" />
                </g>
            </svg>
        </div>
        <nav id="mobile-main-nav" class="mobile-main-nav">
            <ul id="menu-mobile-menu" class="menu">
                <li class="menu-item">
                    <a href="/" wire:navigate.hover>Home</a>
                </li>
                <li class="menu-item">
                    @auth
                        <a href="{{ route('auth-dashboard') }}" wire:navigate.hover>Dashboard</a>
                    @endauth
                    @guest
                        <a href="{{ route('auth-login') }}" wire:navigate.hover>Login</a>
                    @endguest
                </li>
                <li class="menu-item">
                    <a href="/services" wire:navigate.hover>Services</a>
                </li>
            </ul>
        </nav>
        <div class="widget-search-1 mt-30">
            <form action="#" method="get" role="search" class="search-form relative">
                <input type="search" class="search-field style-1" placeholder="Search..." value="" name="s"
                    title="Search for" required="">
                <button class="search search-submit" type="submit" title="Search">
                    <i class="icon-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>
