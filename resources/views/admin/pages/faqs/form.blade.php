@extends('admin.layouts.app')
@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('admin_assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" id="bootstrap-style" rel="stylesheet"
          type="text/css"/>
    <!-- CKEditor CSS -->
    <link href="{{asset('admin_assets/ckeditor/skins/kama/editor.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .alert-text{
            color: red;
            font-size: 15px;
            font-weight: bolder;
        }
    </style>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">FAQ Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.faqs.index')}}">FAQs</a></li>
                        <li class="breadcrumb-item active">{{ isset($faq) ? 'Edit FAQ' : 'Create FAQ' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="crypto-buy-sell-nav">
                        <p id="alert-text" class="alert-text"></p>
                        <form action="{{isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store')}}" id="form-data" method="post">
                            @csrf
                            @if(isset($faq))
                                @method('PUT')
                            @endif

                            <div class="tab-content crypto-buy-sell-nav-content p-4">
                                <div class="tab-pane active" id="buy" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="title_en" class="form-label">Title (English)</label>
                                                <input type="text" name="title_en"
                                                       value="{{ old('title_en', isset($faq) ? $faq->getTranslation('title', 'en') : '') }}"
                                                       class="form-control" id="title_en" required
                                                       placeholder="FAQ Title in English">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'title_en'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="title_ar" class="form-label">Title (Arabic)</label>
                                                <input type="text" name="title_ar"
                                                       value="{{ old('title_ar', isset($faq) ? $faq->getTranslation('title', 'ar') : '') }}"
                                                       class="form-control" id="title_ar" required
                                                       placeholder="FAQ Title in Arabic">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'title_ar'])
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="description_en" class="form-label">Description (English)</label>
                                                <textarea name="description_en" class="form-control" id="description_en"
                                                          rows="5" required>{{ old('description_en', isset($faq) ? $faq->getTranslation('description', 'en') : '') }}</textarea>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'description_en'])
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="description_ar" class="form-label">Description (Arabic)</label>
                                                <textarea name="description_ar" class="form-control" id="description_ar"
                                                          rows="5" required>{{ old('description_ar', isset($faq) ? $faq->getTranslation('description', 'ar') : '') }}</textarea>
                                            </div>
                                            @include('admin.errors.error', ['input' => 'description_ar'])
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="order" class="form-label">Order</label>
                                                <input type="number" name="order"
                                                       value="{{ old('order', isset($faq) ? $faq->order : 0) }}"
                                                       class="form-control" id="order"
                                                       placeholder="Display order">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'order'])
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" id="submit-button"
                                            class="btn btn-primary waves-effect waves-light">
                                        {{isset($faq) ? 'Update FAQ' : 'Create FAQ'}}
                                    </button>
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary waves-effect waves-light">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('extra-js')
    <!-- Required datatable js -->
    <script src="{{asset('admin_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('admin_assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
@endsection
