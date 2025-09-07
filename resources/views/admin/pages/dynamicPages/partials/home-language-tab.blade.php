@php
    $lang = $lang ?? 'en';
@endphp

<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#hero-{{ $lang }}">Hero</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#trusted-{{ $lang }}">Companies</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#about-{{ $lang }}">About</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#industries-{{ $lang }}">Industries</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#careers-{{ $lang }}">Careers</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#testimonials-{{ $lang }}">Testimonials</a></li>
</ul>

<div class="tab-content p-3">
    <!-- Hero Section -->
    <div class="tab-pane active" id="hero-{{ $lang }}" role="tabpanel">
        <h5>Hero Section</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hero_title[{{ $lang }}]"
                           value="{{ old('hero_title.' . $lang, $page->content[$lang]['hero_title'] ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hero_subtitle[{{ $lang }}]"
                           value="{{ old('hero_subtitle.' . $lang, $page->content[$lang]['hero_subtitle'] ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Trusted Companies -->
    <div class="tab-pane" id="trusted-{{ $lang }}" role="tabpanel">
        <h5>Trusted Companies</h5>
        <div class="mb-3">
            <label class="form-label">Section Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="trusted_companies_heading[{{ $lang }}]"
                   value="{{ old('trusted_companies_heading.' . $lang, $page->content[$lang]['trusted_companies_heading'] ?? '') }}">
        </div>
    </div>

    <!-- About Section -->
    <div class="tab-pane" id="about-{{ $lang }}" role="tabpanel">
        <h5>About Us</h5>
        <div class="mb-3">
            <label class="form-label">Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="about_heading[{{ $lang }}]"
                   value="{{ old('about_heading.' . $lang, $page->content[$lang]['about_heading'] ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="about_description[{{ $lang }}]" rows="4">{{ old('about_description.' . $lang, $page->content[$lang]['about_description'] ?? '') }}</textarea>
        </div>
    </div>

    <!-- Industries Section -->
    <div class="tab-pane" id="industries-{{ $lang }}" role="tabpanel">
        <h5>Industries</h5>
        <div class="mb-3">
            <label class="form-label">Section Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="industries_heading[{{ $lang }}]"
                   value="{{ old('industries_heading.' . $lang, $page->content[$lang]['industries_heading'] ?? '') }}">
        </div>

        <h6>Industries List</h6>
        @for($i = 0; $i < 8; $i++)
            <div class="card mb-3">
                <div class="card-body">
                    <h6>Industry {{ $i + 1 }}</h6>
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="industries_title[{{ $lang }}][{{$i}}]"
                               value="{{ old('industries_title.' . $lang . '.' . $i, $page->content[$lang]['industries'][$i]['title'] ?? '') }}">
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Careers Section -->
    <div class="tab-pane" id="careers-{{ $lang }}" role="tabpanel">
        <h5>Careers Section</h5>
        <div class="mb-3">
            <label class="form-label">Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="careers_heading[{{ $lang }}]"
                   value="{{ old('careers_heading.' . $lang, $page->content[$lang]['careers_heading'] ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description <span class="text-danger">*</span></label>
            <textarea class="form-control" name="careers_description[{{ $lang }}]" rows="4">{{ old('careers_description.' . $lang, $page->content[$lang]['careers_description'] ?? '') }}</textarea>
        </div>

        <h6>Features</h6>
        @for($i = 0; $i < 6; $i++)
            <div class="mb-2">
                <label class="form-label">Feature {{ $i + 1 }}</label>
                <input type="text" class="form-control" name="careers_features[{{ $lang }}][]"
                       value="{{ old('careers_features.' . $lang . '.' . $i, $page->content[$lang]['careers_features'][$i] ?? '') }}">
            </div>
        @endfor
    </div>

    <!-- Testimonials Section -->
    <div class="tab-pane" id="testimonials-{{ $lang }}" role="tabpanel">
        <h5>Testimonials</h5>
        <div class="mb-3">
            <label class="form-label">Section Heading <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="testimonials_heading[{{ $lang }}]"
                   value="{{ old('testimonials_heading.' . $lang, $page->content[$lang]['testimonials_heading'] ?? '') }}">
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
                                <input type="text" class="form-control" name="testimonials_name[{{ $lang }}][{{$i}}]"
                                       value="{{ old('testimonials_name.' . $lang . '.' . $i, $page->content[$lang]['testimonials'][$i]['name'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="testimonials_position[{{ $lang }}][{{$i}}]"
                                       value="{{ old('testimonials_position.' . $lang . '.' . $i, $page->content[$lang]['testimonials'][$i]['position'] ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stars (1-5) <span class="text-danger">*</span></label>
                                <select class="form-control" name="testimonials_stars[{{ $lang }}][{{$i}}]">
                                    @for($star = 1; $star <= 5; $star++)
                                        <option value="{{ $star }}" {{ (old('testimonials_stars.' . $lang . '.' . $i, $page->content[$lang]['testimonials'][$i]['stars'] ?? 5) == $star) ? 'selected' : '' }}>
                                            {{ $star }} Star{{ $star > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Testimonial Text <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="testimonials_text[{{ $lang }}][{{$i}}]" rows="4">{{ old('testimonials_text.' . $lang . '.' . $i, $page->content[$lang]['testimonials'][$i]['text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
