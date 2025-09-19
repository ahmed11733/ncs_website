@extends('admin.layouts.app')

@section('title', 'Job Departments')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Job Departments</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Job Departments</li>
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
                            <a href="{{ route('admin.job-departments.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New Department
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th>ID</th>
                                <th>Name (EN)</th>
                                <th>Name (AR)</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->getTranslation('name', 'en') }}</td>
                                    <td>{{ $department->getTranslation('name', 'ar') }}</td>
                                    <td>{{ $department->created_at->format('d M Y - H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.job-departments.edit', $department) }}" class="text-primary" title="Edit">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a onclick="openModalDelete({{ $department->id }})" class="text-danger" title="Delete">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
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
@endsection

@section('extra-js')
    <script>
        function openModalDelete(id) {
            $('.action_form').attr('action', '{{ route('admin.job-departments.destroy', '') }}/' + id);
            $('#deleteModal').modal('show');
        }
    </script>
@endsection

@section('modal')
    @component('admin.layouts.includes.modal')
        @slot('modalID') deleteModal @endslot
        @slot('modalTitle') Delete Department @endslot
        @slot('modalMethodPutOrDelete') @method('delete') @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">Are you sure you want to delete this department?</span>
            </div>
        @endslot
    @endcomponent
@endsection
