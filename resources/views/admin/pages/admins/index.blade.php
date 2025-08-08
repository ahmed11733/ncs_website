@extends('admin.layouts.app')
@section('title', 'المشرفين')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">الرئيسيه</a>
    </li>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">المشرفين</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">لوحة التحكم</a></li>
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
                    <div class="row mb-2 no-print">
                        <div class="col-sm-8">
                            <form action="{{route('admin.admins.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">الاسم</label>
                                            <input name="name" class="form-control" type="text"
                                                   value="{{request('name')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">من تاريخ</label>
                                            <input name="from" class="form-control" type="date"
                                                   value="{{request('from')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="formrow-password-input" class="form-label">إلى تاريخ</label>
                                            <input name="to" class="form-control" type="date" value="{{request('to')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <div class="d-grid">
                                            <label for="formrow-email-input" class="form-label hidden">بحث</label>
                                            <input data-repeater-delete="" type="submit" id="search"
                                                   class="btn btn-primary inner" value="بحث">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                @can('create_admins_admin')
                                    <div class="col-sm-12">
                                        <div class="text-sm-end">
                                            <a href="{{route('admin.admins.create')}}"
                                               class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-plus me-1"></i> إضافة جديد </a>
                                        </div>
                                    </div><!-- end col-->
                                @endcan
                            </div><!-- end col-->
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table table-hover  dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">المعرف</th>
                                <th scope="col">الاسم</th>
                                <th scope="col">البريد الإلكتروني</th>
                                <th scope="col">الدور</th>
                                <th scope="col">تاريخ الإنشاء</th>
                                <th scope="col">المزيد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">{{$admin->id}}</a></td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    {{--                                    @dd($admin)--}}
                                    <td>{{count($admin->getRoleNames())? $admin->getRoleNames()[0]:"-"}}</td>
                                    <td>
                                        {{Carbon\Carbon::parse($admin->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            @can('edit_admins_admin')
                                                <a href="{{route('admin.admins.edit',$admin->id)}}" title="تعديل"
                                                   class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            @endcan
                                            @can('delete_admins_admin')
                                                <a onclick="openModalDelete({{$admin->id}})" title="حذف"
                                                   class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
        حذف البيانات
    @endslot
    @slot('modalMethodPutOrDelete')
        @method('delete')
    @endslot
    @slot('modalContent')
        <div class="text-center">
                <span class="text-danger font-16">
                    هل أنت متأكد من عملية الحذف؟
                </span>
        </div>
    @endslot
@endcomponent
