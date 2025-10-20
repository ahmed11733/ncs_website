@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Customer Support Requests</h4>
                    <span class="badge bg-primary">{{ $customerSupportRequests->total() }} Total Requests</span>
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
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Industry</th>
                                    <th>Employees</th>
                                    <th>Issue Description</th>
                                    <th>Availability Hours</th>
                                    <th>Message</th>
                                    <th>Attachment</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($customerSupportRequests as $request)
                                    @if($request->type === 'customer-support')
                                        <tr>
                                            <td>#{{ $request->id }}</td>
                                            <td>{{ $request->first_name }} {{ $request->last_name }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->phone }}</td>
                                            <td>{{ $request->company_name }}</td>
                                            <td>{{ $request->industry }}</td>
                                            <td>{{ $request->number_of_employees }}</td>
                                            <td>{{ Str::limit($request->issue_description, 60) }}</td>
                                            <td>{{ Str::limit($request->availability_hours, 40) }}</td>
                                            <td>{{ Str::limit($request->message, 50) }}</td>
                                            <td>
                                                @if($request->attachment)
                                                    <a href="{{ $request->attachment }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        View
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <form action="{{ route('admin.demo-requests.destroy', $request) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete the customer support request from {{ $request->first_name }} {{ $request->last_name }}? This action cannot be undone.')">
                                                        <i class="bx bx-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center">No customer support requests found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $customerSupportRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
