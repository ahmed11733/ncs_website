<div class="vertical-menu no-print ">

    <div data-simplebar class="h-100">

        <!--- Side menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li @if(Route::is('admin.dynamicPages.home*') ) class="mm-active" @endif>
                    <a href="{{ route('admin.dynamicPages.home') }}" class="waves-effect">
                        <i class="bx bx-home-alt"></i>
                        <span>Home Page</span>
                    </a>
                </li>
                <li @if(Route::is('admin.dynamicPages.about*') ) class="mm-active" @endif>
                    <a href="{{ route('admin.dynamicPages.about') }}" class="waves-effect">
                        <i class="bx bx-info-circle"></i>
                        <span>About Us Page</span>
                    </a>
                </li>
                <li @if(Route::is('admin.dynamicPages.contact*') ) class="mm-active" @endif>
                    <a href="{{ route('admin.dynamicPages.contact') }}" class="waves-effect">
                        <i class="bx bx-phone"></i>
                        <span>Contact Us Page</span>
                    </a>
                </li>
                <li @if(Route::is('admin.dynamicPages.footer*') ) class="mm-active" @endif>
                    <a href="{{ route('admin.dynamicPages.footer') }}" class="waves-effect">
                        <i class="bx bx-copyright"></i>
                        <span>Footer</span>
                    </a>
                </li>
                <li @if(Route::is('admin.events.registrations*') ) class="mm-active" @endif>
                    <a href="{{route('admin.events.registrations')}}" class="waves-effect">
                        <i class="bx bx-calendar-check"></i>
                        <span key="t-chat">Event Registrations</span>
                    </a>
                </li>
                <li @if(Route::is('admin.job-departments.index*')) class="mm-active" @endif>
                    <a href="{{ route('admin.job-departments.index') }}" class="waves-effect">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-chat">Job Departments</span>
                    </a>
                </li>
                <li @if(Route::is('admin.jobs.index*') ) class="mm-active" @endif>
                    <a href="{{route('admin.jobs.index')}}" class="waves-effect">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-chat">Jobs</span>
                    </a>
                </li>
                <li @if(Route::is('admin.dynamicPages.events*') ) class="mm-active" @endif>
                    <a href="{{route('admin.dynamicPages.events')}}" class="waves-effect">
                        <i class="bx bx-calendar-event"></i>
                        <span key="t-events">Events</span>
                    </a>
                </li>
                <li @if(Route::is('admin.dynamicPages.career*') ) class="mm-active" @endif>
                    <a href="{{route('admin.dynamicPages.career')}}" class="waves-effect">
                        <i class="bx bx-briefcase-alt"></i>
                        <span key="t-career">Career</span>
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
                <li @if(Route::is('admin.contact-messages.index*')) class="mm-active" @endif>
                    <a href="{{ route('admin.contact-messages.index') }}" class="waves-effect">
                        <i class="bx bx-envelope"></i>
                        <span key="t-contact-messages">Contact Messages</span>
                    </a>
                </li>
                <li @if(Route::is('admin.demo-requests*') ) class="mm-active" @endif>
                    <a href="{{ route('admin.demo-requests.index') }}" class="waves-effect">
                        <i class="bx bx-calendar-check"></i>
                        <span>Demo Requests</span>
                    </a>
                </li>
                <li @if(Route::is('admin.faqs*')) class="mm-active" @endif>
                    <a href="{{ route('admin.faqs.index') }}" class="waves-effect">
                        <i class="bx bx-help-circle"></i>
                        <span>FAQs</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
