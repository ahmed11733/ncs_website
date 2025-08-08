@extends('admin::layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>

@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{__('admin.admins')}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.Dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{__('admin.admins')}}</li>
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



                                    <form action="{{route('admin.update.profile')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="1" name="update">
                                        <div class="row">


                                            <div class="col-sm-12">


                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">   {{__('admin.name')}}  </label>
                                                    <input type="text" name="name" value="{{auth('admin')->user()->name}}" class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.name')}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">    {{__('admin.email')}}   </label>
                                                    <input type="email" name="email" value="{{auth('admin')->user()->email}}" class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.email')}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.password')}}   </label>
                                                    <input name="password" value="{{old('password')}}" type="password" class="form-control" id="formrow-firstname-input" placeholder="{{__('admin.password')}}">
                                                </div>

                                                <div class="col-lg-3">
                                                    <img style="width: 150px;height: 150px;" src="{{auth('admin')->user()->img}}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formrow-firstname-input" class="form-label">     {{__('admin.image')}}  </label>
                                                    <input class="form-control" name="img" type="file" id="formFile">
                                                </div>


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
    <script src="{{asset('admin_assets/js/pages/crypto-orders.init.js')}}"></script>

    <script>
        $("#excel").click(function() {

            $('#form-change').attr("action", "{{route('orders.download-date')}}");
            $('#form-change').submit();
        });
        $("#search").click(function() {
            $('#form-change').attr("action", "{{route('orders.search')}}");
            $('#form-change').submit();

        });


    </script>
    <script src="{{asset('admin_assets/js/jquery.printPage.js') }}"></script>

    <script src="{{asset('admin_assets/js/print.js') }}"></script>

    <script>
        $('.btnprn').printPage();
    </script>
    <script>
        function openModalDelete(admin_id) {
            $('.action_form').attr('action', '{{route('admins.destroy', '')}}' + '/' + admin_id);
            $('#deleteModal').modal('show');

        }
    </script>


@endsection
@component('admin::layouts.includes.modal')
    @slot('modalID')
        deleteModal
    @endslot
    @slot('modalTitle')
        {{__('admin.delete-data')}}
    @endslot
    @slot('modalMethodPutOrDelete')
        @method('delete')
    @endslot
    @slot('modalContent')
        <div class="text-center">
                <span class="text-danger font-16">
                    {{__('admin.delete-message-confirm')}}
                </span>
        </div>
    @endslot
@endcomponent
