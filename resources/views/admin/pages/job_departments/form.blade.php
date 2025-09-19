@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Job Departments</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.job-departments.index')}}">Job Departments</a></li>
                        <li class="breadcrumb-item active">{{ isset($jobDepartment) ? 'Edit Department' : 'Create Department' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($jobDepartment) ? route('admin.job-departments.update', $jobDepartment->id) : route('admin.job-departments.store') }}" method="post">
                        @csrf
                        @if(isset($jobDepartment))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Name (English)</label>
                                    <input type="text" name="name_en"
                                           value="{{ old('name_en', isset($jobDepartment) ? $jobDepartment->getTranslation('name','en') : '') }}"
                                           class="form-control" required placeholder="Department name in English">
                                </div>
                                @include('admin.errors.error', ['input' => 'name_en'])
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Name (Arabic)</label>
                                    <input type="text" name="name_ar"
                                           value="{{ old('name_ar', isset($jobDepartment) ? $jobDepartment->getTranslation('name','ar') : '') }}"
                                           class="form-control" required placeholder="Department name in Arabic">
                                </div>
                                @include('admin.errors.error', ['input' => 'name_ar'])
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">{{ isset($jobDepartment) ? 'Update' : 'Create' }}</button>
                            <a href="{{ route('admin.job-departments.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
