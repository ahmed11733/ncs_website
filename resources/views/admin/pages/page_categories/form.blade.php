@extends('admin.layouts.app')

@section('title', isset($pageCategory) ? 'Edit Page Category' : 'Create Page Category')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST"
                          action="{{ isset($pageCategory) ? route('admin.page-categories.update', $pageCategory) : route('admin.page-categories.store') }}">
                        @csrf
                        @if(isset($pageCategory))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name_en" class="form-label">Name (English)</label>
                            <input type="text"
                                   class="form-control @error('name.en') is-invalid @enderror"
                                   id="name_en"
                                   name="name[en]"
                                   value="{{ old('name.en', isset($pageCategory) ? $pageCategory->getTranslation('name','en') : '') }}">
                            @error('name.en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Name (Arabic)</label>
                            <input type="text"
                                   class="form-control @error('name.ar') is-invalid @enderror"
                                   id="name_ar"
                                   name="name[ar]"
                                   value="{{ old('name.ar', isset($pageCategory) ? $pageCategory->getTranslation('name','ar') : '') }}">
                            @error('name.ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($pageCategory) ? 'Update' : 'Create' }}
                            </button>
                            <a href="{{ route('admin.page-categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
