@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit About Us Page Content</h4>
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
                                            <div class="mb-3">
                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_title') is-invalid @enderror" name="hero_title"
                                                       value="{{ old('hero_title', $page->content['hero_title'] ?? 'About Us') }}">
                                                @error('hero_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_subtitle') is-invalid @enderror" name="hero_subtitle"
                                                       value="{{ old('hero_subtitle', $page->content['hero_subtitle'] ?? 'Empowering Businesses Through Smart IT Solutions') }}">
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

                                <!-- About Section -->
                                <div class="tab-pane" id="about" role="tabpanel">
                                    <h5>About Section</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('about_title') is-invalid @enderror" name="about_title"
                                               value="{{ old('about_title', $page->content['about_title'] ?? 'About Us') }}">
                                        @error('about_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description<span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('about_description') is-invalid @enderror" name="about_description" rows="4">{{ old('about_description', $page->content['about_description'] ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry...') }}</textarea>
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

                                <!-- Why Choose Us Section -->
                                <div class="tab-pane" id="why-choose" role="tabpanel">
                                    <h5>Why Choose Us Section</h5>
                                    <div class="mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('why_choose_title') is-invalid @enderror" name="why_choose_title"
                                               value="{{ old('why_choose_title', $page->content['why_choose_title'] ?? 'Excellence in Every Line of Code') }}">
                                        @error('why_choose_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Subtitle <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('why_choose_subtitle') is-invalid @enderror" name="why_choose_subtitle" rows="3">{{ old('why_choose_subtitle', $page->content['why_choose_subtitle'] ?? 'More than just IT services — we deliver intelligent, scalable solutions...') }}</textarea>
                                        @error('why_choose_subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h6>Why Choose Us Items (10 Items)</h6>
                                    <div id="why-choose-items-container">
                                        @for($i = 0; $i < 10; $i++)
                                            @php
                                                $item = old('why_choose_items.' . $i, $page->content['why_choose_items'][$i] ?? ['title' => '', 'description' => '']);
                                            @endphp
                                            <div class="card mb-3 why-choose-item">
                                                <div class="card-header">
                                                    <h6 class="mb-0">Item {{ $i + 1 }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control @error('why_choose_items.'.$i.'.title') is-invalid @enderror"
                                                                       name="why_choose_items[{{$i}}][title]"
                                                                       value="{{ $item['title'] }}"
                                                                       placeholder="e.g., Contrary To Popular Belief">
                                                                @error('why_choose_items.'.$i.'.title')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                <textarea class="form-control @error('why_choose_items.'.$i.'.description') is-invalid @enderror"
                                                                          name="why_choose_items[{{$i}}][description]" rows="3"
                                                                          placeholder="e.g., Lorem Ipsum is simply dummy text...">{{ $item['description'] }}</textarea>
                                                                @error('why_choose_items.'.$i.'.description')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Image</label>
                                                                <input type="file" class="form-control @error('why_choose_items.'.$i.'.image') is-invalid @enderror"
                                                                       name="why_choose_items[{{$i}}][image]" accept="image/*">
                                                                @error('why_choose_items.'.$i.'.image')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                                @if(isset($item['image']))
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset($item['image']) }}" alt="Item Image" style="max-width: 100px; max-height: 80px;">
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
                    'about': ['about_title', 'about_description', 'about_image'],
                    'why-choose': ['why_choose_title', 'why_choose_subtitle', 'why_choose_items']
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
