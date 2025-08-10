@extends('admin.layouts.app')

@section('extra-css')
    <link href="{{asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .alert-text {
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
                <h4 class="mb-sm-0 font-size-18">Page Categories Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Page Categories</li>
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
                        <form action="{{isset($pageCategory) ? route('admin.page-categories.update', $pageCategory->id) : route('admin.page-categories.store')}}"
                              id="form-data" method="post">
                            @csrf
                            @if(isset($pageCategory))
                                @method('PUT')
                            @endif

                            <div class="tab-content crypto-buy-sell-nav-content p-4">
                                <div class="tab-pane active" id="buy" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Category Name</label>
                                                <input type="text" name="name"
                                                       value="{{isset($pageCategory) ? $pageCategory->name : old('name')}}"
                                                       class="form-control" id="name" required
                                                       placeholder="Enter category name">
                                            </div>
                                            @include('admin.errors.error', ['input' => 'name'])
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" id="submit-button"
                                            class="btn btn-primary waves-effect waves-light">
                                        {{isset($pageCategory) ? 'Update Category' : 'Create Category'}}
                                    </button>
                                    <a href="{{ route('admin.page-categories.index') }}"
                                       class="btn btn-secondary waves-effect">
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

    <script>
        $(document).ready(function() {
            // Basic form validation
            $('#form-data').on('submit', function(e) {
                if ($('#name').val() === '') {
                    e.preventDefault();
                    $('#alert-text').text('Category name is required');
                    return false;
                }
            });
        });
    </script>
@endsection
