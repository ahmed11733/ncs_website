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

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#hero-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English Hero -->
                                        <div class="tab-pane active" id="hero-en" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('hero_title.en') is-invalid @enderror" name="hero_title[en]"
                                                               value="{{ old('hero_title.en', $page->content['en']['hero_title'] ?? 'We Are Here To Hear') }}">
                                                        @error('hero_title.en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('hero_subtitle.en') is-invalid @enderror" name="hero_subtitle[en]"
                                                               value="{{ old('hero_subtitle.en', $page->content['en']['hero_subtitle'] ?? 'Hero Subtitle') }}">
                                                        @error('hero_subtitle.en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Arabic Hero -->
                                        <div class="tab-pane" id="hero-ar" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title (Arabic) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('hero_title.ar') is-invalid @enderror" name="hero_title[ar]"
                                                               value="{{ old('hero_title.ar', $page->content['ar']['hero_title'] ?? 'نحن هنا لنسمع') }}">
                                                        @error('hero_title.ar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Subtitle (Arabic) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control @error('hero_subtitle.ar') is-invalid @enderror" name="hero_subtitle[ar]"
                                                               value="{{ old('hero_subtitle.ar', $page->content['ar']['hero_subtitle'] ?? 'العنوان الفرعي') }}">
                                                        @error('hero_subtitle.ar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Hero Image</label>
                                                <input type="file" class="form-control @error('hero_image') is-invalid @enderror" name="hero_image" accept="image/*">
                                                @error('hero_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                @if(isset($page->content['en']['hero_image']))
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->content['en']['hero_image']) }}" alt="Hero Image" style="max-width: 200px; max-height: 150px;">
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

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#trusted-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#trusted-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English Trusted Companies -->
                                        <div class="tab-pane active" id="trusted-en" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('trusted_companies_heading.en') is-invalid @enderror" name="trusted_companies_heading[en]"
                                                       value="{{ old('trusted_companies_heading.en', $page->content['en']['trusted_companies_heading'] ?? 'Trusted by 4,000+ companies') }}">
                                                @error('trusted_companies_heading.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Arabic Trusted Companies -->
                                        <div class="tab-pane" id="trusted-ar" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading (Arabic) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('trusted_companies_heading.ar') is-invalid @enderror" name="trusted_companies_heading[ar]"
                                                       value="{{ old('trusted_companies_heading.ar', $page->content['ar']['trusted_companies_heading'] ?? 'يثق بنا أكثر من 4000 شركة') }}">
                                                @error('trusted_companies_heading.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
                                                @if(isset($page->content['en']['company_logos'][$i]))
                                                    <div class="mt-2">
                                                        <img src="{{ asset($page->content['en']['company_logos'][$i]) }}" alt="Company Logo" style="max-width: 100px; max-height: 60px;">
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

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#about-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#about-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English About -->
                                        <div class="tab-pane active" id="about-en" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Heading <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('about_heading.en') is-invalid @enderror" name="about_heading[en]"
                                                       value="{{ old('about_heading.en', $page->content['en']['about_heading'] ?? 'About Us') }}">
                                                @error('about_heading.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('about_description.en') is-invalid @enderror" name="about_description[en]" rows="4">{{ old('about_description.en', $page->content['en']['about_description'] ?? 'Lorem Ipsum is simply dummy text...') }}</textarea>
                                                @error('about_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Arabic About -->
                                        <div class="tab-pane" id="about-ar" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Heading (Arabic) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('about_heading.ar') is-invalid @enderror" name="about_heading[ar]"
                                                       value="{{ old('about_heading.ar', $page->content['ar']['about_heading'] ?? 'من نحن') }}">
                                                @error('about_heading.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description (Arabic) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('about_description.ar') is-invalid @enderror" name="about_description[ar]" rows="4">{{ old('about_description.ar', $page->content['ar']['about_description'] ?? 'لوريم إيبسوم هو ببساطة نص شكلي...') }}</textarea>
                                                @error('about_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">About Image</label>
                                        <input type="file" class="form-control @error('about_image') is-invalid @enderror" name="about_image" accept="image/*">
                                        @error('about_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->content['en']['about_image']))
                                            <div class="mt-2">
                                                <img src="{{ asset($page->content['en']['about_image']) }}" alt="About Image" style="max-width: 200px; max-height: 150px;">
                                                <small class="d-block text-muted">Current image</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Industries Section -->
                                <div class="tab-pane" id="industries" role="tabpanel">
                                    <h5>Industries</h5>

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#industries-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#industries-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English Industries Heading -->
                                        <div class="tab-pane active" id="industries-en" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('industries_heading.en') is-invalid @enderror" name="industries_heading[en]"
                                                       value="{{ old('industries_heading.en', $page->content['en']['industries_heading'] ?? 'we are industry first') }}">
                                                @error('industries_heading.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Arabic Industries Heading -->
                                        <div class="tab-pane" id="industries-ar" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading (Arabic) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('industries_heading.ar') is-invalid @enderror" name="industries_heading[ar]"
                                                       value="{{ old('industries_heading.ar', $page->content['ar']['industries_heading'] ?? 'نحن أولاً في الصناعة') }}">
                                                @error('industries_heading.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Industries List</h6>
                                    @for($i = 0; $i < 8; $i++)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6>Industry {{ $i + 1 }}</h6>

                                                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#industry-{{$i}}-en">English</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#industry-{{$i}}-ar">Arabic</a></li>
                                                </ul>

                                                <div class="tab-content">
                                                    <!-- English Industry Title -->
                                                    <div class="tab-pane active" id="industry-{{$i}}-en" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label class="form-label">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('industries_title.en.' . $i) is-invalid @enderror" name="industries_title[en][{{$i}}]"
                                                                   value="{{ old('industries_title.en.' . $i, $page->content['en']['industries'][$i]['title'] ?? '') }}">
                                                            @error('industries_title.en.' . $i)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Arabic Industry Title -->
                                                    <div class="tab-pane" id="industry-{{$i}}-ar" role="tabpanel">
                                                        <div class="mb-3">
                                                            <label class="form-label">Title (Arabic) <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control @error('industries_title.ar.' . $i) is-invalid @enderror" name="industries_title[ar][{{$i}}]"
                                                                   value="{{ old('industries_title.ar.' . $i, $page->content['ar']['industries'][$i]['title'] ?? '') }}">
                                                            @error('industries_title.ar.' . $i)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control @error('industries_image.' . $i) is-invalid @enderror" name="industries_image[{{$i}}]" accept="image/*">
                                                    @error('industries_image.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if(isset($page->content['en']['industries'][$i]['image']))
                                                        <div class="mt-2">
                                                            <img src="{{ asset($page->content['en']['industries'][$i]['image']) }}" alt="Industry Image" style="max-width: 100px; max-height: 60px;">
                                                            <small class="d-block text-muted">Current image</small>
                                                        </div>
                                                    @endif
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
                                        @if(isset($page->content['en']['video_file']))
                                            <div class="mt-2">
                                                <video src="{{ asset($page->content['en']['video_file']) }}" controls style="max-width: 200px; max-height: 150px;"></video>
                                                <small class="d-block text-muted">Current video</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Careers Section -->
                                <div class="tab-pane" id="careers" role="tabpanel">
                                    <h5>Careers Section</h5>

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#careers-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#careers-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English Careers -->
                                        <div class="tab-pane active" id="careers-en" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Heading <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('careers_heading.en') is-invalid @enderror" name="careers_heading[en]"
                                                       value="{{ old('careers_heading.en', $page->content['en']['careers_heading'] ?? 'Careers') }}">
                                                @error('careers_heading.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('careers_description.en') is-invalid @enderror" name="careers_description[en]" rows="4">{{ old('careers_description.en', $page->content['en']['careers_description'] ?? 'We Can Help You To Grow Your Business...') }}</textarea>
                                                @error('careers_description.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <h6>Features</h6>
                                            @for($i = 0; $i < 6; $i++)
                                                <div class="mb-2">
                                                    <label class="form-label">Feature {{ $i + 1 }}</label>
                                                    <input type="text" class="form-control @error('careers_features.en.' . $i) is-invalid @enderror" name="careers_features[en][{{$i}}]"
                                                           value="{{ old('careers_features.en.' . $i, $page->content['en']['careers_features'][$i] ?? '') }}">
                                                    @error('careers_features.en.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endfor
                                        </div>

                                        <!-- Arabic Careers -->
                                        <div class="tab-pane" id="careers-ar" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Heading (Arabic) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('careers_heading.ar') is-invalid @enderror" name="careers_heading[ar]"
                                                       value="{{ old('careers_heading.ar', $page->content['ar']['careers_heading'] ?? 'الوظائف') }}">
                                                @error('careers_heading.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description (Arabic) <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('careers_description.ar') is-invalid @enderror" name="careers_description[ar]" rows="4">{{ old('careers_description.ar', $page->content['ar']['careers_description'] ?? 'يمكننا مساعدتك في تنمية عملك...') }}</textarea>
                                                @error('careers_description.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <h6>Features (Arabic)</h6>
                                            @for($i = 0; $i < 6; $i++)
                                                <div class="mb-2">
                                                    <label class="form-label">Feature {{ $i + 1 }}</label>
                                                    <input type="text" class="form-control @error('careers_features.ar.' . $i) is-invalid @enderror" name="careers_features[ar][{{$i}}]"
                                                           value="{{ old('careers_features.ar.' . $i, $page->content['ar']['careers_features'][$i] ?? '') }}">
                                                    @error('careers_features.ar.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Careers Image</label>
                                        <input type="file" class="form-control @error('careers_image') is-invalid @enderror" name="careers_image" accept="image/*">
                                        @error('careers_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if(isset($page->content['en']['careers_image']))
                                            <div class="mt-2">
                                                <img src="{{ asset($page->content['en']['careers_image']) }}" alt="Careers Image" style="max-width: 200px; max-height: 150px;">
                                                <small class="d-block text-muted">Current image</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Testimonials Section -->
                                <div class="tab-pane" id="testimonials" role="tabpanel">
                                    <h5>Testimonials</h5>

                                    <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#testimonials-en">English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#testimonials-ar">Arabic</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <!-- English Testimonials Heading -->
                                        <div class="tab-pane active" id="testimonials-en" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('testimonials_heading.en') is-invalid @enderror" name="testimonials_heading[en]"
                                                       value="{{ old('testimonials_heading.en', $page->content['en']['testimonials_heading'] ?? 'Testimonials') }}">
                                                @error('testimonials_heading.en')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Arabic Testimonials Heading -->
                                        <div class="tab-pane" id="testimonials-ar" role="tabpanel">
                                            <div class="mb-3">
                                                <label class="form-label">Section Heading (Arabic) <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('testimonials_heading.ar') is-invalid @enderror" name="testimonials_heading[ar]"
                                                       value="{{ old('testimonials_heading.ar', $page->content['ar']['testimonials_heading'] ?? 'آراء العملاء') }}">
                                                @error('testimonials_heading.ar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <h6>Testimonials List</h6>
                                    @for($i = 0; $i < 5; $i++)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h6>Testimonial {{ $i + 1 }}</h6>

                                                <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#testimonial-{{$i}}-en">English</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#testimonial-{{$i}}-ar">Arabic</a></li>
                                                </ul>

                                                <div class="tab-content">
                                                    <!-- English Testimonial -->
                                                    <div class="tab-pane active" id="testimonial-{{$i}}-en" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control @error('testimonials_name.en.' . $i) is-invalid @enderror" name="testimonials_name[en][{{$i}}]"
                                                                           value="{{ old('testimonials_name.en.' . $i, $page->content['en']['testimonials'][$i]['name'] ?? '') }}">
                                                                    @error('testimonials_name.en.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Position <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control @error('testimonials_position.en.' . $i) is-invalid @enderror" name="testimonials_position[en][{{$i}}]"
                                                                           value="{{ old('testimonials_position.en.' . $i, $page->content['en']['testimonials'][$i]['position'] ?? '') }}">
                                                                    @error('testimonials_position.en.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Stars (1-5) <span class="text-danger">*</span></label>
                                                                    <select class="form-control @error('testimonials_stars.en.' . $i) is-invalid @enderror" name="testimonials_stars[en][{{$i}}]">
                                                                        @for($star = 1; $star <= 5; $star++)
                                                                            <option value="{{ $star }}" {{ old('testimonials_stars.en.' . $i, $page->content['en']['testimonials'][$i]['stars'] ?? 5) == $star ? 'selected' : '' }}>
                                                                                {{ $star }} Star{{ $star > 1 ? 's' : '' }}
                                                                            </option>
                                                                        @endfor
                                                                    </select>
                                                                    @error('testimonials_stars.en.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Testimonial Text <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control @error('testimonials_text.en.' . $i) is-invalid @enderror" name="testimonials_text[en][{{$i}}]" rows="4">{{ old('testimonials_text.en.' . $i, $page->content['en']['testimonials'][$i]['text'] ?? '') }}</textarea>
                                                                    @error('testimonials_text.en.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Arabic Testimonial -->
                                                    <div class="tab-pane" id="testimonial-{{$i}}-ar" role="tabpanel">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Name (Arabic) <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control @error('testimonials_name.ar.' . $i) is-invalid @enderror" name="testimonials_name[ar][{{$i}}]"
                                                                           value="{{ old('testimonials_name.ar.' . $i, $page->content['ar']['testimonials'][$i]['name'] ?? '') }}">
                                                                    @error('testimonials_name.ar.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Position (Arabic) <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control @error('testimonials_position.ar.' . $i) is-invalid @enderror" name="testimonials_position[ar][{{$i}}]"
                                                                           value="{{ old('testimonials_position.ar.' . $i, $page->content['ar']['testimonials'][$i]['position'] ?? '') }}">
                                                                    @error('testimonials_position.ar.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Stars (1-5) <span class="text-danger">*</span></label>
                                                                    <select class="form-control @error('testimonials_stars.ar.' . $i) is-invalid @enderror" name="testimonials_stars[ar][{{$i}}]">
                                                                        @for($star = 1; $star <= 5; $star++)
                                                                            <option value="{{ $star }}" {{ old('testimonials_stars.ar.' . $i, $page->content['ar']['testimonials'][$i]['stars'] ?? 5) == $star ? 'selected' : '' }}>
                                                                                {{ $star }} Star{{ $star > 1 ? 's' : '' }}
                                                                            </option>
                                                                        @endfor
                                                                    </select>
                                                                    @error('testimonials_stars.ar.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Testimonial Text (Arabic) <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control @error('testimonials_text.ar.' . $i) is-invalid @enderror" name="testimonials_text[ar][{{$i}}]" rows="4">{{ old('testimonials_text.ar.' . $i, $page->content['ar']['testimonials'][$i]['text'] ?? '') }}</textarea>
                                                                    @error('testimonials_text.ar.' . $i)
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Avatar Image</label>
                                                    <input type="file" class="form-control @error('testimonials_image.' . $i) is-invalid @enderror" name="testimonials_image[{{$i}}]" accept="image/*">
                                                    @error('testimonials_image.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                    @if(isset($page->content['en']['testimonials'][$i]['image']))
                                                        <div class="mt-2">
                                                            <img src="{{ asset($page->content['en']['testimonials'][$i]['image']) }}" alt="Avatar" style="max-width: 80px; max-height: 80px; border-radius: 50%;">
                                                            <small class="d-block text-muted">Current avatar</small>
                                                        </div>
                                                    @endif
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

                        // If the error is in a language-specific field, also show the language tab
                        if (firstErrorField.includes('.en.') || firstErrorField.includes('[en]')) {
                            const langTab = document.querySelector(`#${tabId} [href="#${tabId}-en"]`);
                            if (langTab) new bootstrap.Tab(langTab).show();
                        } else if (firstErrorField.includes('.ar.') || firstErrorField.includes('[ar]')) {
                            const langTab = document.querySelector(`#${tabId} [href="#${tabId}-ar"]`);
                            if (langTab) new bootstrap.Tab(langTab).show();
                        }

                        break;
                    }
                }
            }
            @endif
        });
    </script>
@endsection
