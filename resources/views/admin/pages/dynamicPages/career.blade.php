@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Career Page Content</h4>
                    <button type="button" id="languageToggle" class="btn btn-outline-primary">
                        <span class="en-text">Switch to العربية</span>
                        <span class="ar-text" style="display: none;">تبديل إلى English</span>
                    </button>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.dynamicPages.career.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- English Hero Title -->
                                    <div class="mb-3 en-field">
                                        <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('hero_title.en') is-invalid @enderror" name="hero_title[en]"
                                               value="{{ old('hero_title.en', $page->getTranslation('content', 'en')['hero_title'] ?? 'Find A Job That Aligns With Your Interests And Skills') }}">
                                        @error('hero_title.en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Arabic Hero Title -->
                                    <div class="mb-3 ar-field" style="display: none;">
                                        <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('hero_title.ar') is-invalid @enderror" name="hero_title[ar]"
                                               value="{{ old('hero_title.ar', $page->getTranslation('content', 'ar')['hero_title'] ?? 'ابحث عن وظيفة تتماشى مع اهتماماتك ومهاراتك') }}" dir="rtl">
                                        @error('hero_title.ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- English Hero Subtitle -->
                                    <div class="mb-3 en-field">
                                        <label class="form-label">Subtitle (English) <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('hero_subtitle.en') is-invalid @enderror" name="hero_subtitle[en]" rows="4">{{ old('hero_subtitle.en', $page->getTranslation('content', 'en')['hero_subtitle'] ?? 'Work alongside amazing people, and be a part of innovation that makes a real difference in businesses worldwide.') }}</textarea>
                                        @error('hero_subtitle.en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Arabic Hero Subtitle -->
                                    <div class="mb-3 ar-field" style="display: none;">
                                        <label class="form-label">العنوان الفرعي (العربية) <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('hero_subtitle.ar') is-invalid @enderror" name="hero_subtitle[ar]" rows="4" dir="rtl">{{ old('hero_subtitle.ar', $page->getTranslation('content', 'ar')['hero_subtitle'] ?? 'اعمل جنبًا إلى جنب مع أشخاص رائعين، وكن جزءًا من الابتكار الذي يُحدث فرقًا حقيقيًا في الشركات حول العالم.') }}</textarea>
                                        @error('hero_subtitle.ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hero Image</label>
                                        <input type="file" class="form-control @error('hero_image') is-invalid @enderror" name="hero_image" accept="image/*">
                                        @error('hero_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->getTranslation('content', 'en')['hero_image']) && $page->getTranslation('content', 'en')['hero_image'])
                                            <div class="mt-2">
                                                <img src="{{ asset($page->getTranslation('content', 'en')['hero_image']) }}" alt="Hero Image" style="max-width: 200px; max-height: 150px;">
                                                <small class="d-block text-muted">Current image</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Career Page</button>
                                <button type="reset" class="btn btn-light">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const languageToggle = document.getElementById('languageToggle');
            const enFields = document.querySelectorAll('.en-field');
            const arFields = document.querySelectorAll('.ar-field');
            const enTexts = document.querySelectorAll('.en-text');
            const arTexts = document.querySelectorAll('.ar-text');

            let isEnglish = true;

            function toggleLanguage() {
                isEnglish = !isEnglish;

                enFields.forEach(field => {
                    field.style.display = isEnglish ? 'block' : 'none';
                });

                arFields.forEach(field => {
                    field.style.display = isEnglish ? 'none' : 'block';
                });

                enTexts.forEach(text => {
                    text.style.display = isEnglish ? 'inline' : 'none';
                });

                arTexts.forEach(text => {
                    text.style.display = isEnglish ? 'none' : 'inline';
                });
            }

            languageToggle.addEventListener('click', toggleLanguage);
        });
    </script>
@endsection
