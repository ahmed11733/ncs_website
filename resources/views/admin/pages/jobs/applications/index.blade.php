@extends('admin.layouts.app')

@section('title', 'Job Applicants - ' . $job->title)

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.jobs.index') }}" class="text-muted text-hover-primary">Jobs</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Applicants</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Applicants for: {{ $job->title }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
                        <li class="breadcrumb-item active">Applicants</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if($applications->isEmpty())
                        <div class="text-center py-5">
                            <i class="mdi mdi-account-off-outline font-size-24 text-muted"></i>
                            <p class="text-muted mt-2">No applicants found for this job.</p>
                            <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary mt-2">
                                <i class="mdi mdi-arrow-left"></i> Back to Jobs
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr class="tr-colored">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Experience</th>
                                    <th scope="col">Education</th>
                                    <th scope="col">Applied At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                        <td>{{ $application->email }}</td>
                                        <td>{{ $application->phone }}</td>
                                        <td>{{ $application->years_of_experience }} years</td>
                                        <td>{{ $application->highest_degree_achieved }}</td>
                                        <td>{{ \Carbon\Carbon::parse($application->created_at)->format('M d, Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="{{ route('admin.jobs.applications.show', [$job, $application]) }}"
                                                   title="View Details" class="text-info">
                                                    <i class="mdi mdi-eye font-size-18"></i>
                                                </a>
                                                <a onclick="openModalDelete({{ $job->id }}, {{ $application->id }})"
                                                   title="Delete" class="text-danger">
                                                    <i class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $applications->links('admin.pagination.bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        function openModalDelete(jobId, applicationId) {
            $('.action_form').attr('action', '{{ url('admin/jobs') }}/' + jobId + '/applications/' + applicationId);
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
            Delete Application
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    Are you sure you want to delete this application?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
