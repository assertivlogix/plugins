@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">Licenses</h1>
        <p class="page-subtitle">Manage all license keys and their status</p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Total Licenses</div>
                        <div class="stats-value">{{ $stats['total'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-key stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Active</div>
                        <div class="stats-value">{{ $stats['active'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Expired</div>
                        <div class="stats-value">{{ $stats['expired'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card info">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="stats-label">Cancelled</div>
                        <div class="stats-value">{{ $stats['cancelled'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-ban stats-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="m-0">License Management</h6>
            </div>
            <div class="col-auto">
                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.licenses.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search licenses..." value="{{ request('search') }}">
                    <select name="status" class="form-select me-2">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>License Key</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Plan</th>
                        <th>Activation Limit</th>
                        <th>Status</th>
                        <th>Expires</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($licenses as $license)
                        <tr>
                            <td>
                                <code class="license-key">{{ $license->license_key }}</code>
                                <button class="btn btn-sm btn-link p-0 ms-1" onclick="copyToClipboard('{{ $license->license_key }}')">
                                    <i class="fas fa-copy text-muted"></i>
                                </button>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar-sm me-2">
                                        {{ strtoupper(substr($license->subscription->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $license->subscription->user->name }}</div>
                                        <small class="text-muted">{{ $license->subscription->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $license->subscription->product->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($license->subscription->plan) }}</span>
                            </td>
                            <td>{{ $license->activation_limit }}</td>
                            <td>
                                @if($license->subscription->status === 'active' && (!$license->subscription->expires_at || $license->subscription->expires_at->isFuture()))
                                    <span class="badge bg-success">Active</span>
                                @elseif($license->subscription->expires_at && $license->subscription->expires_at->isPast())
                                    <span class="badge bg-warning">Expired</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($license->subscription->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($license->subscription->expires_at)
                                    <small class="{{ $license->subscription->expires_at->isPast() ? 'text-danger' : 'text-muted' }}">
                                        {{ $license->subscription->expires_at->format('M d, Y') }}
                                        @if($license->subscription->expires_at->isPast())
                                            <br><span class="text-danger">({{ $license->subscription->expires_at->diffForHumans() }})</span>
                                        @endif
                                    </small>
                                @else
                                    <span class="text-muted">Never</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $license->created_at->format('M d, Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.licenses.show', $license) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.licenses.destroy', $license) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this license?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-key fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No licenses found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $licenses->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
.license-key {
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.85rem;
    font-family: 'Courier New', monospace;
}

.user-avatar-sm {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--sidebar-bg);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: bold;
}
</style>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check text-success"></i>';
        setTimeout(() => {
            btn.innerHTML = originalIcon;
        }, 1000);
    });
}
</script>
@endpush
