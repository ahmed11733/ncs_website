@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Demo Requests</h4>
                    <span class="badge bg-primary">{{ $demoRequests->total() }} Total Requests</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Product</th>
                                    <th>Employees</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($demoRequests as $request)
                                    <tr>
                                        <td>#{{ $request->id }}</td>
                                        <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->company_name }}</td>
                                        <td>{{ Str::limit($request->product_name, 20) }}</td>
                                        <td>{{ $request->number_of_employees }}</td>
                                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form action="{{ route('admin.demo-requests.destroy', $request) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete the demo request from {{ $request->first_name }} {{ $request->last_name }}? This action cannot be undone.')">
                                                    <i class="bx bx-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No demo requests found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $demoRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
