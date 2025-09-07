@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit About Us Page Content</h4>
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
                        <form action="{{ route('admin.dynamicPages.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero">Hero Section</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#about">About Section</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#why-choose">Why Choose Us</a></li>
                            </ul>

                            <div class="tab-content p-3">
                                <!-- Hero Section -->
                                <div class="tab-pane active" id="hero" role="tabpanel">
                                    <h5>Hero Section</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- English Hero Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title.en') is-invalid @enderror" name="hero_title[en]"
                                                       value="{{ old('hero_title.en', $page->getTranslation('content', 'en')['hero_title'] ?? 'About Us') }}">
                                                @error('hero_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title.ar') is-invalid @enderror" name="hero_title[ar]"
                                                       value="{{ old('hero_title.ar', $page->getTranslation('content', 'ar')['hero_title'] ?? 'من نحن') }}" dir="rtl">
                                                @error('hero_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Hero Subtitle -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Subtitle (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_subtitle.en') is-invalid @enderror" name="hero_subtitle[en]"
                                                       value="{{ old('hero_subtitle.en', $page->getTranslation('content', 'en')['hero_subtitle'] ?? 'Learn More About Our Company And Our Mission') }}">
                                                @error('hero_subtitle.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Subtitle -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان الفرعي (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_subtitle.ar') is-invalid @enderror" name="hero_subtitle[ar]"
                                                       value="{{ old('hero_subtitle.ar', $page->getTranslation('content', 'ar')['hero_subtitle'] ?? 'تعرف أكثر على شركتنا ومهمتنا') }}" dir="rtl">
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
                                </div>

                                <!-- About Section -->
                                <div class="tab-pane" id="about" role="tabpanel">
                                    <h5>About Section</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- English About Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('about_title.en') is-invalid @enderror" name="about_title[en]"
                                                       value="{{ old('about_title.en', $page->getTranslation('content', 'en')['about_title'] ?? 'About Our Company') }}">
                                                @error('about_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic About Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('about_title.ar') is-invalid @enderror" name="about_title[ar]"
                                                       value="{{ old('about_title.ar', $page->getTranslation('content', 'ar')['about_title'] ?? 'عن شركتنا') }}" dir="rtl">
                                                @error('about_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English About Description -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Description (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('about_description.en') is-invalid @enderror" name="about_description[en]" rows="5">{{ old('about_description.en', $page->getTranslation('content', 'en')['about_description'] ?? 'We are a leading company in our industry with years of experience...') }}</textarea>
                                                @error('about_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic About Description -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الوصف (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('about_description.ar') is-invalid @enderror" name="about_description[ar]" rows="5" dir="rtl">{{ old('about_description.ar', $page->getTranslation('content', 'ar')['about_description'] ?? 'نحن شركة رائدة في مجالنا مع سنوات من الخبرة...') }}</textarea>
                                                @error('about_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">About Image</label>
                                                <input type="file" class="form-control @error('about_image') is-invalid @enderror" name="about_image" accept="image/*">
                                                @error('about_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($page->getTranslation('content', 'en')['about_image']) && $page->getTranslation('content', 'en')['about_image'])
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->getTranslation('content', 'en')['about_image']) }}" alt="About Image" style="max-width: 200px; max-height: 150px;">
                                                        <small class="d-block text-muted">Current image</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Why Choose Us Section -->
                                <div class="tab-pane" id="why-choose" role="tabpanel">
                                    <h5>Why Choose Us Section</h5>

                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <!-- English Why Choose Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Main Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('why_choose_main_title.en') is-invalid @enderror" name="why_choose_main_title[en]"
                                                       value="{{ old('why_choose_main_title.en', $page->getTranslation('content', 'en')['why_choose_title'] ?? 'Why Choose Us') }}">
                                                @error('why_choose_main_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Why Choose Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان الرئيسي (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('why_choose_main_title.ar') is-invalid @enderror" name="why_choose_main_title[ar]"
                                                       value="{{ old('why_choose_main_title.ar', $page->getTranslation('content', 'ar')['why_choose_title'] ?? 'لماذا تختارنا') }}" dir="rtl">
                                                @error('why_choose_main_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Why Choose Subtitle -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Subtitle (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('why_choose_main_subtitle.en') is-invalid @enderror" name="why_choose_main_subtitle[en]"
                                                       value="{{ old('why_choose_main_subtitle.en', $page->getTranslation('content', 'en')['why_choose_subtitle'] ?? 'Discover the reasons why our clients trust us') }}">
                                                @error('why_choose_main_subtitle.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Why Choose Subtitle -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان الفرعي (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('why_choose_main_subtitle.ar') is-invalid @enderror" name="why_choose_main_subtitle[ar]"
                                                       value="{{ old('why_choose_main_subtitle.ar', $page->getTranslation('content', 'ar')['why_choose_subtitle'] ?? 'اكتشف الأسباب التي تجعل عملائنا يثقون بنا') }}" dir="rtl">
                                                @error('why_choose_main_subtitle.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Why Choose Us Items</h6>
                                    <div id="why-choose-items-container">
                                        @php
                                            $items = $page->getTranslation('content', 'en')['why_choose_items'] ?? [];
                                            $itemCount = count($items);
                                            if ($itemCount === 0) $itemCount = 10; // Fixed to 10 items
                                        @endphp

                                        @for($i = 0; $i < 10; $i++)
                                            <div class="card mb-3 why-choose-item">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Item {{ $i + 1 }}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- English Item Title -->
                                                            <div class="mb-3 en-field">
                                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error("why_choose_title.en.$i") is-invalid @enderror" name="why_choose_title[en][]"
                                                                       value="{{ old("why_choose_title.en.$i", $items[$i]['title'] ?? '') }}">
                                                                @error("why_choose_title.en.$i")
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <!-- Arabic Item Title -->
                                                            <div class="mb-3 ar-field" style="display: none;">
                                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error("why_choose_title.ar.$i") is-invalid @enderror" name="why_choose_title[ar][]" dir="rtl"
                                                                       value="{{ old("why_choose_title.ar.$i", $page->getTranslation('content', 'ar')['why_choose_items'][$i]['title'] ?? '') }}">
                                                                @error("why_choose_title.ar.$i")
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Icon</label>
                                                                <input type="file" class="form-control @error("why_choose_icon_$i") is-invalid @enderror" name="why_choose_icon_{{$i}}" accept="image/*">
                                                                @error("why_choose_icon_$i")
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                @if(isset($items[$i]['icon']) && $items[$i]['icon'])
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset($items[$i]['icon']) }}" alt="Item Icon" style="max-width: 50px; max-height: 50px;">
                                                                        <small class="d-block text-muted">Current icon</small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <!-- English Item Description -->
                                                            <div class="mb-3 en-field">
                                                                <label class="form-label">Description (English) <span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error("why_choose_description.en.$i") is-invalid @enderror" name="why_choose_description[en][]" rows="3">{{ old("why_choose_description.en.$i", $items[$i]['description'] ?? '') }}</textarea>
                                                                @error("why_choose_description.en.$i")
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <!-- Arabic Item Description -->
                                                            <div class="mb-3 ar-field" style="display: none;">
                                                                <label class="form-label">الوصف (العربية) <span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error("why_choose_description.ar.$i") is-invalid @enderror" name="why_choose_description[ar][]" rows="3" dir="rtl">{{ old("why_choose_description.ar.$i", $page->getTranslation('content', 'ar')['why_choose_items'][$i]['description'] ?? '') }}</textarea>
                                                                @error("why_choose_description.ar.$i")
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update About Page</button>
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

            // Auto-navigate to tab with errors
                @if($errors->any())
            const errorFields = @json($errors->keys());
            if (errorFields.length > 0) {
                const firstErrorField = errorFields[0];
                const fieldToTabMap = {
                    'hero': ['hero_title.en', 'hero_title.ar', 'hero_subtitle.en', 'hero_subtitle.ar', 'hero_image'],
                    'about': ['about_title.en', 'about_title.ar', 'about_description.en', 'about_description.ar', 'about_image'],
                    'why-choose': ['why_choose_main_title.en', 'why_choose_main_title.ar', 'why_choose_main_subtitle.en', 'why_choose_main_subtitle.ar', 'why_choose_title', 'why_choose_description']
                };

                for (const [tabId, fields] of Object.entries(fieldToTabMap)) {
                    if (fields.some(field => firstErrorField.includes(field))) {
                        const tabLink = document.querySelector(`[href="#${tabId}"]`);
                        if (tabLink) {
                            new bootstrap.Tab(tabLink).show();

                            if (firstErrorField.includes('.ar') && isEnglish) {
                                toggleLanguage();
                            } else if (firstErrorField.includes('.en') && !isEnglish) {
                                toggleLanguage();
                            }
                        }
                        break;
                    }
                }
            }
            @endif
        });
    </script>
@endsection
