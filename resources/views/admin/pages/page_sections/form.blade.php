@extends('admin.layouts.app')

@section('title', isset($pageSection) ? 'Edit Section' : 'Create Section')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ isset($pageSection) ? 'Edit' : 'Create' }} Page Section</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.page-sections.index')}}">Page Sections</a></li>
                        <li class="breadcrumb-item active">{{ isset($pageSection) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($pageSection) ? route('admin.page-sections.update', $pageSection->id) : route('admin.page-sections.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($pageSection))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_id" class="form-label">Page</label>
                                    <select name="page_id" id="page_id" class="form-select" required>
                                        <option value="">Select Page</option>
                                        @foreach($pages as $page)
                                            <option value="{{ $page->id }}"
                                                {{ (isset($pageSection) && $pageSection->page_id == $page->id) || old('page_id') == $page->id ? 'selected' : '' }}>
                                                {{ $page->name .' - '. $page->category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                           value="{{ isset($pageSection) ? $pageSection->order : old('order') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ isset($pageSection) ? $pageSection->title : old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="sub_title" class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" id="sub_title" class="form-control"
                                           value="{{ isset($pageSection) ? $pageSection->sub_title : old('sub_title') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="label" class="form-label">Label</label>
                                    <input type="text" name="label" id="label" class="form-control"
                                           value="{{ isset($pageSection) ? $pageSection->label : old('label') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if(isset($pageSection) && $pageSection->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $pageSection->image) }}"
                                                 alt="Current section image" style="max-height: 150px;">
                                            <div class="mt-1 text-muted small">
                                                Current image: {{ basename($pageSection->image) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ isset($pageSection) ? $pageSection->content : old('content') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.page-sections.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($pageSection) ? 'Update' : 'Create' }} Section
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <!-- CKEditor JS -->
    <script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Initialize CKEditor for content textarea
            CKEDITOR.replace('content');
        });
    </script>
@endsection
