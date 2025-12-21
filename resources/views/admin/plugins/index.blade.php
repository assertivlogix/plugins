@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">WordPress Plugins</h1>
        <p class="page-subtitle">Manage all WordPress plugins in the system</p>
    </div>
    <a href="{{ route('admin.plugins.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Plugin
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Version</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plugins as $plugin)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($plugin->icon_image)
                                        <img src="{{ asset('storage/' . $plugin->icon_image) }}" alt="{{ $plugin->name }}" style="width: 32px; height: 32px; margin-right: 10px; border-radius: 4px;">
                                    @else
                                        <div style="width: 32px; height: 32px; margin-right: 10px; background: #f8f9fc; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-plug text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>{{ $plugin->name }}</strong>
                                        @if($plugin->short_description)
                                            <br><small class="text-muted">{{ Str::limit($plugin->short_description, 50) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $plugin->version ?? '1.0.0' }}</td>
                            <td>
                                @if($plugin->price_monthly)
                                    ${{ number_format($plugin->price_monthly, 2) }}/mo
                                @endif
                                @if($plugin->price_yearly)
                                    <br><small>${{ number_format($plugin->price_yearly, 2) }}/yr</small>
                                @endif
                            </td>
                            <td>
                                @if($plugin->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $plugin->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.plugins.show', $plugin->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.plugins.edit', $plugin->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.plugins.destroy', $plugin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this plugin?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $plugins->links() }}
        </div>
    </div>
</div>
@endsection
