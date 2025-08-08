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
                        <li class="breadcrumb-item active">{{__('admin.guards-profile-requests')}}</li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">



                                    <form action="{{route('admin.user-requests.update',$userRequest->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="mb-3">

                                                    <div class="col-lg-3">
                                                        <img style="width: 150px;height: 150px;" src="{{$userRequest->image()}}">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.name')}}  : </label>
                                                    <input type="text" name="name" @if($userRequest->user->name!=$userRequest->request->name) style="border: 1px solid red;" @endif value="{{$userRequest->request->name}}" disabled  class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.name')}}">
                                                </div>


                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.phone')}}   : </label>
                                                    {{--                                                    <input type="text" name="phone" value="{{old('phone')}}" required class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.phone')}}">--}}
                                                    <div id="input-wrapper">
                                                        <label for="number">+966</label>
                                                        <input type="number" id="number" @if($userRequest->user->phone!=$userRequest->request->phone) style="border: 1px solid red;" @endif name="phone" disabled value="{{$userRequest->request->phone}}" autocomplete="off"  required class="form-control">
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">    {{__('admin.email')}}   :  </label>
                                                    <input type="email" name="email" @if($userRequest->user->email!=$userRequest->request->email) style="border: 1px solid red;" @endif value="{{$userRequest->request->email}}"  disabled class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.email')}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status-input"
                                                           class="form-label">     {{__('admin.status')}} : </label>
                                                    <select id="status-input" class="form-select"
                                                            name="status">
                                                        <option selected=""
                                                                disabled="">  {{__('admin.status')}}</option>
                                                        <option value="{{\App\Helpers\Constant::STATUS['Pending']}}" @if($userRequest->status==\App\Helpers\Constant::STATUS['Pending']) selected @endif >{{__('admin.pending')}}</option>
                                                        <option value="{{\App\Helpers\Constant::STATUS['Approved']}}"  @if($userRequest->status==\App\Helpers\Constant::STATUS['Approved']) selected @endif>{{__('admin.approved')}}</option>
                                                        <option value="{{\App\Helpers\Constant::STATUS['Rejected']}}"  @if($userRequest->status==\App\Helpers\Constant::STATUS['Rejected']) selected @endif>{{__('admin.rejected')}}</option>

                                                    </select>

                                                </div>
                                                @include('admin.errors.error', [ 'input' => 'status' ])

                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"> {{__('admin.edit')}} </button>

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
