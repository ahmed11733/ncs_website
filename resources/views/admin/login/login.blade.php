@extends('admin.layouts.app-login')
@section('content')
    <div class="auth-page-wrapper">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <!-- Left Column - Login Form -->
                <div class="col-xl-6">
                    <div class="auth-form-wrapper p-4 p-md-5">
                        <div class="auth-form-container">
                            <!-- Logo Section -->
                            <div class="logo-section text-center mb-4 mb-md-5">
                                <img src="{{asset('admin_assets/images/logo.png')}}" alt="Logo" class="login-logo">
                            </div>

                            <!-- Login Form -->
                            <div class="login-form">
                                @if(Session::has('error'))
                                    <div class="alert alert-danger text-center mb-4">
                                        <strong>{{Session::get('error')}}</strong>
                                    </div>
                                @endif

                                <form action="{{route('admin.submit.login')}}" method="post" class="needs-validation" novalidate>
                                @csrf

                                <!-- Email Input -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-email-outline"></i>
                                        </span>
                                            <input type="email" class="form-control" id="email" required name="email"
                                                   placeholder="أدخل البريد الإلكتروني" dir="rtl">
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-lock-outline"></i>
                                        </span>
                                            <input type="password" class="form-control" id="password" required
                                                   name="password" placeholder="أدخل كلمة المرور" dir="rtl">
                                            <button class="btn btn-light toggle-password" type="button">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter the password
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100 py-2" type="submit">
                                            <i class="mdi mdi-login me-1"></i> Login
                                        </button>
                                    </div>

                                    <!-- Optional Remember Me Checkbox -->
                                    {{-- <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me">
                                            تذكر بيانات الدخول
                                        </label>
                                    </div> --}}
                                </form>
                            </div>

                            <!-- Footer -->
                            <div class="auth-footer text-center mt-4 mt-md-5">
                                <p class="mb-0 text-muted">
                                    &copy; <script>document.write(new Date().getFullYear())</script> All rights reserved
                                    <a href="#" class="text-primary">NCS</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Background Image -->
                <div class="col-xl-6 d-none d-xl-block">
                    <div class="auth-bg-section">
                        <div class="bg-overlay" id="particles-js" style="background-color: #1a2229;"></div>
                        <div class="auth-bg-content">
                            <p class="text-white-70 mb-0" style="font-size: 60px;">NCS</p>
                            <p class="text-white-70 mb-0" style="font-size: 25px;">WEBSITE - DASHBOARD</p>
{{--                            <img src="{{asset('admin_assets/images/logo.png')}}" alt="Logo" class="login-logo"--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector('input');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('mdi-eye-outline');
                this.querySelector('i').classList.toggle('mdi-eye-off-outline');
            });
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
@section('extra-css')
<style>
    .auth-page-wrapper {
        min-height: 100vh;
        background-color: #f8f9fa;
    }

    .auth-form-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .auth-form-container {
        max-width: 450px;
        width: 100%;
    }

    .login-logo {
        margin-bottom: 1rem;
        height: 300px;
        width: 300px;
    }

    .auth-bg-section {
        position: relative;
        height: 100vh;
        background: linear-gradient(135deg, #3b5d91 0%, #1e3a8a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .auth-bg-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        padding: 2rem;
    }

    .bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.2);
    }

    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 0.375rem;
    }

    .btn-primary {
        background-color: #3b5d91;
        border-color: #3b5d91;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #1e3a8a;
        border-color: #1e3a8a;
    }

    .input-group-text {
        background-color: #f8f9fa;
    }

    @media (max-width: 1199.98px) {
        .auth-form-wrapper {
            padding: 2rem;
        }
    }
</style>
@endsection
