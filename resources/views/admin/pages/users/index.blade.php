@extends('admin.layouts.app')

@section('title', __('admin.home'))

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
    </li>
@endsection
@section('extra-css')
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
                page-break-inside: auto !important; /* Ensures tables are not split across pages */
                table-layout: fixed !important;

            }

            th, td {
                border: 1px solid black !important;
                padding: 8px !important;
                text-align: center !important;
            }
            th, td {
                width: auto !important; /* Adjust as needed */
            }
            th {
                background-color: #f2f2f2 !important; /* Example background color for headers */
            }
            .table-responsive{
                overflow-x: auto !important;

            }
            img
            {
                width: 50px !important;
                height: 50px !important;
            }

        }

    </style>

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 no-print">
                        <div class="col-sm-10">
                            <form action="{{route('admin.users.index')}}" method="get">
                                @csrf
                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="formrow-email-input"
                                                   class="form-label">الأسم</label>
                                            <input name="name" class="form-control" type="text"
                                                   value="{{request('name')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="formrow-email-input"
                                                   class="form-label">من</label>
                                            <input name="from" class="form-control" type="date"
                                                   value="{{request('from')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="formrow-password-input"
                                                   class="form-label">الي</label>
                                            <input name="to" class="form-control" type="date" value="{{request('to')}}"
                                                   id="example-date-input">
                                        </div>
                                    </div>
                                    <div class="col-md-1 ">
                                        <div class="d-grid">
                                            <label for="formrow-email-input"
                                                   class="form-label hidden">بحث</label>
                                            <input data-repeater-delete="" type="submit" id="search"
                                                   class="btn btn-primary inner" value="بحث">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-sm-2">
                            <div class="row">

{{--                                <div class="col-sm-4">--}}
{{--                                    <div class="text-sm-end">--}}
{{--                                        <a href="{{route('admin.users.download.excel',request()->query())}}"--}}
{{--                                           class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i--}}
{{--                                                class="mdi mdi-download me-1"></i> {{__('admin.download')}} </a>--}}

{{--                                    </div>--}}
{{--                                </div><!-- end col-->--}}
                                @can('create_users_admin')
{{--                                    <div class="col-sm-12">--}}
                                        <div class="text-sm-end" style="float: right; margin-top: 20px;">
                                            <a href="{{route('admin.users.create')}}"
                                               class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2">اضافه مستخدم</a>
                                        </div>
{{--                                    </div><!-- end col-->--}}
                                @endcan
{{--                                <div class="col-sm-4" style="float: right;">--}}
{{--                                    <div class="text-sm-end">--}}
{{--                                        <a href="javascript:void(0)" onclick="window.print()"--}}
{{--                                           class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2 no-print"><i--}}
{{--                                                class="mdi mdi-printer me-1"></i> {{__('admin.print')}} </a>--}}

{{--                                    </div>--}}
{{--                                </div><!-- end col-->--}}

                            </div><!-- end col-->
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover  dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">الرقم</th>
                                <th scope="col">الصوره</th>
                                <th scope="col">الأسم</th>
                                <th scope="col">البريد الالكتروني</th>
                                <th scope="col">رقم الهاتف</th>
                                <th scope="col">عدد الرحلات</th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col" class="no-print">المذيد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}} </td>
                                    <td>
                                        @if($user->image())
                                        <img src="{{$user->image()}}" height="150px" width="150">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->country_code}}{{$user->phone}}
                                    </td>
                                    <td>{{$user->trips ? count($user->trips) : 0}}</td>
                                    <td>
                                        {{Carbon\Carbon::parse($user->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
                                    </td>
                                    <td class="no-print">
                                        <div class="d-flex gap-3">
{{--                                            @can('edit_users_admin')--}}
                                            <a href="javascript:void(0)" onclick="openStatusModal({{$user->id}}, '{{$user->status == \App\Helpers\Constant::USER_STATUS['Active'] ? 'نشط' : 'غير نشط'}}')"
                                               title="تغيير الحالة" class="text-warning">
                                                <i class="mdi mdi-toggle-switch{{ $user->status == \App\Helpers\Constant::USER_STATUS['Active'] ? '' : '-off' }} font-size-18"></i>
                                            </a>
{{--                                            @endcan--}}
{{--                                            @can('delete_users_admin')--}}

                                                <a onclick="openModalDelete({{$user->id}})"
                                                   title="{{__('admin.delete')}}" class="text-danger"><i
                                                        class="mdi mdi-delete font-size-18"></i></a>
{{--                                            @endcan--}}

                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                    {{$users->withQueryString()->links('admin.pagination.bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
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
        function openModalDelete(shipper_id) {
            $('.action_form').attr('action', '{{route('admin.users.destroy', '')}}' + '/' + shipper_id);
            $('#deleteModal').modal('show');

        }
        function openStatusModal(user_id, current_status) {
            // Set the form action for the status change
            $('#statusModal form.action_form').attr('action', '{{route('admin.users.update.status', '')}}/' + user_id);

            // Set the current status text
            $('#current-status').text(current_status);

            // Show the modal
            $('#statusModal').modal('show');
        }
    </script>


@endsection
@section('modal')
    @component('admin.layouts.includes.modal')
        @slot('modalID')
            deleteModal
        @endslot
        @slot('modalTitle')
            {{__('حذف البيانات')}}
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    {{__('هل أنت متأكد من أنك تريد الحذف؟')}}
                </span>
            </div>
        @endslot
    @endcomponent
    @component('admin.layouts.includes.modal')
        @slot('modalID')
            statusModal
        @endslot
        @slot('modalTitle')
            تغيير حالة المستخدم
        @endslot
        @slot('modalMethod')
            post
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('put')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <p>
                    هل أنت متأكد من تغيير حالة المستخدم؟
                </p>
                <p>
                    الحالة الحالية: <span id="current-status"></span>
                </p>
            </div>
        @endslot
    @endcomponent
@endsection


