@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">
                            {{ isset($job) ? 'Edit Job' : 'Create Job' }}
                        </h4>

                        {{-- Show global validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ isset($job) ? route('admin.jobs.update', $job->id) : route('admin.jobs.store') }}"
                              method="POST">
                            @csrf
                            @if(isset($job))
                                @method('PUT')
                            @endif

                            <div class="row">

                                {{-- Department --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Department</label>
                                    <select name="department_id" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}"
                                                {{ old('department_id', isset($job) ? $job->department_id : '') == $department->id ? 'selected' : '' }}>
                                                {{ $department->getTranslation('name', 'en') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Experience Years --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Experience Years</label>
                                    <input type="number" name="experience_years" class="form-control"
                                           value="{{ old('experience_years', isset($job) ? $job->experience_years : '') }}" required>
                                    @error('experience_years')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Age --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control"
                                           value="{{ old('age', isset($job) ? $job->age : '') }}">
                                    @error('age')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Last Date --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Date</label>
                                    <input type="date" name="last_date" class="form-control"
                                           value="{{ old('last_date', isset($job) ? $job->last_date->format('Y-m-d') : '') }}" required>
                                    @error('last_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr class="mt-4 mb-3">

                                {{-- Title --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Title (EN)</label>
                                    <input type="text" name="title_en" class="form-control"
                                           value="{{ old('title_en', isset($job) ? $job->getTranslation('title','en') : '') }}" required>
                                    @error('title_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Title (AR)</label>
                                    <input type="text" name="title_ar" class="form-control"
                                           value="{{ old('title_ar', isset($job) ? $job->getTranslation('title','ar') : '') }}" required>
                                    @error('title_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Job Description --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Description (EN)</label>
                                    <textarea name="job_description_en" rows="3" class="form-control" required>{{ old('job_description_en', isset($job) ? $job->getTranslation('job_description','en') : '') }}</textarea>
                                    @error('job_description_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Job Description (AR)</label>
                                    <textarea name="job_description_ar" rows="3" class="form-control" required>{{ old('job_description_ar', isset($job) ? $job->getTranslation('job_description','ar') : '') }}</textarea>
                                    @error('job_description_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Skills --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Skills (EN)</label>
                                    <input type="text" name="skills_en" class="form-control"
                                           value="{{ old('skills_en', isset($job) ? $job->getTranslation('skills','en') : '') }}">
                                    @error('skills_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Skills (AR)</label>
                                    <input type="text" name="skills_ar" class="form-control"
                                           value="{{ old('skills_ar', isset($job) ? $job->getTranslation('skills','ar') : '') }}">
                                    @error('skills_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nationality --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nationality (EN)</label>
                                    <input type="text" name="nationality_en" class="form-control"
                                           value="{{ old('nationality_en', isset($job) ? $job->getTranslation('nationality','en') : '') }}">
                                    @error('nationality_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nationality (AR)</label>
                                    <input type="text" name="nationality_ar" class="form-control"
                                           value="{{ old('nationality_ar', isset($job) ? $job->getTranslation('nationality','ar') : '') }}">
                                    @error('nationality_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Certificate --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Certificate (EN)</label>
                                    <input type="text" name="certificate_en" class="form-control"
                                           value="{{ old('certificate_en', isset($job) ? $job->getTranslation('certificate','en') : '') }}">
                                    @error('certificate_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Certificate (AR)</label>
                                    <input type="text" name="certificate_ar" class="form-control"
                                           value="{{ old('certificate_ar', isset($job) ? $job->getTranslation('certificate','ar') : '') }}">
                                    @error('certificate_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Specialization --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Specialization (EN)</label>
                                    <input type="text" name="specialization_en" class="form-control"
                                           value="{{ old('specialization_en', isset($job) ? $job->getTranslation('specialization','en') : '') }}">
                                    @error('specialization_en')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Specialization (AR)</label>
                                    <input type="text" name="specialization_ar" class="form-control"
                                           value="{{ old('specialization_ar', isset($job) ? $job->getTranslation('specialization','ar') : '') }}">
                                    @error('specialization_ar')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($job) ? 'Update Job' : 'Create Job' }}
                                </button>
                                <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
