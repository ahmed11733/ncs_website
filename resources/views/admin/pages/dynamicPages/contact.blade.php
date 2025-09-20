@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Contact Us Page Content</h4>
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
                        <form action="{{ route('admin.dynamicPages.contact.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero">Hero Section</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#contact-info">Contact Information</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#social">Social Links</a></li>
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
                                                       value="{{ old('hero_title.en', $page->getTranslation('content', 'en')['hero_title'] ?? 'Contact Us') }}">
                                                @error('hero_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان (العربية) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title.ar') is-invalid @enderror" name="hero_title[ar]"
                                                       value="{{ old('hero_title.ar', $page->getTranslation('content', 'ar')['hero_title'] ?? 'اتصل بنا') }}" dir="rtl">
                                                @error('hero_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Hero Subtitle -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Subtitle (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('hero_subtitle.en') is-invalid @enderror"
                                                          name="hero_subtitle[en]" rows="5">{{ old('hero_subtitle.en', $page->getTranslation('content', 'en')['hero_subtitle'] ?? 'We\'re Happy To Assist — Feel Free To Contact Us With Any Questions Or Service Inquiries.') }}</textarea>
                                                @error('hero_subtitle.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Hero Subtitle -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">العنوان الفرعي (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('hero_subtitle.ar') is-invalid @enderror"
                                                          name="hero_subtitle[ar]" rows="5" dir="rtl">{{ old('hero_subtitle.ar', $page->getTranslation('content', 'ar')['hero_subtitle'] ?? 'نحن سعداء لمساعدتك - لا تتردد في الاتصال بنا مع أي أسئلة أو استفسارات الخدمة.') }}</textarea>
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

                                <!-- Contact Information -->
                                <div class="tab-pane" id="contact-info" role="tabpanel">
                                    <h5>Contact Information</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                       value="{{ old('phone', $page->getTranslation('content', 'en')['phone'] ?? '+1012 3456 789') }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email', $page->getTranslation('content', 'en')['email'] ?? 'demo@gmail.com') }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- English Egypt Office -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Egypt Office (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('egypt_office.en') is-invalid @enderror" name="egypt_office[en]" rows="3">{{ old('egypt_office.en', $page->getTranslation('content', 'en')['egypt_office'] ?? '132 Dartmouth Street Boston, Massachusetts 02156 United States') }}</textarea>
                                                @error('egypt_office.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Egypt Office -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">مكتب مصر (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('egypt_office.ar') is-invalid @enderror" name="egypt_office[ar]" rows="3" dir="rtl">{{ old('egypt_office.ar', $page->getTranslation('content', 'ar')['egypt_office'] ?? '132 شارع دارتموث بوسطن، ماساتشوستس 02156 الولايات المتحدة') }}</textarea>
                                                @error('egypt_office.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- English Saudi Office -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Saudi Office (English) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('saudi_office.en') is-invalid @enderror" name="saudi_office[en]" rows="3">{{ old('saudi_office.en', $page->getTranslation('content', 'en')['saudi_office'] ?? '132 Dartmouth Street Boston, Massachusetts 02156 United States') }}</textarea>
                                                @error('saudi_office.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Saudi Office -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">مكتب السعودية (العربية) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('saudi_office.ar') is-invalid @enderror" name="saudi_office[ar]" rows="3" dir="rtl">{{ old('saudi_office.ar', $page->getTranslation('content', 'ar')['saudi_office'] ?? '132 شارع دارتموث بوسطن، ماساتشوستس 02156 الولايات المتحدة') }}</textarea>
                                                @error('saudi_office.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Links -->
                                <div class="tab-pane" id="social" role="tabpanel">
                                    <h5>Social Media Links</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Facebook URL</label>
                                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" name="facebook_url"
                                                       value="{{ old('facebook_url', $page->getTranslation('content', 'en')['facebook_url'] ?? '') }}" placeholder="https://facebook.com/yourpage">
                                                @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">YouTube URL</label>
                                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url"
                                                       value="{{ old('youtube_url', $page->getTranslation('content', 'en')['youtube_url'] ?? '') }}" placeholder="https://youtube.com/yourchannel">
                                                @error('youtube_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Instagram URL</label>
                                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" name="instagram_url"
                                                       value="{{ old('instagram_url', $page->getTranslation('content', 'en')['instagram_url'] ?? '') }}" placeholder="https://instagram.com/yourprofile">
                                                @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Twitter URL</label>
                                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" name="twitter_url"
                                                       value="{{ old('twitter_url', $page->getTranslation('content', 'en')['twitter_url'] ?? '') }}" placeholder="https://twitter.com/yourprofile">
                                                @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">LinkedIn URL</label>
                                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" name="linkedin_url"
                                                       value="{{ old('linkedin_url', $page->getTranslation('content', 'en')['linkedin_url'] ?? '') }}" placeholder="https://linkedin.com/company/yourcompany">
                                                @error('linkedin_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Contact Page</button>
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
                    'contact-info': ['phone', 'email', 'egypt_office.en', 'egypt_office.ar', 'saudi_office.en', 'saudi_office.ar'],
                    'social': ['facebook_url', 'youtube_url', 'instagram_url', 'twitter_url', 'linkedin_url']
                };

                for (const [tabId, fields] of Object.entries(fieldToTabMap)) {
                    if (fields.includes(firstErrorField)) {
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
