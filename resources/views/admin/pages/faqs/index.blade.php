@extends('admin.layouts.app')

@section('title', 'FAQs')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">FAQs</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">FAQs</li>
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
                            <a href="{{ route('admin.faqs.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New FAQ
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">ID</th>
                                <th scope="col">Title (EN)</th>
                                <th scope="col">Title (AR)</th>
                                <th scope="col">Order</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td>{{ $faq->getTranslation('title', 'en') }}</td>
                                    <td>{{ $faq->getTranslation('title', 'ar') }}</td>
                                    <td>{{ $faq->order }}</td>
                                    <td>{{ \Carbon\Carbon::parse($faq->created_at)->locale('en')->translatedFormat('l dS F G:i - Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.faqs.edit', $faq) }}" title="Edit" class="text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a onclick="openModalDelete({{$faq->id}})" title="Delete"
                                               class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
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
    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- init js -->
    <script src="{{asset('admin_assets/js/pages/crypto-orders.init.js')}}"></script>

    <script>
        function openModalDelete(faq_id) {
            $('.action_form').attr('action', '{{route('admin.faqs.destroy', '')}}' + '/' + faq_id);
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
            Delete FAQ
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    Are you sure you want to delete this FAQ?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
