@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($pageSection) ? 'Edit Section' : 'Create Section' }}</h1>

        {{-- Make sure $pageSection exists (null on create) --}}
        @php
            $pageSection = $pageSection ?? null;
        @endphp

        <form action="{{ isset($pageSection) ? route('admin.page-sections.update', $pageSection) : route('admin.page-sections.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($pageSection))
                @method('PUT')
            @endif

            <!-- Page Selection -->
            <div class="mb-3">
                <label class="form-label">Page <span class="text-danger">*</span></label>
                <select name="page_id" class="form-control @error('page_id') is-invalid @enderror" required>
                    <option value="">-- Select Page --</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}"
                            {{ (string) old('page_id', optional($pageSection)->page_id) === (string) $page->id ? 'selected' : '' }}>
                            {{ $page->getTranslation('name','en') }} / {{ $page->getTranslation('name','ar') }}
                        </option>
                    @endforeach
                </select>
                @error('page_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- English Fields -->
            <h5 class="mt-4">English</h5>

            <div class="mb-3">
                <label class="form-label">Label (EN)</label>
                <input type="text"
                       class="form-control @error('label.en') is-invalid @enderror"
                       name="label[en]"
                       value="{{ old('label.en', optional($pageSection)->getTranslation('label','en')) }}">
                @error('label.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Title (EN) <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('title.en') is-invalid @enderror"
                       name="title[en]"
                       value="{{ old('title.en', optional($pageSection)->getTranslation('title','en')) }}"
                       required>
                @error('title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Subtitle (EN)</label>
                <input type="text"
                       class="form-control @error('sub_title.en') is-invalid @enderror"
                       name="sub_title[en]"
                       value="{{ old('sub_title.en', optional($pageSection)->getTranslation('sub_title','en')) }}">
                @error('sub_title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Content (EN)</label>
                <textarea rows="5"
                          id="content_en"
                          class="form-control @error('content.en') is-invalid @enderror"
                          name="content[en]">{{ old('content.en', optional($pageSection)->getTranslation('content','en')) }}</textarea>
                @error('content.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Arabic Fields -->
            <h5 class="mt-4">Arabic</h5>

            <div class="mb-3">
                <label class="form-label">Label (AR)</label>
                <input type="text"
                       class="form-control @error('label.ar') is-invalid @enderror"
                       name="label[ar]"
                       value="{{ old('label.ar', optional($pageSection)->getTranslation('label','ar')) }}">
                @error('label.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Title (AR) <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('title.ar') is-invalid @enderror"
                       name="title[ar]"
                       value="{{ old('title.ar', optional($pageSection)->getTranslation('title','ar')) }}"
                       required>
                @error('title.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Subtitle (AR)</label>
                <input type="text"
                       class="form-control @error('sub_title.ar') is-invalid @enderror"
                       name="sub_title[ar]"
                       value="{{ old('sub_title.ar', optional($pageSection)->getTranslation('sub_title','ar')) }}">
                @error('sub_title.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Content (AR)</label>
                <textarea rows="5"
                          id="content_ar"
                          class="form-control @error('content.ar') is-invalid @enderror"
                          name="content[ar]">{{ old('content.ar', optional($pageSection)->getTranslation('content','ar')) }}</textarea>
                @error('content.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                @if(isset($pageSection) && $pageSection && $pageSection->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $pageSection->image) }}" alt="Section Image" width="150">
                    </div>
                @endif
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Order -->
            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number"
                       class="form-control @error('order') is-invalid @enderror"
                       name="order"
                       value="{{ old('order', optional($pageSection)->order ?? 1) }}">
                @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-success">
                {{ isset($pageSection) ? 'Update Section' : 'Create Section' }}
            </button>
        </form>
    </div>
@endsection

@section('extra-js')
    <!-- CKEditor (optional) -->
    <script src="{{ asset('admin_assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Initialize CKEditor if file exists in public assets
        if (typeof CKEDITOR !== 'undefined') {
            try {
                CKEDITOR.replace('content_en');
            } catch (e) { console.warn(e); }
            try {
                CKEDITOR.replace('content_ar');
            } catch (e) { console.warn(e); }
        }
    </script>
@endsection
