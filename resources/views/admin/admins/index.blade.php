@extends('layouts.admin')
@section('title', 'Admins')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Admin Users</h2>
    <a href="{{ route('admin.admins.create') }}" class="btn btn-success">
        <i class="bi bi-person-plus"></i> Add Admin
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td>{{ $a->email }}</td>
                        <td>{{ $a->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($a->id != Auth::guard('admin')->id())
                                <form method="POST" action="{{ route('admin.admins.destroy', $a->id) }}"
                                      onsubmit="return confirm('Delete this admin?')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-secondary">You</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No admins.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3 d-flex justify-content-center">{{ $admins->links() }}</div>
@endsection
