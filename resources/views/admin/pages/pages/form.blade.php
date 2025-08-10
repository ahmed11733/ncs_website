@extends('admin.layouts.app')

@section('title', isset($page) ? 'Edit Page' : 'Create Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ isset($page) ? 'Edit' : 'Create' }} Page</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                        <li class="breadcrumb-item active">{{ isset($page) ? 'Edit' : 'Create' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($page) ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($page))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_category_id" class="form-label">Category</label>
                                    <select name="page_category_id" id="page_category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (isset($page) && $page->page_category_id == $category->id) || old('page_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                           value="{{ isset($page) ? $page->order : old('order') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ isset($page) ? $page->title : old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ isset($page) ? $page->name : old('name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                                           value="{{ isset($page) ? $page->subtitle : old('subtitle') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hero_image" class="form-label">Hero Image</label>
                                    <input type="file" name="hero_image" id="hero_image" class="form-control">
                                    @if(isset($page) && $page->hero_image)
                                        <div class="mt-2">
                                            @php
                                                // Convert full server path back to relative path for display
                                                $relativePath = str_replace(Storage::disk('public')->path(''), '', $page->hero_image);
                                            @endphp
                                            <img src="{{ asset('storage/' . $relativePath) }}"
                                                 alt="Current hero image" style="max-height: 150px;">
                                            <div class="mt-1 text-muted small">
                                                Current image: {{ basename($page->hero_image) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($page) ? 'Update' : 'Create' }} Page
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
