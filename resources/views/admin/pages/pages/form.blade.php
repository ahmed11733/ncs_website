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
                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="page_category_id" class="form-label">Category</label>
                                    <select name="page_category_id" id="page_category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (isset($page) && $page->page_category_id == $category->id) || old('page_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->getTranslation('name', app()->getLocale()) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Order --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                           value="{{ isset($page) ? $page->order : old('order') }}" required>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_en" class="form-label">Name (English)</label>
                                    <input type="text" name="name[en]" id="name_en" class="form-control"
                                           value="{{ old('name.en', isset($page) ? $page->getTranslation('name','en') : '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_ar" class="form-label">Name (Arabic)</label>
                                    <input type="text" name="name[ar]" id="name_ar" class="form-control"
                                           value="{{ old('name.ar', isset($page) ? $page->getTranslation('name','ar') : '') }}" required>
                                </div>
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_en" class="form-label">Title (English)</label>
                                    <input type="text" name="title[en]" id="title_en" class="form-control"
                                           value="{{ old('title.en', isset($page) ? $page->getTranslation('title','en') : '') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title_ar" class="form-label">Title (Arabic)</label>
                                    <input type="text" name="title[ar]" id="title_ar" class="form-control"
                                           value="{{ old('title.ar', isset($page) ? $page->getTranslation('title','ar') : '') }}" required>
                                </div>
                            </div>

                            {{-- Subtitle --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle_en" class="form-label">Subtitle (English)</label>
                                    <input type="text" name="subtitle[en]" id="subtitle_en" class="form-control"
                                           value="{{ old('subtitle.en', isset($page) ? $page->getTranslation('subtitle','en') : '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle_ar" class="form-label">Subtitle (Arabic)</label>
                                    <input type="text" name="subtitle[ar]" id="subtitle_ar" class="form-control"
                                           value="{{ old('subtitle.ar', isset($page) ? $page->getTranslation('subtitle','ar') : '') }}">
                                </div>
                            </div>

                            {{-- Hero Image --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hero_image" class="form-label">Hero Image</label>
                                    <input type="file" name="hero_image" id="hero_image" class="form-control">
                                    @if(isset($page) && $page->hero_image)
                                        <div class="mt-2">
                                            <img src="{{$page->hero_image}}"
                                                 alt="Current hero image" style="max-height: 150px;">
                                            <div class="mt-1 text-muted small">
                                                Current image: {{ basename($page->hero_image) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($page) ? 'Update' : 'Create' }} Page
                                    </button>
                                </div>
                            </div>

                        </div> {{-- row --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
