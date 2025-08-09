@extends('admin.layouts.app')

@section('title', 'Event Registrations')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Event Registrations</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Event Registrations</li>
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

                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Num of Attendees</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Preferred Session</th>
                                <th scope="col">Event Reminder</th>
                                <th scope="col">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($registrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->first_name .' '. $registration->last_name }}</td>
                                    <td>{{ $registration->job_title }}</td>
                                    <td>{{ $registration->country_code . $registration->phone_number }}</td>
                                    <td>{{ $registration->email }}</td>
                                    <td>{{ $registration->company_name }}</td>
                                    <td>{{ $registration->country_region }}</td>
                                    <td>{{ $registration->number_of_attendees }}</td>
                                    <td>{{ $registration->event_name }}</td>
                                    <td>{{ $registration->preferred_session }}</td>
                                    <td>{{ $registration->receive_event_reminder ? 'Yes' : 'No' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($registration->created_at)->locale('en')->translatedFormat('l dS F G:i - Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$registrations->withQueryString()->links('admin.pagination.bootstrap-4')}}

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


{{--    <script>--}}
{{--        function openModalDelete(shipper_id) {--}}
{{--            $('.action_form').attr('action', '{{route('admin.contact_us.destroy', '')}}' + '/' + shipper_id);--}}
{{--            $('#deleteModal').modal('show');--}}
{{--        }--}}
{{--    </script>--}}


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
