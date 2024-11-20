<header id="header_main" class="header_1 header-fixed header-full">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="site-header-inner">
                    <div class="wrap-box flex">

                        <div id="site-logo">
                            <div id="site-logo-inner">
                                <a href="/" wire:navigate rel="home" class="main-logo">
                                    <img id="logo_header" src="{{asset('user/assets/images/logo/logo.png')}}"
                                        data-retina="{{asset('user/assets/images/logo/logo.png')}}" style="width: 160px;">
                                </a>
                            </div>
                        </div><!-- logo -->

                        <div class="mobile-button">
                            <span></span>
                        </div><!-- /.mobile-button -->

                        @include('layouts.mainNav')

                        <div class="flat-wallet flex">
                            <div class="header-search hidden relative">
                                <a href="#" class="show-search">
                                    <i class="icon-search"></i>
                                </a>
                                <div class="top-search">
                                    <form action="#" method="get" role="search" class="search-form relative">
                                        <input type="search" id="search" class="search-field style-1"
                                            placeholder="Search..." value="" name="s" title="Search for"
                                            required="">
                                        <button class="search search-submit" type="submit" title="Search">
                                            <i class="icon-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="widget-search">
                                <form action="#" method="get" role="search" class="search-form relative">
                                    <input type="search" id="search" class="search-field"
                                        placeholder="Search By Keywork..." value="" name="s"
                                        title="Search for" required="">
                                    <button class="search search-submit" type="submit" title="Search">
                                        <i class="icon-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('layouts.canvas') --}}
    @include('layouts.mobileNav')
</header>