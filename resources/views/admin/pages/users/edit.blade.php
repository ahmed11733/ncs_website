@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>

        #input-wrapper label {
            z-index: 99;
            line-height: 27px;
            padding: 5px;
            position: absolute;
            background: #343b74;
            color:#fff;
        }

        #input-wrapper input {
            text-indent: 35px;
        }
        .form-switch-lg .form-check-input{
            right: 0px !important;
        }
        .form-switch .form-check-input:checked{
            top: 0px !important;
            right: 2.5rem !important;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>






@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{__('admin.guards')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.Dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.guards')}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card card-body overflow-hidden">
                <div class="bg-primary bg-soft">
                    <div class="row">
                        <div class="col-4 align-self-end">
                        </div>
                        <div class="col-4 align-self-end">
                            <img src="{{$user->image()}}" alt="" class="img-fluid">
                        </div>
                        <div class="col-4 align-self-end">
                        </div>

                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- end card -->

            <!-- end card -->
        </div>
        <div class="col-xl-4">
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{__('admin.Personal Information')}}</h4>

                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <th scope="row">{{__('admin.name')}} :</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('admin.phone')}} :</th>
                                <td>{{$user->country_code}} {{$user->phone}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('admin.email')}} :</th>
                                <td>{{$user->email??__('admin.no-data-available')}} </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- end card -->
        </div>
        <div class="col-xl-4">
            <!-- end card -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{__('admin.job-information')}}</h4>

                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            @if($user->branch)
                            <tr>
                                <th scope="row">{{__('admin.branch')}} :</th>
                                <td><a target="_blank" href="{{route('admin.branches.edit',$user->branch->id)}}">{{$user->branch->name}}</a></td>
                            </tr>
                            @else
                            <tr>
                                <th scope="row">{{__('admin.branch')}} :</th>
                                <td><a >{{__('admin.no_exist')}}</a></td>
                            </tr>
                            @endif
                            <tr>
                                <th scope="row">{{__('admin.salary')}} :</th>
                                <td>{{$user->salary}} {{__('admin.app-currency')}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{__('admin.working_hours')}} :</th>
                                <td>{{$user->working_hours}} {{__('admin.hours')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- end card -->

            <!-- end card -->
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">



                                    <form action="{{route('admin.users.update',$user->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input"
                                                           class="form-label">    {{__('admin.img')}}  </label>
                                                    <input class="form-control" type="file" name="image"   id="formFile">

                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'image' ])

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.name')}}  : </label>
                                                    <input type="text" name="name" value="{{$user->name}}" required class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.name')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'name' ])

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.username')}}  :  </label>
                                                    <input type="text" name="username" value="{{$user->username}}" autocomplete="off" required class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.username')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'username' ])

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.phone')}}   : </label>
                                                    {{--                                                    <input type="text" name="phone" value="{{old('phone')}}" required class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.phone')}}">--}}
                                                    <div id="input-wrapper">
                                                        <label for="number">+966</label>
                                                        <input type="number" id="number" name="phone" value="{{$user->phone}}" autocomplete="off"  required class="form-control">
                                                    </div>

                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'phone' ])

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.password')}}   :   </label>
                                                    <input name="password" value="{{old('password')}}" autocomplete="off"  type="password" class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.password')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'password' ])


                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">    {{__('admin.email')}}   :  </label>
                                                    <input type="email" name="email" value="{{$user->email}}"  required class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.email')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'email' ])

                                                <div class="mb-3" >
                                                    <label for="salary-input" class="form-label">   {{__('admin.salary')}}  :   </label>
                                                    <input type="number" name="salary" value="{{$user->salary}}" required class="form-control" id="salary-input" placeholder="{{__('admin.salary')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'salary' ])
                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.permissions')}}  :   </label>
                                                    <select  required id="multiple" class="js-states form-control" multiple name="permissions[]" >
                                                        <option selected="" disabled="">  {{__('admin.choose-permissions')}}</option>
                                                        @foreach($permissions as $permission)
                                                            <option @if(in_array($permission->id,$user->getAllPermissions()->pluck('id')->toArray())) selected @endif value="{{$permission->name}}">{{__('admin.'.$permission->name)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'permissions' ])

                                            </div>
                                            <div class="col-sm-6">

{{--                                                <div class="mb-3">--}}
{{--                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.branches')}}  :   </label>--}}
{{--                                                    <select id="formrow-inputState" required class="form-select" name="branch_id" >--}}
{{--                                                        <option selected="" disabled="">  {{__('admin.branches')}}</option>--}}
{{--                                                        @foreach($branches as $branch)--}}
{{--                                                            <option @if($branch->id==$user->branch_id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>--}}
{{--                                                        @endforeach--}}

{{--                                                    </select>--}}

{{--                                                </div>--}}
{{--                                                @include('admin.errors.error', [ 'input' => 'branch_id' ])--}}
                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.companies')}}  :   </label>
                                                    <select id="formrow-inputState"  class="form-select" name="company_id" >
                                                        <option selected="" disabled="">  {{__('admin.companies')}}</option>
                                                        @foreach($companies as $company)
                                                            <option  @if($company->id==$user->company_id) selected @endif  value="{{$company->id}}">{{$company->name}}</option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'company_id' ])

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.has_overtime')}}  :   </label>

                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input class="form-check-input" type="checkbox" @if($user->has_over_time==\App\Helpers\Constant::HAS_OVER_TIME['True']) checked value="No" @else value="Yes"@endif name="has_over_time"    onclick="ShowHideDiv(this)">

                                                    </div>
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'has_overtime' ])

                                                <div class="mb-3" id="overtime_div" @if($user->has_over_time==\App\Helpers\Constant::HAS_OVER_TIME['False']) style="display: none" @endif>
                                                    <label for="over_time_hour_price-input" class="form-label">   {{__('admin.over_time_hour_price')}}  :  </label>
                                                    <input type="number" name="over_time_hour_price" value="{{$user->over_time_hour_price}}"  maxlength="10000" class="form-control" id="over_time_hour_price-input" placeholder="{{__('admin.over_time_hour_price')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'over_time_hour_price' ])


                                                <div class="mb-3" >
                                                    <label for="vacations-input" class="form-label">   {{__('admin.vacations')}}  :  </label>
                                                    <input type="number" name="vacations" value="{{$user->vacations}}" required class="form-control" id="vacations-input" placeholder="{{__('admin.vacations')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'vacations' ])

                                                <div class="mb-3" >
                                                    <label for="working_hours-input" class="form-label">   {{__('admin.working_hours')}}   : </label>
                                                    <input type="number" name="working_hours" value="{{$user->working_hours}}" required class="form-control" id="working_hours-input" placeholder="{{__('admin.working_hours')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'working_hours' ])
                                                <div class="mb-3">
                                                    <label for="work_start_from-input"
                                                           class="form-label">   {{__('admin.work_start_from')}}
                                                        : </label>
                                                    <input type="time" value="{{$user->work_start_from}}" class="form-control"
                                                           name="work_start_from" min="00:00" max="23:59"
                                                           placeholder="{{__('admin.work_start_from')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'work_start_from' ])
                                                <div class="mb-3">
                                                    <label for="work_start_to-input"
                                                           class="form-label">   {{__('admin.work_start_to')}}
                                                        : </label>
                                                    <input type="time" value="{{$user->work_start_to}}" class="form-control"
                                                           name="work_start_to" min="00:00" max="23:59"
                                                           placeholder="{{__('admin.work_start_to')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'work_start_to' ])
                                                <div class="mb-3">
                                                    <label for="work_late_duration-input"
                                                           class="form-label">   {{__('admin.work_late_duration')}} : </label>
                                                    <input type="number" name="work_late_duration" value="{{$user->work_late_duration}}"
                                                           required class="form-control" id="work_late_duration-input"
                                                           placeholder="{{__('admin.work_late_duration')}}">
                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'work_late_duration' ])

                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"> {{__('admin.add')}} </button>

                                        </div>

                                    </form>

                                </div>
                            </div>


                        </div>
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

    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- init js -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $("#multiple").select2({
            placeholder: "{{__('admin.choose')}}",
            allowClear: true
        });
    </script>
    <script type="text/javascript">
        function ShowHideDiv(btnPassport) {
            var dvPassport = document.getElementById("overtime_div");
            if (btnPassport.value == "Yes") {
                dvPassport.style.display = "block";
                btnPassport.value = "No";
            } else {
                dvPassport.style.display = "none";
                btnPassport.value = "Yes";
            }
        }
    </script>

@endsection
