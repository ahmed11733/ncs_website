@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>

@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">المشرفين</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.Dashboard')}}</a></li>
                        <li class="breadcrumb-item active">المشرفين</li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label"> الاسم </label>
                                                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="form-control" id="name" placeholder="الاسم">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label"> البريد الالكتروني </label>
                                                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="form-control" id="email" placeholder="البريد الالكتروني">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <label for="phone" class="form-label"> الهاتف </label>
                                                        <input type="number" name="phone" value="{{ old('phone', $admin->phone) }}" required class="form-control" id="phone" placeholder="الهاتف">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label"> كلمه السر </label>
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="كلمه السر">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="role" class="form-label"> الدور </label>
                                                    <select id="role" required class="form-select" name="role">
                                                        <option disabled selected> اختر دور </option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"> تحديث </button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
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

    <!-- init js -->
    <script src="{{asset('admin_assets/js/pages/crypto-orders.init.js')}}"></script>

    <script>
        function openModalDelete(admin_id) {
            $('.action_form').attr('action', '{{route('admin.admins.destroy', '')}}' + '/' + admin_id);
            $('#deleteModal').modal('show');

        }
    </script>


@endsection
@component('admin.layouts.includes.modal')
    @slot('modalID')
        deleteModal
    @endslot
    @slot('modalTitle')
        {{__('admin.delete-data')}}
    @endslot
    @slot('modalMethodPutOrDelete')
        @method('delete')
    @endslot
    @slot('modalContent')
        <div class="text-center">
                <span class="text-danger font-16">
                    {{__('admin.delete-message-confirm')}}
                </span>
        </div>
    @endslot
@endcomponent
