@extends('admin.layouts.app-login')
@section('content')

    <div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xl-6">
                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-4" style="height: 220px;">
                                <img src="{{asset('admin_assets/images/logo.png')}}" style="max-height: 80%;" class="login-logo center" >
                            </div>
                            <div class="my-auto">
                                <div class="mt-4">
                                    <div class="text-center" style="color: red;"><strong>{{Session::get('error')}}</strong></div>

                                    <form action="{{route('admin.submit.login')}}" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="username" class="form-label">البريد الالكتروني</label>
                                            <input type="text" class="form-control" id="username" required="" name="email" placeholder="البريد الالكتروني">
                                        </div>

                                        <div class="mb-3">
{{--                                            <div class="float-end">--}}
{{--                                                <a href="auth-recoverpw-2.html" class="text-muted">{{__('admin.forget-password')}}</a>--}}
{{--                                            </div>--}}
                                            <label class="form-label">كلمخ المرور</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" required class="form-control" placeholder="كلمخ المرور"  name="password" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" id="remember-check">--}}
{{--                                            <label class="form-check-label" for="remember-check">--}}
{{--                                                {{__('admin.remember-me')}}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">تسجيل الدخول</button>
                                        </div>



                                    </form>

                                </div>
                            </div>

                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> copy rights <i class="mdi mdi-heart text-danger"></i><a > grand </a></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-xl-6 hide-mobile " >
                <div class="auth-full-bg pt-lg-5 p-4 " >
                    <div class="w-100"  >

                        <div class="bg-overlay"  id="particles-js"></div>

                    </div>
                </div>
            </div>
            <!-- end col -->


            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>
@endsection
