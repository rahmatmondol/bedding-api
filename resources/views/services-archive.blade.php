<x-guest-layout>
    <div class="tf-section artwork">
        <div class="themesflat-container">
            <div class="row">
                <div class="page-title no-result mb-30">
                    <div class="themesflat-container">
                        <div class="row">
                            <div class="col-12">
                                <h1 id="main-heading" data-wow-delay="0s" class="wow fadeInUp heading text-center animated"
                                    style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">All
                                    Services
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="wrap-checkbox-left po-sticky type1">
                        {{-- filter by status --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Status</h5>
                            <div class="content-wg-category-checkbox">
                                <label>Featured
                                    <input type="checkbox" class="filter" data-text="featured" name="featured"
                                        value="1">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                                <label>Regular
                                    <input type="checkbox" class="filter" data-text="Regular" name="featured"
                                        value="0">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                            </div>
                        </div>


                        {{-- filter by category --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Filter by category </h5>
                            <div class="content-wg-category-checkbox" style="max-height: 400px;overflow: auto;">
                                @foreach ($categories as $category)
                                    <label for="cat-{{ $category->id }}">{{ $category->name }}
                                        <input id="cat-{{ $category->id }}" data-text="Category:{{ $category->name }}"
                                            type="checkbox" value="{{ $category->id }}" name="category_id"
                                            class="filter">
                                        <span class="btn-checkbox"></span>
                                    </label><br>
                                @endforeach
                            </div>
                        </div>

                        {{-- filter by Sub category --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Filter by Sub category</h5>
                            <div class="content-wg-category-checkbox" style="max-height: 400px;overflow: auto;">
                                @foreach ($subcategories as $category)
                                    <label for="sub-cat-{{ $category->id }}">{{ $category->name }}
                                        <input id="sub-cat-{{ $category->id }}" type="checkbox"
                                            value="{{ $category->id }}" data-text="Subcategory:{{ $category->name }}"
                                            name="subcategory_id" class="filter">
                                        <span class="btn-checkbox"></span>
                                    </label><br>
                                @endforeach
                            </div>
                        </div>

                        {{-- filter by currency --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Filter by currency</h5>
                            <div class="content-wg-category-checkbox">
                                <label>USD
                                    <input type="checkbox" class="filter" data-text="currency:USD" name="currency"
                                        value="USD">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                                <label>AED
                                    <input type="checkbox" class="filter" data-text="currency:AED" name="currency"
                                        value="AED">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                            </div>
                        </div>

                        {{-- filter by skills --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Filter by skills</h5>
                            <div class="content-wg-category-checkbox" style="max-height: 400px;overflow: auto;">
                                @foreach ($skills as $skill)
                                    <label>{{ $skill->name }}
                                        <input type="checkbox" data-text="skill:{{ $skill->name }}" class="filter"
                                            name="skills" value="{{ $skill->id }}">
                                        <span class="btn-checkbox"></span>
                                    </label><br>
                                @endforeach

                            </div>
                        </div>

                        {{-- filter by experience --}}
                        <div class="widget-category-checkbox mb-30">
                            <h5>Filter by Level</h5>
                            <div class="content-wg-category-checkbox">
                                <label>Entry
                                    <input type="checkbox" data-text="Level:Entry" class="filter" name="level"
                                        value="entry">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                                <label>Intermediate
                                    <input type="checkbox" class="filter" data-text="Level:Intermediate" name="level"
                                        value="intermediate">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                                <label>Expert
                                    <input type="checkbox" class="filter" data-text="Level:Expert" name="level"
                                        value="expert">
                                    <span class="btn-checkbox"></span>
                                </label><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div data-wow-delay="0.2s" class="wow fadeInUp widget-search animated"
                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <input type="search" id="search" class="search-field style-2"
                                    placeholder="Search..." title="Search for">
                            </div>
                        </div>
                        <div class="col-md-12 mt-30">
                            <div class="row po-sticky-footer" id="services">
                                <div class="d-flex justify-content-center" style="height: 100vh">
                                    <div class="align-self-center">
                                        <div class="spinner-border" style="width: 3rem; height: 3rem;"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-30">
                                <div class="widget-pagination" id="pagination">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-guest-layout>

<script>
    $(document).ready(function() {

        const getServices = (params = []) => {
            $.ajax({
                url: "{{ route('get-all-services') }}?" + params,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        let html = '';
                        if (response.data?.data.length > 0) {
                            response.data?.data.forEach(service => {
                                html += `
                                <div data-wow-delay="0s" class="wow fadeInUp col-lg-4 col-md-6">
                                    <div class="tf-card-box style-1">
                                        <div class="card-media">
                                            <a href="/service/${service.slug}" wire:navigate.hover>
                                                <img src="${service.images ? service.images[0].path : ''}" alt="">
                                            </a>
                                            <div class="button-place-bid">
                                                <a href="/service/${service.slug}" wire:navigate.hover
                                                    class="tf-button"><span>Place Bid</span></a>
                                            </div>
                                        </div>
                                        <h5 class="name"><a href="/service/${service.slug}" wire:navigate.hover>${service.title}</a>
                                        </h5>
                                        <div class="author flex items-center">
                                            <div class="info">
                                                <span>Created by:</span>
                                                <h6>${service.customer ? service.customer.name : ''}</h6>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <div class="meta-info flex items-center justify-between">
                                            <span class="text-bid">Current Bid</span>
                                            <h6 class="price gem">${service.currency == 'usd' ? '$' : service.currency}${service.price}</h6>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });

                            if (response.data.total > 9) {
                                let pagination = `<ul class="justify-center">`;
                                let pages = Math.ceil(response.data.total / 10);
                                for (let i = 1; i <= pages; i++) {
                                    pagination +=
                                        `<li ${i == response.data.current_page ? 'class="active"' : ''} class="page-item"><a href="#">${i}</a></li>`;
                                }
                                pagination += `</ul>`;
                                $('#pagination').html(pagination);
                            } else {
                                $('#pagination').html('');
                            }

                        } else {
                            html += `
                            <div class="d-flex justify-content-center" style="height: 100vh">
                                <div class="align-self-center">
                                    <h5>No services found</h5>
                                </div>
                            </div>
                        `;
                        }
                        $('#services').html(html);
                    }
                }
            })
        }

        $('.filter').on('click', function(e) {
            // console.log(e.target);
            if ($(this).is(':checked')) {
                let text = $(this).attr('data-text');
                getServices($(this).serialize());
                $('#main-heading').text(text);
            } else {
                $('#main-heading').text('All Services');
                getServices();
            }
        })

        $('#pagination').on('click', 'li a', (e) => {
            e.preventDefault();
            let page = $(e.target).text();
            getServices(`page=${page}`);
        });

        let debounceTimeout;

        $('.search-field').on('input', function() {
            let search = $(this).val().trim();
            clearTimeout(debounceTimeout); // Clear previous timeout to avoid spamming requests

            debounceTimeout = setTimeout(() => {
                if (search.length > 1) {
                    $('#main-heading').text(`Search results for: ${search}`);
                    getServices(`search=${search}`);
                } else {
                    $('#main-heading').text('All Services');
                    getServices();
                }
            }, 300); // Adjust delay (300ms is typical)
        });

        let category = new URL(window.location.href).searchParams.get('category');
        if (category) {
            $('#main-heading').text(`Category: ${category}`);
            getServices(`category_slug=${category}`);
        }else{
            getServices();
        }

    })
</script>
