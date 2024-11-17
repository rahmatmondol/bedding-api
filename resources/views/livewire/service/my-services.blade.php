<div id="market" class="tabcontent active">
    <div class="wrapper-content">
        <div class="inner-content mw-100">
            <div class="row">
                <div class="col">
                    <div class="tf-soft">
                        <div class="soft-left" style="justify-content: left;">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.125 5.625H16.875M3.125 10H16.875M3.125 14.375H10" stroke="white"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>Sort by: Category</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <h6>Sort by</h6>
                                    @foreach ($categories as $category)
                                        <a href="#" wire:click="filter({{ $category->id }})"
                                            class="dropdown-item">
                                            <div class="sort-filter">
                                                <span>{{ $category->name }}</span>
                                                <span class="icon-tick"><span class="path2"></span></span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="wrap-box-card">
                        @foreach ($services['data'] as $service)
                            <div class="col-item" wire:key="{{ $service['id'] }}">
                                <div class="tf-card-box style-1">
                                    <div class="card-media">
                                        <a href="{{ route('service.details', $service['id']) }}" wire:navigate>
                                            <img src="{{ $service['image'] }}" alt="" style="width: 100%;">
                                        </a>
                                        <div class="button-place-bid">
                                            <a href="{{ route('service.details', $service['id']) }}" wire:navigate
                                                class="tf-button mb-2"><span>See Details</span></a>
                                                <a href="{{ route('auth-service-edit', $service['id']) }}" wire:navigate
                                                class="tf-button mb-2"><span>Edit</span></a>
                                        </div>

                                    </div>
                                    <h5 class="name"><a href="{{ route('service.details', $service['id']) }}"
                                            wire:navigate>{{ $service['name'] }}</a></h5>

                                    <div class="divider"></div>
                                    <div class="meta-info flex items-center justify-between">
                                        <span class="text-bid">Current Bid</span>
                                        <h6 class="price gem">
                                            {{ $service['currency'] == 'usd' ? '$' : $service['currency'] }}{{ $service['price'] }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row pb-40">

                <div class="col-12">
                    <div class="widget-pagination">
                        @if ($services['total'] > 8)
                            <ul class="justify-center">
                                @foreach ($services['links'] as $link)
                                    <li class="{{ $link['active'] ? 'active' : '' }}">
                                        <a href="{{ $link['url'] }}" wire:navigate>
                                            @if ($link['label'] === '&laquo; Previous')
                                                <i class="icon-keyboard_arrow_left"></i>
                                            @elseif ($link['label'] === 'Next &raquo;')
                                                <i class="icon-keyboard_arrow_right"></i>
                                            @else
                                                {!! $link['label'] !!}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
