@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Contact Us Page Content</h4>
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
                                            <div class="mb-3">
                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title') is-invalid @enderror" name="hero_title"
                                                       value="{{ old('hero_title', $page->content['hero_title'] ?? 'Contact Us') }}">
                                                @error('hero_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_subtitle') is-invalid @enderror" name="hero_subtitle"
                                                       value="{{ old('hero_subtitle', $page->content['hero_subtitle'] ?? 'We\'re Happy To Assist — Feel Free To Contact Us With Any Questions Or Service Inquiries.') }}">
                                                @error('hero_subtitle')
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
                                                @if(isset($page->content['hero_image']))
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->content['hero_image']) }}" alt="Hero Image" style="max-width: 200px; max-height: 150px;">
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
                                                       value="{{ old('phone', $page->content['phone'] ?? '+1012 3456 789') }}">
                                                @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ old('email', $page->content['email'] ?? 'demo@gmail.com') }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Egypt Office <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('egypt_office') is-invalid @enderror" name="egypt_office" rows="3">{{ old('egypt_office', $page->content['egypt_office'] ?? '132 Dartmouth Street Boston, Massachusetts 02156 United States') }}</textarea>
                                                @error('egypt_office')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Saudi Office <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('saudi_office') is-invalid @enderror" name="saudi_office" rows="3">{{ old('saudi_office', $page->content['saudi_office'] ?? '132 Dartmouth Street Boston, Massachusetts 02156 United States') }}</textarea>
                                                @error('saudi_office')
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
                                                       value="{{ old('facebook_url', $page->content['facebook_url'] ?? '') }}" placeholder="https://facebook.com/yourpage">
                                                @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">YouTube URL</label>
                                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" name="youtube_url"
                                                       value="{{ old('youtube_url', $page->content['youtube_url'] ?? '') }}" placeholder="https://youtube.com/yourchannel">
                                                @error('youtube_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Instagram URL</label>
                                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" name="instagram_url"
                                                       value="{{ old('instagram_url', $page->content['instagram_url'] ?? '') }}" placeholder="https://instagram.com/yourprofile">
                                                @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Twitter URL</label>
                                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" name="twitter_url"
                                                       value="{{ old('twitter_url', $page->content['twitter_url'] ?? '') }}" placeholder="https://twitter.com/yourprofile">
                                                @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">LinkedIn URL</label>
                                                <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" name="linkedin_url"
                                                       value="{{ old('linkedin_url', $page->content['linkedin_url'] ?? '') }}" placeholder="https://linkedin.com/company/yourcompany">
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-navigate to tab with errors
                @if($errors->any())
            const errorFields = @json($errors->keys());
            if (errorFields.length > 0) {
                const firstErrorField = errorFields[0];
                const fieldToTabMap = {
                    'hero': ['hero_title', 'hero_subtitle', 'hero_image'],
                    'contact-info': ['contact_description', 'phone', 'email', 'egypt_office', 'saudi_office'],
                    'social': ['facebook_url', 'youtube_url', 'instagram_url', 'twitter_url', 'linkedin_url']
                };

                for (const [tabId, fields] of Object.entries(fieldToTabMap)) {
                    if (fields.some(field => firstErrorField.startsWith(field))) {
                        const tabLink = document.querySelector(`[href="#${tabId}"]`);
                        if (tabLink) {
                            new bootstrap.Tab(tabLink).show();
                        }
                        break;
                    }
                }
            }
            @endif
        });
    </script>
@endsection
