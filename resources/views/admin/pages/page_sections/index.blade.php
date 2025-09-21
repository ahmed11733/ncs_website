@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Page Sections</h1>
            <a href="{{ route('admin.page-sections.create') }}" class="btn btn-primary">+ Add Section</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Page</th>
                <th>Label (EN)</th>
                <th>Label (AR)</th>
                <th>Title (EN)</th>
                <th>Title (AR)</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($sections as $section)
                <tr>
                    <td>{{ $section->id }}</td>
                    <td>{{ $section->page->name }}</td>
                    <td>{{ $section->getTranslation('label', 'en') }}</td>
                    <td>{{ $section->getTranslation('label', 'ar') }}</td>
                    <td>{{ $section->getTranslation('title', 'en') }}</td>
                    <td>{{ $section->getTranslation('title', 'ar') }}</td>
                    <td>{{ $section->order }}</td>
                    <td>
                        <a href="{{ route('admin.page-sections.edit', $section) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.page-sections.destroy', $section) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No sections found</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
