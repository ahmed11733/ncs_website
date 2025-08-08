@extends('admin.layouts.app')

@section('title', __('admin.home'))

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">{{__('admin.home')}}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">{{__('admin.id')}}</th>
                                <th scope="col">{{__('admin.user')}}</th>
                                <th scope="col">{{__('admin.username')}}</th>
                                <th scope="col">{{__('admin.status')}}</th>
                                <th scope="col">{{__('admin.image')}}</th>
                                <th scope="col">{{__('admin.name')}}</th>
                                <th scope="col">{{__('admin.email')}}</th>
                                <th scope="col">{{__('admin.phone')}}</th>
                                <th scope="col">{{__('admin.created_at')}}</th>
                                <th scope="col">{{__('admin.more')}}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userRequests as $userRequest)

                                <tr >
                                    <td>{{$userRequest->id}} </td>
                                    <td>{{$userRequest->user->name}} </td>
                                    <td>{{$userRequest->user->username}} </td>
                                    <td>
                                        @if($userRequest->status==\App\Helpers\Constant::STATUS['Pending'])
                                            {{__('admin.pending')}}
                                        @elseif($userRequest->status==\App\Helpers\Constant::STATUS['Approved'])
                                            {{__('admin.approved')}}
                                        @else
                                            {{__('admin.rejected')}}

                                        @endif

                                    </td>

                                    <td><img src="{{$userRequest->image()}}" height="150px" width="150"></td>
                                    <td>
                                        {{$userRequest->request->name}}
                                    </td>


                                    <td>
                                        {{$userRequest->request->email}}
                                    </td>
                                    <td>
                                        {{$userRequest->request->country_code}}{{$userRequest->request->phone}}
                                    </td>
                                    <td>
                                        {{Carbon\Carbon::parse($userRequest->created_at)->locale('ar')->translatedFormat('l dS F G:i - Y')}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            @can('access_update_profile_users_admin')

                                                <a href="{{route('admin.user-requests.edit',$userRequest->id)}}" title="{{__('admin.edit')}}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            @endcan
                                            @can('access_update_profile_users_admin')

                                                <a  onclick="openModalDelete({{$userRequest->id}})" title="{{__('admin.delete')}}" class="text-danger"><i class="mdi mdi-delete font-size-18" ></i></a>
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                    {{$userRequests->withQueryString()->links('admin.pagination.bootstrap-4')}}

                </div>
            </div>
        </div>
    </div>
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
        function openModalDelete(shipper_id) {
            $('.action_form').attr('action', '{{route('admin.user-requests.destroy', '')}}' + '/' + shipper_id);
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
@endsection
