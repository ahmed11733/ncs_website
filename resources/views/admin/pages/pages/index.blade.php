@extends('admin.layouts.app')

@section('title', 'Pages')

@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="javascript:" class="text-muted text-hover-primary">Home</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Pages</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
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
                        <div class="col-sm-6">
                            <form method="GET" action="{{ route('admin.pages.index') }}" class="form-inline d-flex align-items-center">
                                <select name="category_id" class="form-select me-2 flex-grow-1">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New Page
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr class="tr-colored">
                                <th scope="col">ID</th>
                                <th scope="col">Category</th>
                                <th scope="col">Name (Sections count)</th>
                                <th scope="col">Order</th>
                                <th scope="col">Created At</th>
                                <th scope="col">More</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->category->name }}</td>
                                    <td>{{ $page->name . (count($page->sections) ? ' (' .count($page->sections).')' : '') }}</td>
                                    <td>{{ $page->order }}</td>
                                    <td>{{ $page->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.pages.edit', $page) }}" title="Edit" class="text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>
                                            <a onclick="openModalDelete({{$page->id}})" title="Delete" class="text-danger">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                            <a href="{{ route('admin.page-sections.index', ['page_id' => $page->id]) }}"
                                               title="Page Sections"
                                               class="text-info">
                                                <i class="mdi mdi-file-tree font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$pages->withQueryString()->links('admin.pagination.bootstrap-4')}}
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
        function openModalDelete(page_id) {
            $('.action_form').attr('action', '{{route('admin.pages.destroy', '')}}' + '/' + page_id);
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
            Delete Page
        @endslot
        @slot('modalMethodPutOrDelete')
            @method('delete')
        @endslot
        @slot('modalContent')
            <div class="text-center">
                <span class="text-danger font-16">
                    Are you sure you want to delete this page?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
