@extends('admin.layouts.app')

@section('title', 'Page Sections')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Page Sections</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Page Sections</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('admin.page-sections.index') }}" class="form-inline d-flex align-items-center">
                                <select name="page_id" class="form-select me-2 flex-grow-1">
                                    <option value="">All Pages</option>
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}" {{ request('page_id') == $page->id ? 'selected' : '' }}>
                                            {{ $page->name .' - '. $page->category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.page-sections.create') }}" class="btn btn-success">
                                <i class="mdi mdi-plus-circle-outline"></i> Create New Section
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover dt-responsive nowrap">
                            <thead>
                            <tr class="tr-colored">
                                <th>ID</th>
                                <th>Page</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{ $section->id }}</td>
                                    <td>{{ $section->page->name }}</td>
                                    <td>{{ $section->title }}</td>
                                    <td>{{ $section->order }}</td>
                                    <td>{{ $section->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.page-sections.edit', $section) }}"
                                               title="Edit"
                                               class="text-primary">
                                                <i class="mdi mdi-pencil font-size-18"></i>
                                            </a>

                                            <a onclick="openModalDeleteSection({{ $section->id }})"
                                               title="Delete"
                                               class="text-danger">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $sections->appends(request()->query())->links('admin.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script>
        function openModalDeleteSection(section_id) {
            $('.action_form').attr('action', '{{ route("admin.page-sections.destroy", "") }}' + '/' + section_id);
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
                    Are you sure you want to delete this section?
                </span>
            </div>
        @endslot
    @endcomponent
@endsection
