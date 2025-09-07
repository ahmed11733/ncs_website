@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Footer Content</h4>
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
                        <form action="{{ route('admin.dynamicPages.footer.update') }}" method="POST">
                            @csrf

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#event">Event Section</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#contact-info">Contact Information</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#social">Social Links</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#copyright">Copyright</a></li>
                            </ul>

                            <div class="tab-content p-3">
                                <!-- Event Section -->
                                <div class="tab-pane active" id="event" role="tabpanel">
                                    <h5>Event Section</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- English Event Title -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Event Title (English)</label>
                                                <input type="text" class="form-control @error('event_title.en') is-invalid @enderror"
                                                       name="event_title[en]" value="{{ old('event_title.en', $page->getTranslation('content', 'en')['event_title'] ?? '') }}">
                                                @error('event_title.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Title -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">عنوان الحدث (العربية)</label>
                                                <input type="text" class="form-control @error('event_title.ar') is-invalid @enderror"
                                                       name="event_title[ar]" value="{{ old('event_title.ar', $page->getTranslation('content', 'ar')['event_title'] ?? '') }}" dir="rtl">
                                                @error('event_title.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- English Event Subtitle -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Event Subtitle (English)</label>
                                                <textarea class="form-control @error('event_subtitle.en') is-invalid @enderror"
                                                          name="event_subtitle[en]" rows="3">{{ old('event_subtitle.en', $page->getTranslation('content', 'en')['event_subtitle'] ?? '') }}</textarea>
                                                @error('event_subtitle.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Event Subtitle -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">وصف الحدث (العربية)</label>
                                                <textarea class="form-control @error('event_subtitle.ar') is-invalid @enderror"
                                                          name="event_subtitle[ar]" rows="3" dir="rtl">{{ old('event_subtitle.ar', $page->getTranslation('content', 'ar')['event_subtitle'] ?? '') }}</textarea>
                                                @error('event_subtitle.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email', $page->getTranslation('content', 'en')['email'] ?? '') }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone Number</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                       value="{{ old('phone', $page->getTranslation('content', 'en')['phone'] ?? '') }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">WhatsApp Number</label>
                                                <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number"
                                                       value="{{ old('whatsapp_number', $page->getTranslation('content', 'en')['whatsapp_number'] ?? '') }}" placeholder="+1234567890">
                                                @error('whatsapp_number')
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
                                                <label class="form-label">Instagram URL</label>
                                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" name="instagram_url"
                                                       value="{{ old('instagram_url', $page->getTranslation('content', 'en')['instagram_url'] ?? '') }}" placeholder="https://instagram.com/yourprofile">
                                                @error('instagram_url')
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
                                                <label class="form-label">YouTube URL</label>
                                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url"
                                                       value="{{ old('youtube_url', $page->getTranslation('content', 'en')['youtube_url'] ?? '') }}" placeholder="https://youtube.com/yourchannel">
                                                @error('youtube_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Copyright Section -->
                                <div class="tab-pane" id="copyright" role="tabpanel">
                                    <h5>Copyright Information</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- English Copyright -->
                                            <div class="mb-3 en-field">
                                                <label class="form-label">Copyright Text (English)</label>
                                                <textarea class="form-control @error('copyright.en') is-invalid @enderror"
                                                          name="copyright[en]" rows="3">{{ old('copyright.en', $page->getTranslation('content', 'en')['copyright'] ?? '') }}</textarea>
                                                @error('copyright.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Arabic Copyright -->
                                            <div class="mb-3 ar-field" style="display: none;">
                                                <label class="form-label">نص حقوق النشر (العربية)</label>
                                                <textarea class="form-control @error('copyright.ar') is-invalid @enderror"
                                                          name="copyright[ar]" rows="3" dir="rtl">{{ old('copyright.ar', $page->getTranslation('content', 'ar')['copyright'] ?? '') }}</textarea>
                                                @error('copyright.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Footer Content</button>
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

                @if($errors->any())
            const errorFields = @json($errors->keys());
            if (errorFields.length > 0) {
                const firstErrorField = errorFields[0];
                const fieldToTabMap = {
                    'event': ['event_title.en', 'event_title.ar', 'event_subtitle.en', 'event_subtitle.ar'],
                    'contact-info': ['email', 'phone', 'whatsapp_number'],
                    'social': ['facebook_url', 'instagram_url', 'twitter_url', 'youtube_url', 'linkedin_url'],
                    'copyright': ['copyright.en', 'copyright.ar']
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
