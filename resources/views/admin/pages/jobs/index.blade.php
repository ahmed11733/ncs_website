@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">Jobs</h4>
                            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> Add Job
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title (EN)</th>
                                    <th>Department</th>
                                    <th>Experience</th>
                                    <th>Last Date</th>
                                    <th>Age</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($jobs as $job)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $job->getTranslation('title', 'en') }}</td>
                                        <td>{{ $job->department?->getTranslation('name', 'en') }}</td>
                                        <td>{{ $job->experience_years ? $job->experience_years . ' yrs' : '-' }}</td>
                                        <td>{{ $job->last_date ? $job->last_date->format('Y-m-d') : '-' }}</td>
                                        <td>{{ $job->age ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-sm btn-info">
                                                <i class="bx bx-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No jobs found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
