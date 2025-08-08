@extends('admin.layouts.app')

@section('title', 'تواصل معنا')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">الرئيسيه</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">تواصل معنا</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسيه</a></li>
                        <li class="breadcrumb-item active">تواصل معنا</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <form action="{{route('admin.contact_us.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="formrow-email-input"
                                                   class="form-label">الاسم</label>
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
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">الرقم</th>
                                <th scope="col">التطبيق</th>
                                <th scope="col">الأسم</th>
                                <th scope="col">البريد الالكتروني</th>
                                <th scope="col">الهاتف</th>
                                <th scope="col">الرساله</th>
                                <th scope="col">تاريخ الانشاء</th>
                                <th scope="col">المزيد</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr >
                                    <td>{{$contact->id}} </td>
                                    <td>{{$contact->account_type}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->country_code .' '.$contact->phone}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>
                                        {{Carbon\Carbon::parse($contact->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            @can('delete_contact_apps_admin')
                                                <a  onclick="openModalDelete({{$contact->id}})" title="حذف" class="text-danger"><i class="mdi mdi-delete font-size-18" ></i></a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                    {{$contacts->withQueryString()->links('admin.pagination.bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
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
            $('.action_form').attr('action', '{{route('admin.contact_us.destroy', '')}}' + '/' + shipper_id);
            $('#deleteModal').modal('show');
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
@endsection
