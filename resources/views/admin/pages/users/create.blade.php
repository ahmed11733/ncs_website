@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <style>
        .alert-text{
            color: red;
            font-size: 15px;
            font-weight: bolder;
        }
    </style>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">

        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">أنواع المركبات</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسيه</a>
                        </li>
                        <li class="breadcrumb-item active">أنواع المركبات</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="crypto-buy-sell-nav">
                        <p id="alert-text" class="alert-text"></p>
                        <form action="{{route('admin.users.store')}}" id="form-data" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="{{request('type')}}">

                            <div class="tab-content crypto-buy-sell-nav-content p-4">
                                <div class="tab-pane active" id="buy" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="name-input" class="form-label">الاسم</label>
                                                <input type="text" name="name" value="{{old('name')}}" required
                                                       class="form-control" id="name-input"
                                                       placeholder="اسم المستخدم">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'name'])
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="email-input" class="form-label">البريد الإلكتروني</label>
                                                <input type="email" name="email" value="{{old('email')}}" required
                                                       class="form-control" id="email-input"
                                                       placeholder="البريد الإلكتروني">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'email'])
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="country-code-input" class="form-label">كود الدولة</label>
                                                <select name="country_code" class="form-select" id="country-code-input" readonly>
                                                    <option value="+20" {{old('country_code') == '+20' ? 'selected' : ''}} selected>مصر (+20)</option>
                                                    <!-- يمكن إضافة المزيد من أكواد الدول حسب الحاجة -->
                                                </select>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'country_code'])
                                        </div>

                                        <div class="col-sm-8">
                                            <div class="mb-3">
                                                <label for="phone-input" class="form-label">رقم الهاتف</label>
                                                <input type="text" name="phone" value="{{old('phone')}}" required
                                                       class="form-control" id="phone-input"
                                                       placeholder="رقم الهاتف بدون كود الدولة">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'phone'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="password-input" class="form-label">كلمة المرور</label>
                                                <input type="password" name="password" required
                                                       class="form-control" id="password-input"
                                                       placeholder="كلمة المرور">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'password'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="password-confirmation-input" class="form-label">تأكيد كلمة المرور</label>
                                                <input type="password" name="password_confirmation" required
                                                       class="form-control" id="password-confirmation-input"
                                                       placeholder="تأكيد كلمة المرور">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="profile-image-input" class="form-label">الصورة الشخصية</label>
                                                <input type="file" name="profile_image" class="form-control" id="profile-image-input"
                                                       accept="image/jpeg,image/png,image/jpg,image/gif" required>
                                                <small class="form-text text-muted">الحد الأقصى لحجم الصورة: 2 ميجابايت</small>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'profile_image'])
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" id="submit-button"
                                            class="btn btn-primary waves-effect waves-light">إضافة المستخدم</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- end row -->
@endsection

@section('extra-js')
    <script src="{{asset('admin_assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- bootstrap-datepicker js -->
    <script src="{{asset('admin_assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const passwordInput = document.getElementById("password-input");
            const passwordConfirmationInput = document.getElementById("password-confirmation-input");
            const errorText = document.createElement("small");
            errorText.classList.add("text-danger");
            passwordConfirmationInput.parentNode.appendChild(errorText);

            function checkPasswords() {
                if (passwordInput.value !== passwordConfirmationInput.value) {
                    errorText.textContent = "كلمة المرور غير متطابقة!";
                    passwordConfirmationInput.classList.add("is-invalid");
                } else {
                    errorText.textContent = "";
                    passwordConfirmationInput.classList.remove("is-invalid");
                }
            }

            passwordInput.addEventListener("input", checkPasswords);
            passwordConfirmationInput.addEventListener("input", checkPasswords);
        });
    </script>

@endsection
