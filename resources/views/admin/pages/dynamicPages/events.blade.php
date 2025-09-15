@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Events Page Content</h4>
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
                        <form action="{{ route('admin.dynamicPages.events.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero">Hero Section</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#main">Main Content</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#learning">Learning Objectives</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#featured">Featured Event</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#card">Event Card</a></li>
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
                                                       value="{{ old('hero_title.en', $page->getTranslation('content', 'en')['hero_title'] ?? 'Where Technology Meets Opportunity') }}">
                                                @error('hero_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title.ar') is-invalid @enderror" name="hero_title[ar]"
                                                       value="{{ old('hero_title.ar', $page->getTranslation('content', 'ar')['hero_title'] ?? 'حيث تلتقي التكنولوجيا بالفرصة') }}" dir="rtl">
                                                @error('hero_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Hero Subtitle -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Subtitle (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('hero_subtitle.en') is-invalid @enderror" name="hero_subtitle[en]" rows="3">{{ old('hero_subtitle.en', $page->getTranslation('content', 'en')['hero_subtitle'] ?? 'Explore our latest events, workshops, and summits designed to inspire and connect tech leaders.') }}</textarea>
                                                @error('hero_subtitle.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Subtitle -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان الفرعي (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('hero_subtitle.ar') is-invalid @enderror" name="hero_subtitle[ar]" rows="3" dir="rtl">{{ old('hero_subtitle.ar', $page->getTranslation('content', 'ar')['hero_subtitle'] ?? 'استكشف أحدث فعالياتنا وورش العمل والقمم المصممة لإلهام وقادة التكنولوجيا.') }}</textarea>
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

                                <!-- Main Content Section -->
                                <div class="tab-pane" id="main" role="tabpanel">
                                    <h5>Main Content Section</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- English Main Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('main_title.en') is-invalid @enderror" name="main_title[en]"
                                                       value="{{ old('main_title.en', $page->getTranslation('content', 'en')['main_title'] ?? 'Unmissable Experiences for Every Tech Enthusiast') }}">
                                                @error('main_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Main Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('main_title.ar') is-invalid @enderror" name="main_title[ar]"
                                                       value="{{ old('main_title.ar', $page->getTranslation('content', 'ar')['main_title'] ?? 'تجارب لا يمكن تفويتها لكل محبي التكنولوجيا') }}" dir="rtl">
                                                @error('main_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Main Description -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Description (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('main_description.en') is-invalid @enderror" name="main_description[en]" rows="5">{{ old('main_description.en', $page->getTranslation('content', 'en')['main_description'] ?? 'Discover our upcoming events designed to keep you at the forefront of technology. From conferences and webinars to hands-on workshops, each experience is crafted to inspire innovation, build expertise, and connect you with industry leaders and lead with confidence in a rapidly evolving digital world.') }}</textarea>
                                                @error('main_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Main Description -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الوصف (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('main_description.ar') is-invalid @enderror" name="main_description[ar]" rows="5" dir="rtl">{{ old('main_description.ar', $page->getTranslation('content', 'ar')['main_description'] ?? 'اكتشف فعالياتنا القادمة المصممة لإبقائك في طليعة التكنولوجيا. من المؤتمرات والندوات عبر الإنترنت إلى ورش العمل العملية، تم تصميم كل تجربة لإلهام الابتكار وبناء الخبرة وتوصلك بقادة الصناعة.') }}</textarea>
                                                @error('main_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Learning Objectives Section -->
                                <div class="tab-pane" id="learning" role="tabpanel">
                                    <h5>Learning Objectives Section</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- English Learning Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('learning_title.en') is-invalid @enderror" name="learning_title[en]"
                                                       value="{{ old('learning_title.en', $page->getTranslation('content', 'en')['learning_title'] ?? 'What will you learn?') }}">
                                                @error('learning_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Learning Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('learning_title.ar') is-invalid @enderror" name="learning_title[ar]"
                                                       value="{{ old('learning_title.ar', $page->getTranslation('content', 'ar')['learning_title'] ?? 'ماذا سوف تتعلم؟') }}" dir="rtl">
                                                @error('learning_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <h6>Learning Points</h6>
                                            @php
                                                $learningPointsEn = $page->getTranslation('content', 'en')['learning_points'] ?? [];
                                                $learningPointsAr = $page->getTranslation('content', 'ar')['learning_points'] ?? [];
                                                $pointCount = max(count($learningPointsEn), count($learningPointsAr), 6);
                                            @endphp

                                            @for($i = 0; $i < $pointCount; $i++)
                                                <div class="card mb-3 learning-point-item">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Point {{ $i + 1 }}</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <!-- English Learning Point -->
                                                                <div class="mb-3 en-field">
                                                                    <label class="form-label">Point (English) <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control @error("learning_points.en.$i") is-invalid @enderror" name="learning_points[en][]" rows="2">{{ old("learning_points.en.$i", $learningPointsEn[$i] ?? '') }}</textarea>
                                                                    @error("learning_points.en.$i")
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <!-- Arabic Learning Point -->
                                                                <div class="mb-3 ar-field" style="display: none;">
                                                                    <label class="form-label">النقطة (العربية) <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control @error("learning_points.ar.$i") is-invalid @enderror" name="learning_points[ar][]" rows="2" dir="rtl">{{ old("learning_points.ar.$i", $learningPointsAr[$i] ?? '') }}</textarea>
                                                                    @error("learning_points.ar.$i")
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

                                <!-- Featured Event Section -->
                                <div class="tab-pane" id="featured" role="tabpanel">
                                    <h5>Featured Event Section</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- English Featured Event Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_title.en') is-invalid @enderror" name="featured_event_title[en]"
                                                       value="{{ old('featured_event_title.en', $page->getTranslation('content', 'en')['featured_event_title'] ?? 'Tech Innovation Day 2025') }}">
                                                @error('featured_event_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Featured Event Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_title.ar') is-invalid @enderror" name="featured_event_title[ar]"
                                                       value="{{ old('featured_event_title.ar', $page->getTranslation('content', 'ar')['featured_event_title'] ?? 'يوم الابتكار التكنولوجي 2025') }}" dir="rtl">
                                                @error('featured_event_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Featured Event Date -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Date (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_date.en') is-invalid @enderror" name="featured_event_date[en]"
                                                       value="{{ old('featured_event_date.en', $page->getTranslation('content', 'en')['featured_event_date'] ?? 'Jul.12.2025') }}">
                                                @error('featured_event_date.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Featured Event Date -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">التاريخ (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_date.ar') is-invalid @enderror" name="featured_event_date[ar]"
                                                       value="{{ old('featured_event_date.ar', $page->getTranslation('content', 'ar')['featured_event_date'] ?? '12 يوليو 2025') }}" dir="rtl">
                                                @error('featured_event_date.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Featured Event Time -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Time (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_time.en') is-invalid @enderror" name="featured_event_time[en]"
                                                       value="{{ old('featured_event_time.en', $page->getTranslation('content', 'en')['featured_event_time'] ?? 'From 4:00 PM To 8PM') }}">
                                                @error('featured_event_time.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Featured Event Time -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الوقت (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_time.ar') is-invalid @enderror" name="featured_event_time[ar]"
                                                       value="{{ old('featured_event_time.ar', $page->getTranslation('content', 'ar')['featured_event_time'] ?? 'من 4:00 مساءً إلى 8:00 مساءً') }}" dir="rtl">
                                                @error('featured_event_time.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Featured Event Location -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Location (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_location.en') is-invalid @enderror" name="featured_event_location[en]"
                                                       value="{{ old('featured_event_location.en', $page->getTranslation('content', 'en')['featured_event_location'] ?? 'Online') }}">
                                                @error('featured_event_location.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Featured Event Location -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الموقع (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('featured_event_location.ar') is-invalid @enderror" name="featured_event_location[ar]"
                                                       value="{{ old('featured_event_location.ar', $page->getTranslation('content', 'ar')['featured_event_location'] ?? 'عبر الإنترنت') }}" dir="rtl">
                                                @error('featured_event_location.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Featured Event Description -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Description (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('featured_event_description.en') is-invalid @enderror" name="featured_event_description[en]" rows="5">{{ old('featured_event_description.en', $page->getTranslation('content', 'en')['featured_event_description'] ?? 'An interactive event bringing together technology experts and enthusiasts to explore the trends shaping tomorrow. Attend keynotes, join workshops, and network with industry professionals.') }}</textarea>
                                                @error('featured_event_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Featured Event Description -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الوصف (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('featured_event_description.ar') is-invalid @enderror" name="featured_event_description[ar]" rows="5" dir="rtl">{{ old('featured_event_description.ar', $page->getTranslation('content', 'ar')['featured_event_description'] ?? 'فعالية تفاعلية تجمع بين خبراء التكنولوجيا والمتحمسين لاستكشاف الاتجاهات التي تشكل الغد. احضر المحاضرات الرئيسية وانضم إلى ورش العمل وتواصل مع المحترفين في الصناعة.') }}</textarea>
                                                @error('featured_event_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Featured Event Image</label>
                                                <input type="file" class="form-control @error('featured_event_image') is-invalid @enderror" name="featured_event_image" accept="image/*">
                                                @error('featured_event_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($page->getTranslation('content', 'en')['featured_event_image']) && $page->getTranslation('content', 'en')['featured_event_image'])
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->getTranslation('content', 'en')['featured_event_image']) }}" alt="Featured Event Image" style="max-width: 200px; max-height: 150px;">
                                                        <small class="d-block text-muted">Current image</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Card Section -->
                                <div class="tab-pane" id="card" role="tabpanel">
                                    <h5>Event Card Section</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- English Event Card Time Text -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Time Text (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_time_text.en') is-invalid @enderror" name="event_card_time_text[en]"
                                                       value="{{ old('event_card_time_text.en', $page->getTranslation('content', 'en')['event_card_time_text'] ?? '01 hr 2 mins') }}">
                                                @error('event_card_time_text.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Card Time Text -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">نص الوقت (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_time_text.ar') is-invalid @enderror" name="event_card_time_text[ar]"
                                                       value="{{ old('event_card_time_text.ar', $page->getTranslation('content', 'ar')['event_card_time_text'] ?? 'ساعة واحدة ودقيقتان') }}" dir="rtl">
                                                @error('event_card_time_text.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Event Card Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Title (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_title.en') is-invalid @enderror" name="event_card_title[en]"
                                                       value="{{ old('event_card_title.en', $page->getTranslation('content', 'en')['event_card_title'] ?? 'Future of Tech: Live Event') }}">
                                                @error('event_card_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Card Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_title.ar') is-invalid @enderror" name="event_card_title[ar]"
                                                       value="{{ old('event_card_title.ar', $page->getTranslation('content', 'ar')['event_card_title'] ?? 'مستقبل التكنولوجيا: حدث مباشر') }}" dir="rtl">
                                                @error('event_card_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Event Card Date -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Date (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_date.en') is-invalid @enderror" name="event_card_date[en]"
                                                       value="{{ old('event_card_date.en', $page->getTranslation('content', 'en')['event_card_date'] ?? 'Jul.12.2025 /4:00 PM') }}">
                                                @error('event_card_date.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Card Date -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">التاريخ (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_date.ar') is-invalid @enderror" name="event_card_date[ar]"
                                                       value="{{ old('event_card_date.ar', $page->getTranslation('content', 'ar')['event_card_date'] ?? '12 يوليو 2025 / 4:00 مساءً') }}" dir="rtl">
                                                @error('event_card_date.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Event Card Location -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Location (English) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_location.en') is-invalid @enderror" name="event_card_location[en]"
                                                       value="{{ old('event_card_location.en', $page->getTranslation('content', 'en')['event_card_location'] ?? 'Online') }}">
                                                @error('event_card_location.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Card Location -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الموقع (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('event_card_location.ar') is-invalid @enderror" name="event_card_location[ar]"
                                                       value="{{ old('event_card_location.ar', $page->getTranslation('content', 'ar')['event_card_location'] ?? 'عبر الإنترنت') }}" dir="rtl">
                                                @error('event_card_location.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Event Card Description -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Description (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('event_card_description.en') is-invalid @enderror" name="event_card_description[en]" rows="5">{{ old('event_card_description.en', $page->getTranslation('content', 'en')['event_card_description'] ?? 'An interactive event bringing together technology experts and enthusiasts to explore the trends shaping tomorrow. Attend keynotes, join workshops, and network with industry professionals.') }}</textarea>
                                                @error('event_card_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Card Description -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">الوصف (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control ckeditor @error('event_card_description.ar') is-invalid @enderror" name="event_card_description[ar]" rows="5" dir="rtl">{{ old('event_card_description.ar', $page->getTranslation('content', 'ar')['event_card_description'] ?? 'فعالية تفاعلية تجمع بين خبراء التكنولوجيا والمتحمسين لاستكشاف الاتجاهات التي تشكل الغد. احضر المحاضرات الرئيسية وانضم إلى ورش العمل وتواصل مع المحترفين في الصناعة.') }}</textarea>
                                                @error('event_card_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Event Card Rating -->
                                            <div class="mb-3">
                                                <label class="form-label">Rating <span class="text-danger">*</span></label>
                                                <input type="number" step="0.1" min="0" max="5" class="form-control @error('event_card_rating') is-invalid @enderror" name="event_card_rating"
                                                       value="{{ old('event_card_rating', $page->getTranslation('content', 'en')['event_card_rating'] ?? 4.3) }}">
                                                @error('event_card_rating')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Event Card Raters Count -->
                                            <div class="mb-3">
                                                <label class="form-label">Raters Count <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('event_card_raters_count') is-invalid @enderror" name="event_card_raters_count"
                                                       value="{{ old('event_card_raters_count', $page->getTranslation('content', 'en')['event_card_raters_count'] ?? 16325) }}">
                                                @error('event_card_raters_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Event Card Image</label>
                                                <input type="file" class="form-control @error('event_card_image') is-invalid @enderror" name="event_card_image" accept="image/*">
                                                @error('event_card_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($page->getTranslation('content', 'en')['event_card_image']) && $page->getTranslation('content', 'en')['event_card_image'])
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->getTranslation('content', 'en')['event_card_image']) }}" alt="Event Card Image" style="max-width: 200px; max-height: 150px;">
                                                        <small class="d-block text-muted">Current image</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Events Page</button>
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
    <!-- CKEditor JS -->
    <script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize CKEditor for all textareas that need it
            const textareasToInit = [
                'main_description[en]',
                'main_description[ar]',
                'featured_event_description[en]',
                'featured_event_description[ar]',
                'event_card_description[en]',
                'event_card_description[ar]'
            ];

            textareasToInit.forEach(name => {
                const textarea = document.querySelector(`textarea[name="${name}"]`);
                if (textarea) {
                    CKEDITOR.replace(textarea);
                }
            });

            // Your existing language toggle and error handling code
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
                    'main': ['main_title.en', 'main_title.ar', 'main_description.en', 'main_description.ar', 'see_more_text.en', 'see_more_text.ar'],
                    'learning': ['learning_title.en', 'learning_title.ar', 'learning_points.en', 'learning_points.ar'],
                    'featured': ['featured_event_title.en', 'featured_event_title.ar', 'featured_event_date.en', 'featured_event_date.ar', 'featured_event_time.en', 'featured_event_time.ar', 'featured_event_location.en', 'featured_event_location.ar', 'featured_event_description.en', 'featured_event_description.ar', 'featured_event_image'],
                    'card': ['event_card_time_text.en', 'event_card_time_text.ar', 'event_card_title.en', 'event_card_title.ar', 'event_card_date.en', 'event_card_date.ar', 'event_card_location.en', 'event_card_location.ar', 'event_card_description.en', 'event_card_description.ar', 'event_card_rating', 'event_card_raters_count', 'event_card_image']
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
