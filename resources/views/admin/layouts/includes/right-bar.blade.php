<div class="right-bar no-print">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">{{__('admin.settings')}}</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <!-- Settings -->
        <hr class="mt-0"/>
        <h6 class="text-center mb-0">{{__('admin.choose-layout')}}</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="{{asset('admin_assets/images/layouts/layout-1.jpg')}}" class="img-thumbnail"
                     alt="layout images">
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                <label class="form-check-label" for="light-mode-switch">{{__('admin.day-mode')}}</label>
            </div>

            <div class="mb-2">
                <img src="{{asset('admin_assets/images/layouts/layout-2.jpg')}}" class="img-thumbnail"
                     alt="layout images">
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                <label class="form-check-label" for="dark-mode-switch">{{__('admin.night-mode')}}</label>
            </div>


        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
