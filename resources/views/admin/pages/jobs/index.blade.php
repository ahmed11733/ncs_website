@extends('admin.layouts.app')

@section('title', 'Jobs')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Jobs</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                        <div class="col-sm-12 text-end">
                            <a href="{{ route('admin.jobs.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New Job
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">ID</th>
                                <th scope="col">Department</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">EX.Years</th>
                                <th scope="col">Last Date to Apply</th>
                                <th scope="col">Nationality</th>
                                <th scope="col">Certificate</th>
                                <th scope="col">Age</th>
                                <th scope="col">Specialization</th>
                                <th scope="col">Created At</th>
                                <th scope="col">More</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->department->name }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->experience_years }}</td>
                                    <td>{{ $job->last_date }}</td>
                                    <td>{{ $job->nationality }}</td>
                                    <td>{{ $job->certificate }}</td>
                                    <td>{{ $job->age }}</td>
                                    <td>{{ $job->specialization }}</td>
                                    <td>{{ \Carbon\Carbon::parse($job->created_at)->locale('en')->translatedFormat('l dS F G:i - Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.jobs.edit', $job) }}" title="Edit" class="text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a onclick="openModalDelete({{$job->id}})" title="حذف"
                                               class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$jobs->withQueryString()->links('admin.pagination.bootstrap-4')}}

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
            $('.action_form').attr('action', '{{route('admin.jobs.destroy', '')}}' + '/' + shipper_id);
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
            Delete Data
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    Are you sure you want to delete?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
