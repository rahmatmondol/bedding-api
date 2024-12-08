 <nav id="main-nav" class="main-nav">
     <ul id="menu-primary-menu" class="menu">
         <li class="menu-item">
             <a href="/" wire:navigate.hover>Home</a>
         </li>
         <li class="menu-item">
             <a href="/services" wire:navigate.hover>Services</a>
         </li>
         <li class="menu-item">
             <a href="/auctions" wire:navigate.hover>Auction</a>
         </li>
         <li class="menu-item">
            @auth
                <a href="{{ route('auth-dashboard') }}" wire:navigate.hover>Dashboard</a>
            @endauth
            @guest
                <a href="{{ route('auth-login') }}" wire:navigate.hover>Login</a>
            @endguest
        </li>
     </ul>
 </nav><!-- /#main-nav -->
