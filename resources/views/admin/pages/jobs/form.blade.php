@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <!-- CKEditor CSS -->
    <link href="{{asset('admin_assets/libs/ckeditor/skins/moono-lisa/editor.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .alert-text{
            color: red;
            font-size: 15px;
            font-weight: bolder;
        }
    </style>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Jobs Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="crypto-buy-sell-nav">
                        <p id="alert-text" class="alert-text"></p>
                        <form action="{{isset($job) ? route('admin.jobs.update', $job->id) : route('admin.jobs.store')}}" id="form-data" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($job))
                                @method('PUT')
                            @endif

                            <div class="tab-content crypto-buy-sell-nav-content p-4">
                                <div class="tab-pane active" id="buy" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="department_id" class="form-label">Department</label>
                                                <select name="department_id" class="form-select" id="department_id" required>
                                                    <option value="">Select Department</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{$department->id}}" {{(isset($job) && $job->department_id == $department->id) || old('department_id') == $department->id ? 'selected' : ''}}>
                                                            {{$department->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'department_id'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Job Title</label>
                                                <input type="text" name="title" value="{{isset($job) ? $job->title : old('title')}}"
                                                       class="form-control" id="title" required
                                                       placeholder="Job Title">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'title'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="experience_years" class="form-label">Experience Years</label>
                                                <input type="number" name="experience_years" value="{{isset($job) ? $job->experience_years : old('experience_years')}}"
                                                       class="form-control" id="experience_years" required
                                                       placeholder="Required years of experience">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'experience_years'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="last_date" class="form-label">Last Date to Apply</label>
                                                <input type="date" name="last_date"
                                                       value="{{ isset($job) ? \Carbon\Carbon::parse($job->last_date)->format('Y-m-d') : old('last_date') }}"
                                                       class="form-control" id="last_date" required>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'last_date'])
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="job_description" class="form-label">Job Description</label>
                                                <textarea name="job_description" class="form-control ckeditor" id="job_description"
                                                          rows="5" required>{{isset($job) ? $job->job_description : old('job_description')}}</textarea>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'job_description'])
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="skills" class="form-label">Required Skills</label>
                                                <textarea name="skills" class="form-control ckeditor" id="skills"
                                                          rows="5" required>{{isset($job) ? $job->skills : old('skills')}}</textarea>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'skills'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="nationality" class="form-label">Preferred Nationality</label>
                                                <input type="text" name="nationality" value="{{isset($job) ? $job->nationality : old('nationality')}}"
                                                       class="form-control" id="nationality"
                                                       placeholder="Preferred nationality (optional)">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'nationality'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="certificate" class="form-label">Required Certificate</label>
                                                <input type="text" name="certificate" value="{{isset($job) ? $job->certificate : old('certificate')}}"
                                                       class="form-control" id="certificate"
                                                       placeholder="Required certificate (optional)">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'certificate'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="age" class="form-label">Preferred Age</label>
                                                <input type="number" name="age" value="{{isset($job) ? $job->age : old('age')}}"
                                                       class="form-control" id="age"
                                                       placeholder="Preferred age range (optional)">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'age'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="specialization" class="form-label">Specialization</label>
                                                <input type="text" name="specialization" value="{{isset($job) ? $job->specialization : old('specialization')}}"
                                                       class="form-control" id="specialization"
                                                       placeholder="Required specialization (optional)">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'specialization'])
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" id="submit-button"
                                            class="btn btn-primary waves-effect waves-light">
                                        {{isset($job) ? 'Update Job' : 'Add Job'}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('extra-js')
    <script src="{{asset('admin_assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- bootstrap-datepicker js -->
    <script src="{{asset('admin_assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- CKEditor JS -->
    <script src="{{asset('admin_assets/libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('admin_assets/libs/ckeditor/adapters/jquery.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // Initialize CKEditor for textareas with class 'ckeditor'
            $('.ckeditor').ckeditor();

            // Set minimum date for last_date field (today)
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("last_date").min = today;
        });
    </script>
@endsection
