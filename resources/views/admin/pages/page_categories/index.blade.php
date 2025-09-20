@extends('admin.layouts.app')

@section('title', 'Page Categories')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Page Categories</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Page Categories</li>
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
                            <a href="{{ route('admin.page-categories.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New Category
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">ID</th>
                                <th scope="col">Name (Pages Count)</th>
                                <th scope="col">Created At</th>
                                <th scope="col">More</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        {{ $category->getTranslation('name', app()->getLocale()) }}
                                        @if(count($category->pages))
                                            ({{ count($category->pages) }})
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.page-categories.edit', $category) }}" title="Edit" class="text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a onclick="openModalDelete({{$category->id}})" title="Delete" class="text-danger">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                            <a href="{{ route('admin.pages.index', ['category_id' => $category->id]) }}"
                                               title="View Pages"
                                               class="text-info">
                                                <i class="mdi mdi-file-document-outline font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$categories->withQueryString()->links('admin.pagination.bootstrap-4')}}
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
        function openModalDelete(category_id) {
            $('.action_form').attr('action', '{{route('admin.page-categories.destroy', '')}}' + '/' + category_id);
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
            Delete Category
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    Are you sure you want to delete this category?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
