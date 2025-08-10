<div class="vertical-menu no-print ">

    <div data-simplebar class="h-100">

        <!--- Side menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li @if(Route::is('admin.events.registrations*') ) class="mm-active" @endif>
                    <a href="{{route('admin.events.registrations')}}" class="waves-effect">
                        <i class="bx bx-calendar-check"></i>
                        <span key="t-chat">Event Registrations</span>
                    </a>
                </li>
                <li @if(Route::is('admin.jobs.index*') ) class="mm-active" @endif>
                    <a href="{{route('admin.jobs.index')}}" class="waves-effect">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-chat">Jobs</span>
                    </a>
                </li>
                <li @if(Route::is('admin.page-categories.index*') ) class="mm-active" @endif>
                    <a href="{{route('admin.page-categories.index')}}" class="waves-effect">
                        <i class="bx bx-collection"></i>
                        <span key="t-chat">Pages Categories</span>
                    </a>
                </li>
                <li @if(Route::is('admin.pages.index*') ) class="mm-active" @endif>
                    <a href="{{route('admin.pages.index')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-chat">All  Pages</span>
                    </a>
                </li>
                @can('access_drivers_admin')
                    <li class="nav-item @if(Route::is('admin.drivers*')) mm-active @endif">
                        <a class="nav-link" href="#"
                           style="display: flex; justify-content: space-between; align-items: center;">
                                <span>
                                    <i class="bx bx-car"></i> <!-- Car Icon for Drivers -->
                                    <span key="t-chat">السائقين</span>
                                </span>
                            <i class="bx bx-chevron-down" style="font-size: 16px;"></i> <!-- Arrow Icon for dropdown -->
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="{{ route('admin.drivers.index') }}">
                                    <i class="bx bx-id-card"></i> <!-- ID Card Icon for All Drivers -->
                                    كل السائقين
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('admin.drivers_requests.index') }}">
                                    <i class="bx bx-paper-plane"></i> <!-- Paper Plane Icon for Driver Requests -->
                                    طلبات السائقين
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
