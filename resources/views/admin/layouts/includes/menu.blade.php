<div class="vertical-menu no-print ">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @can('access_admins_admin')
                    <li @if(Route::is('admin.admins*') ) class="mm-active" @endif>
                        <a href="{{route('admin.admins.index')}}" class="waves-effect">
                            <i class="bx bx-user-check"></i>
                            <span key="t-chat">المشرفين</span>
                        </a>
                    </li>
                @endcan
                @can('access_roles_admin')
                    <li @if(Route::is('admin.roles*') ) class="mm-active" @endif>
                        <a href="{{route('admin.roles.index')}}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-chat">أدوار المشرفين</span>
                        </a>
                    </li>
                @endcan
                @can('access_users_admin')
                    <li @if(Route::is('admin.users*')) class="mm-active" @endif>
                        <a href="{{route('admin.users.index')}}" class="waves-effect">
                            <i class="bx bxs-user"></i> <!-- Changed to a user icon for users -->
                            <span key="t-chat">المستخدمين</span>
                        </a>
                    </li>
                @endcan
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
                @can('access_trips_admin')
                    <li class="nav-item @if(Route::is('admin.trips*')) mm-active @endif">
                        <a class="nav-link" href="#"
                           style="display: flex; justify-content: space-between; align-items: center;">
                        <span>
                            <i class="bx bx-map-pin"></i> <!-- Trip Icon for Trips -->
                            <span key="t-chat">الرحلات</span>
                        </span>
                            <i class="bx bx-chevron-down" style="font-size: 16px;"></i> <!-- Arrow Icon for dropdown -->
                        </a>
                        <ul class="nav nav-second-level">
                            <li class="@if(request('type') == \App\Helpers\Constant::TRIP_TYPES['Standard']) mm-active @endif">
                                <a class="nav-link"
                                   href="{{ route('admin.trips.index', ['type' => \App\Helpers\Constant::TRIP_TYPES['Standard']]) }}">
                                    <i class="bx bx-car"></i> <!-- Car Icon for Standard Trips -->
                                    رحلات عاديه
                                </a>
                            </li>
                            <li class="@if(request('type') == \App\Helpers\Constant::TRIP_TYPES['Hourly']) mm-active @endif">
                                <a class="nav-link"
                                   href="{{ route('admin.trips.index', ['type' => \App\Helpers\Constant::TRIP_TYPES['Hourly']]) }}">
                                    <i class="bx bx-time-five"></i> <!-- Clock Icon for Hourly Trips -->
                                    رحلات بنظام الساعات
                                </a>
                            </li>
                            <li class="@if(request('type') == \App\Helpers\Constant::TRIP_TYPES['Scheduled']) mm-active @endif">
                                <a class="nav-link"
                                   href="{{ route('admin.trips.index', ['type' => \App\Helpers\Constant::TRIP_TYPES['Scheduled']]) }}">
                                    <i class="bx bx-calendar"></i> <!-- Calendar Icon for Scheduled Trips -->
                                    رحلات مجدولة
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li @if(Route::is('admin.trips.complaints*')) class="mm-active" @endif>
                            <a href="{{route('admin.trips.complaints')}}" class="waves-effect">
                                <i class="bx bxs-car"></i> <!-- Changed to a working car icon -->
                                <span key="t-chat">شكاوي الرحلات</span>
                            </a>
                        </li>
                @endcan
                @can('access_vehicle_types_admin')
                    <li @if(Route::is('admin.vehicle_types*')) class="mm-active" @endif>
                        <a href="{{route('admin.vehicle_types.index')}}" class="waves-effect">
                            <i class="bx bxs-car"></i> <!-- Changed to a working car icon -->
                            <span key="t-chat">أنواع المركبات</span>
                        </a>
                    </li>
                @endcan
                @can('access_vehicle_models_admin')
                    <li @if(Route::is('admin.vehicle_models*')) class="mm-active" @endif>
                        <a href="{{route('admin.vehicle_models.index')}}" class="waves-effect">
                            <i class="bx bxs-car"></i> <!-- Changed to a better icon for vehicle models -->
                            <span key="t-chat">نماذج المركبات</span>
                        </a>
                    </li>
                @endcan
                @can('access_vehicle_colors_admin')
                    <li @if(Route::is('admin.vehicle_colors*')) class="mm-active" @endif>
                        <a href="{{route('admin.vehicle_colors.index')}}" class="waves-effect">
                            <i class="bx bxs-palette"></i> <!-- Changed to a paint palette icon for vehicle colors -->
                            <span key="t-chat">ألوان المركبات</span>
                        </a>
                    </li>
                @endcan
                @can('access_reports_admin')
                    <li @if(Route::is('admin.reports*')) class="mm-active" @endif>
                        <a href="{{route('admin.reports.index')}}" class="waves-effect">
                            <i class="bx bxs-palette"></i>
                            <!-- Changed to a paint palette icon for vehicle colors -->
                            <span key="t-chat">التقارير</span>
                        </a>
                    </li>
                @endcan
                @can('access_welcome_screens_admin')
                    <li @if(Route::is('admin.welcome_screens*')) class="mm-active" @endif>
                        <a href="{{route('admin.welcome_screens.index')}}" class="waves-effect">
                            <i class="bx bx-tv"></i> <!-- Changed to a TV icon for welcome screens -->
                            <span key="t-chat">شاشات الترحيب</span>
                        </a>
                    </li>
                @endcan
                    @can('access_cancel_reasons_admin')
                        <li @if(Route::is('admin.cancel_reasons*') && !request()->has('type')) class="mm-active" @endif>
                            <a href="{{ route('admin.cancel_reasons.index') }}" class="waves-effect">
                                <i class="bx bx-x-circle"></i>
                                <span key="t-chat">أسباب الالغاء</span>
                            </a>
                        </li>
                        <li @if(Route::is('admin.cancel_reasons*') && request()->type == '2') class="mm-active" @endif>
                            <a href="{{ route('admin.cancel_reasons.index', ['type' => 2]) }}" class="waves-effect">
                                <i class="bx bxs-x-square"></i>
                                <span key="t-chat">الشكاوي</span>
                            </a>
                        </li>
                    @endcan

                @can('access_contact_apps_admin')
                    <li @if(Route::is('admin.contact_us*')) class="mm-active" @endif>
                        <a href="{{route('admin.contact_us.index')}}" class="waves-effect">
                            <i class="bx bxs-phone"></i> <!-- Changed to a phone icon for contact us -->
                            <span key="t-chat">تواصل معنا</span>
                        </a>
                    </li>
                @endcan

                @can('access_coupons_admin')
                    <li @if(Route::is('admin.coupons*')) class="mm-active" @endif>
                        <a href="{{route('admin.coupons.index')}}" class="waves-effect">
                            <i class="bx bxs-discount"></i> <!-- Changed to a discount icon for coupons -->
                            <span key="t-chat">الكوبونات</span>
                        </a>
                    </li>
                @endcan
                @can('access_notifications_admin')
                    <li @if(Route::is('admin.notifications*')) class="mm-active" @endif>
                        <a href="{{route('admin.notifications.index')}}" class="waves-effect">
                            <i class="bx bxs-bell"></i> <!-- Changed to a bell icon for notifications -->
                            <span key="t-chat">الاشعارات</span>
                        </a>
                    </li>
                @endcan
                @can('access_wallet_history_admin')
                    <li @if(Route::is('admin.wallet_history*')) class="mm-active" @endif>
                        <a href="{{route('admin.wallet_history.index')}}" class="waves-effect">
                            <i class="bx bxs-wallet"></i> <!-- Changed to a wallet icon for wallet history -->
                            <span key="t-chat">سجل المحفظه</span>
                        </a>
                    </li>
                @endcan
                @can('access_settings_admin')
                    <li @if(Route::is('admin.settings*')) class="mm-active" @endif>
                        <a href="{{route('admin.settings.index')}}" class="waves-effect">
                            <i class="bx bx-list-ul"></i>
                            <span key="t-chat">اعدادادت التطبيق</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
