@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Home Page Content</h4>
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
                        <form action="{{ route('admin.dynamicPages.home.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero">Hero</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#trusted">Companies</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#about">About</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#industries">Industries</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#video">Video</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#careers">Careers</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#testimonials">Testimonials</a></li>
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
                                                       value="{{ old('hero_title', $page->content['hero_title'] ?? 'We Are Here To Hear') }}">
                                                @error('hero_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_subtitle') is-invalid @enderror" name="hero_subtitle"
                                                       value="{{ old('hero_subtitle', $page->content['hero_subtitle'] ?? 'Hero Subtitle') }}">
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

                                <!-- Trusted Companies -->
                                <div class="tab-pane" id="trusted" role="tabpanel">
                                    <h5>Trusted Companies</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('trusted_companies_heading') is-invalid @enderror" name="trusted_companies_heading"
                                               value="{{ old('trusted_companies_heading', $page->content['trusted_companies_heading'] ?? 'Trusted by 4,000+ companies') }}">
                                        @error('trusted_companies_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h6>Upload Company Logos (Max 10)</h6>
                                    <div class="row">
                                        @for($i = 0; $i < 10; $i++)
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Company Logo {{ $i + 1 }}</label>
                                                <input type="file" class="form-control @error('company_logos.' . $i) is-invalid @enderror" name="company_logos[]" accept="image/*">
                                                @error('company_logos.' . $i)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($page->content['company_logos'][$i]))
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->content['company_logos'][$i]) }}" alt="Company Logo" style="max-width: 100px; max-height: 60px;">
                                                        <small class="d-block text-muted">Current logo</small>
                                                    </div>
                                                @endif
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                <!-- About Section -->
                                <div class="tab-pane" id="about" role="tabpanel">
                                    <h5>About Us</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('about_heading') is-invalid @enderror" name="about_heading"
                                               value="{{ old('about_heading', $page->content['about_heading'] ?? 'About Us') }}">
                                        @error('about_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('about_description') is-invalid @enderror" name="about_description" rows="4">{{ old('about_description', $page->content['about_description'] ?? 'Lorem Ipsum is simply dummy text...') }}</textarea>
                                        @error('about_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About Image</label>
                                        <input type="file" class="form-control @error('about_image') is-invalid @enderror" name="about_image" accept="image/*">
                                        @error('about_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->content['about_image']))
                                            <div class="mt-2">
                                                <img src="{{ asset($page->content['about_image']) }}" alt="About Image" style="max-width: 200px; max-height: 150px;">
                                                <small class="d-block text-muted">Current image</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Industries Section -->
                                <div class="tab-pane" id="industries" role="tabpanel">
                                    <h5>Industries</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('industries_heading') is-invalid @enderror" name="industries_heading"
                                               value="{{ old('industries_heading', $page->content['industries_heading'] ?? 'we are industry first') }}">
                                        @error('industries_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h6>Industries List</h6>
                                    @for($i = 0; $i < 8; $i++)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6>Industry {{ $i + 1 }}</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('industries.' . $i . '.title') is-invalid @enderror" name="industries[{{$i}}][title]"
                                                                   value="{{ old('industries.' . $i . '.title', $page->content['industries'][$i]['title'] ?? '') }}">
                                                            @error('industries.' . $i . '.title')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Image</label>
                                                            <input type="file" class="form-control @error('industries.' . $i . '.image') is-invalid @enderror" name="industries[{{$i}}][image]" accept="image/*">
                                                            @error('industries.' . $i . '.image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if(isset($page->content['industries'][$i]['image']))
                                                                <div class="mt-2">
                                                                    <img src="{{ asset($page->content['industries'][$i]['image']) }}" alt="Industry Image" style="max-width: 100px; max-height: 60px;">
                                                                    <small class="d-block text-muted">Current image</small>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>

                                <!-- Video Section -->
                                <div class="tab-pane" id="video" role="tabpanel">
                                    <h5>Video Section</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Video File (MP4, MOV, AVI - Max 50MB)</label>
                                        <input type="file" class="form-control @error('video_file') is-invalid @enderror" name="video_file" accept="video/*">
                                        @error('video_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->content['video_file']))
                                            <div class="mt-2">
                                                <video src="{{ asset($page->content['video_file']) }}" controls style="max-width: 200px; max-height: 150px;"></video>
                                                <small class="d-block text-muted">Current video</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Careers Section -->
                                <div class="tab-pane" id="careers" role="tabpanel">
                                    <h5>Careers Section</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('careers_heading') is-invalid @enderror" name="careers_heading"
                                               value="{{ old('careers_heading', $page->content['careers_heading'] ?? 'Careers') }}">
                                        @error('careers_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('careers_description') is-invalid @enderror" name="careers_description" rows="4">{{ old('careers_description', $page->content['careers_description'] ?? 'We Can Help You To Grow Your Business...') }}</textarea>
                                        @error('careers_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Careers Image</label>
                                        <input type="file" class="form-control @error('careers_image') is-invalid @enderror" name="careers_image" accept="image/*">
                                        @error('careers_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->content['careers_image']))
                                            <div class="mt-2">
                                                <img src="{{ asset($page->content['careers_image']) }}" alt="Careers Image" style="max-width: 200px; max-height: 150px;">
                                                <small class="d-block text-muted">Current image</small>
                                            </div>
                                        @endif
                                    </div>

                                    <h6>Features</h6>
                                    @for($i = 0; $i < 6; $i++)
                                        <div class="mb-2">
                                            <label class="form-label">Feature {{ $i + 1 }}</label>
                                            <input type="text" class="form-control @error('careers_features.' . $i) is-invalid @enderror" name="careers_features[]"
                                                   value="{{ old('careers_features.' . $i, $page->content['careers_features'][$i] ?? '') }}">
                                            @error('careers_features.' . $i)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endfor
                                </div>

                                <!-- Testimonials Section -->
                                <div class="tab-pane" id="testimonials" role="tabpanel">
                                    <h5>Testimonials</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('testimonials_heading') is-invalid @enderror" name="testimonials_heading"
                                               value="{{ old('testimonials_heading', $page->content['testimonials_heading'] ?? 'Testimonials') }}">
                                        @error('testimonials_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h6>Testimonials List</h6>
                                    @for($i = 0; $i < 5; $i++)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6>Testimonial {{ $i + 1 }}</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('testimonials.' . $i . '.name') is-invalid @enderror" name="testimonials[{{$i}}][name]"
                                                                   value="{{ old('testimonials.' . $i . '.name', $page->content['testimonials'][$i]['name'] ?? '') }}">
                                                            @error('testimonials.' . $i . '.name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Position <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('testimonials.' . $i . '.position') is-invalid @enderror" name="testimonials[{{$i}}][position]"
                                                                   value="{{ old('testimonials.' . $i . '.position', $page->content['testimonials'][$i]['position'] ?? '') }}">
                                                            @error('testimonials.' . $i . '.position')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Stars (1-5) <span class="text-danger">*</span></label>
                                                            <select class="form-control @error('testimonials.' . $i . '.stars') is-invalid @enderror" name="testimonials[{{$i}}][stars]">
                                                                @for($star = 1; $star <= 5; $star++)
                                                                    <option value="{{ $star }}" {{ old('testimonials.' . $i . '.stars', $page->content['testimonials'][$i]['stars'] ?? 5) == $star ? 'selected' : '' }}>
                                                                        {{ $star }} Star{{ $star > 1 ? 's' : '' }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                            @error('testimonials.' . $i . '.stars')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Testimonial Text <span class="text-danger">*</span></label>
                                                            <textarea class="form-control @error('testimonials.' . $i . '.text') is-invalid @enderror" name="testimonials[{{$i}}][text]" rows="4">{{ old('testimonials.' . $i . '.text', $page->content['testimonials'][$i]['text'] ?? '') }}</textarea>
                                                            @error('testimonials.' . $i . '.text')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Avatar Image</label>
                                                            <input type="file" class="form-control @error('testimonials.' . $i . '.image') is-invalid @enderror" name="testimonials[{{$i}}][image]" accept="image/*">
                                                            @error('testimonials.' . $i . '.image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if(isset($page->content['testimonials'][$i]['image']))
                                                                <div class="mt-2">
                                                                    <img src="{{ asset($page->content['testimonials'][$i]['image']) }}" alt="Avatar" style="max-width: 80px; max-height: 80px; border-radius: 50%;">
                                                                    <small class="d-block text-muted">Current avatar</small>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Update Home Page</button>
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
        // Add JavaScript to automatically show the tab with errors
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
            // Find the first tab that has an error
            const errorFields = @json($errors->keys());
            if (errorFields.length > 0) {
                const firstErrorField = errorFields[0];

                // Map field names to tab IDs
                const fieldToTabMap = {
                    'hero': ['hero_title', 'hero_subtitle', 'hero_image'],
                    'trusted': ['trusted_companies_heading', 'company_logos'],
                    'about': ['about_heading', 'about_description', 'about_image'],
                    'industries': ['industries_heading', 'industries'],
                    'video': ['video_file'],
                    'careers': ['careers_heading', 'careers_description', 'careers_image', 'careers_features'],
                    'testimonials': ['testimonials_heading', 'testimonials']
                };

                // Find which tab contains the error
                for (const [tabId, fields] of Object.entries(fieldToTabMap)) {
                    if (fields.some(field => firstErrorField.startsWith(field))) {
                        // Show the tab with the error
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
