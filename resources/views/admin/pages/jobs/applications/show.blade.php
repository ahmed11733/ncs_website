@extends('admin.layouts.app')

@section('title', 'Application Details')

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
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('admin.jobs.applications.index', $job) }}" class="text-muted text-hover-primary">Applicants</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Details</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Application Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.applications.index', $job) }}">Applicants</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Personal Information</h5>
                            <p><strong>Name:</strong> {{ $application->first_name }} {{ $application->last_name }}</p>
                            <p><strong>Email:</strong> {{ $application->email }}</p>
                            <p><strong>Phone:</strong> {{ $application->phone }}</p>
                            <p><strong>Address:</strong> {{ $application->address }}</p>
                            <p><strong>National ID:</strong> {{ $application->national_id_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Professional Information</h5>
                            <p><strong>Current Job Title:</strong> {{ $application->job_title ?? 'Not specified' }}</p>
                            <p><strong>Department:</strong> {{ $application->department ?? 'Not specified' }}</p>
                            <p><strong>Highest Degree:</strong> {{ $application->highest_degree_achieved }}</p>
                            <p><strong>Institution:</strong> {{ $application->institution_name }}</p>
                            <p><strong>Graduation Year:</strong> {{ $application->graduation_year }}</p>
                            <p><strong>Years of Experience:</strong> {{ $application->years_of_experience }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Employment History</h5>
                            <p><strong>Previous Employer:</strong> {{ $application->previous_employer_name ?? 'Not specified' }}</p>
                            <p><strong>Employment Period:</strong> {{ $application->employment_date_start_end ?? 'Not specified' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Application Details</h5>
                            <p><strong>Desired Salary:</strong> {{ $application->desired_salary ?? 'Not specified' }}</p>
                            <p><strong>Available Start Date:</strong> {{ $application->date_available_to_start }}</p>
                            <p><strong>Subscribe to Updates:</strong> {{ $application->subscribe_to_updates ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Motivation & Comments</h5>
                            <div class="border p-3 rounded">
                                <p><strong>Why Join Us:</strong></p>
                                <p>{{ $application->why_join_us }}</p>

                                @if($application->additional_comments)
                                    <p class="mt-3"><strong>Additional Comments:</strong></p>
                                    <p>{{ $application->additional_comments }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">References</h5>
                            <div class="border p-3 rounded">
                                <p>{{ $application->reference_contact_information ?? 'Not provided' }}</p>
                                @if($application->linkedin_profile)
                                    <p class="mt-2">
                                        <strong>LinkedIn:</strong>
                                        <a href="{{ $application->linkedin_profile }}" target="_blank">{{ $application->linkedin_profile }}</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Documents</h5>
                            <div class="d-flex gap-2">
                                @if($application->resume_path)
                                    <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="btn btn-outline-primary">
                                        <i class="mdi mdi-file-account"></i> View Resume
                                    </a>
                                @endif

                                @if($application->cv_path)
                                    <a href="{{ Storage::url($application->cv_path) }}" target="_blank" class="btn btn-outline-info">
                                        <i class="mdi mdi-file-document"></i> View CV
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin.jobs.applications.index', $job) }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left"></i> Back to Applicants
                            </a>
                            <a onclick="openModalDelete({{ $job->id }}, {{ $application->id }})" class="btn btn-danger">
                                <i class="mdi mdi-delete"></i> Delete Application
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

@section('extra-js')
    <script>
        function openModalDelete(jobId, applicationId) {
            $('.action_form').attr('action', '{{ url('admin/jobs') }}/' + jobId + '/applications/' + applicationId);
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
