<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
{{--        <div>--}}
{{--            <h3 class="logo-text">Troubleshoot</h3>--}}
{{--        </div>--}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label"> Services</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-map-alt'></i>
                </div>
                <div class="menu-title">Zone</div>
            </a>
            <ul>
                <li> <a href="{{route('add.zone')}}"><i class='bx bx-radio-circle'></i>Add New Zone</a>
                </li>
                <li> <a href="{{ route('list.zone') }}"><i class='bx bx-radio-circle'></i>Zone List</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-dots-vertical-rounded'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{route('add.category')}}"><i class='bx bx-radio-circle'></i>Add New Category</a>
                </li>
                <li> <a href="{{ route('list.category')  }}"><i class='bx bx-radio-circle'></i>Category List</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-dots-horizontal-rounded'></i>
                </div>
                <div class="menu-title">SubCategory</div>
            </a>
            <ul>
                <li> <a href="{{route('add.subcategory')}}"><i class='bx bx-dots-horizontal-rounded'></i>Add New SubCategory</a>
                </li>
                <li> <a href="{{ route('list.subcategory') }}"><i class='bx bx-radio-circle'></i>SubCategoryList</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cube'></i>
                </div>
                <div class="menu-title">Service</div>
            </a>
            <ul>
                <li> <a href="{{route('add.service')}}"><i class='bx bx-radio-circle'></i>Add New Service</a>
                </li>
                <li> <a href="{{route('list.service')}}"><i class='bx bx-radio-circle'></i>Service List</a>
                </li>
            </ul>
        </li>
                <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-flag'></i>
                </div>
                <div class="menu-title">Campaign</div>
            </a>
            <ul>
                <li> <a href="{{ route('new.campaign.add') }}"><i class='bx bx-radio-circle'></i>Add  Campaign</a>
                </li>
{{--                <li> <a href="{{ route('service.campaign.add') }}"><i class='bx bx-radio-circle'></i>Add Service Campaign</a>--}}
               {{-- </li>--}}
                <li> <a href="{{ route('campaign.list') }}"><i class='bx bx-radio-circle'></i>Campaign List</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
