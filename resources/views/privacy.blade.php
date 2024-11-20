<x-guest-layout>
    <div class="flat-title-page">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 class="heading text-center">Privacy policy</h1>
                    <ul class="breadcrumbs flex justify-center">
                        <li class="icon-keyboard_arrow_right">
                            <a href="{{ route('home') }}" wire:navigate>Home</a>
                        </li>
                        <li class="disabled">
                            <a class="disabled" href="" wire:navigate>privacy policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="tf-section-2 widget-term-condition">
        <div class="themesflat-container">
            <div class="row flat-tabs">
                <div class="col-md-12 col-12">
                    <div class="content-tab po-sticky-footer">
                        <div class="content-inner active" style="">
                          {!! $content->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>