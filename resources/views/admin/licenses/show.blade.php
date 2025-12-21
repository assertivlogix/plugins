@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="page-title">License Details</h1>
        <p class="page-subtitle">View license information and activation history</p>
    </div>
    <div>
        <a href="{{ route('admin.licenses.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Licenses
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- License Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">License Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">License Key</label>
                            <div class="d-flex align-items-center">
                                <code class="license-key me-2">{{ $license->license_key }}</code>
                                <button class="btn btn-sm btn-link p-0" onclick="copyToClipboard('{{ $license->license_key }}')">
                                    <i class="fas fa-copy text-muted"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Activation Limit</label>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('admin.licenses.update', $license) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group" style="width: 200px;">
                                        <input type="number" name="activation_limit" min="1" max="100" 
                                            class="form-control" value="{{ $license->activation_limit }}" required>
                                        <span class="input-group-text">sites</span>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary ms-2">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <p class="mb-0">
                                @if($license->subscription->status === 'active' && (!$license->subscription->expires_at || $license->subscription->expires_at->isFuture()))
                                    <span class="badge bg-success">Active</span>
                                @elseif($license->subscription->expires_at && $license->subscription->expires_at->isPast())
                                    <span class="badge bg-warning">Expired</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($license->subscription->status) }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Created</label>
                            <p class="mb-0">{{ $license->created_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Expires</label>
                            <p class="mb-0">
                                @if($license->subscription->expires_at)
                                    <span class="{{ $license->subscription->expires_at->isPast() ? 'text-danger' : '' }}">
                                        {{ $license->subscription->expires_at->format('F d, Y \a\t g:i A') }}
                                        @if($license->subscription->expires_at->isPast())
                                            <br><small class="text-danger">({{ $license->subscription->expires_at->diffForHumans() }})</small>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-muted">Never</span>
                                @endif
                            </p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <p class="mb-0">{{ $license->updated_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase & Renewal History -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">Purchase & Renewal History</h6>
            </div>
            <div class="card-body">
                <!-- Initial Purchase -->
                @if($initialPurchase)
                <div class="mb-4">
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-shopping-cart me-2"></i>Initial Purchase
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td width="150"><strong>Transaction ID:</strong></td>
                                <td><code>{{ $initialPurchase->transaction_id }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Amount:</strong></td>
                                <td><span class="fw-bold text-success">${{ number_format($initialPurchase->amount, 2) }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Payment Method:</strong></td>
                                <td>{{ ucfirst($initialPurchase->payment_method) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($initialPurchase->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($initialPurchase->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($initialPurchase->status == 'failed')
                                        <span class="badge bg-danger">Failed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($initialPurchase->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td>{{ $initialPurchase->processed_at ? $initialPurchase->processed_at->format('F d, Y \a\t g:i A') : $initialPurchase->created_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                            @if($initialPurchase->description)
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{{ $initialPurchase->description }}</td>
                            </tr>
                            @endif
                            @if($initialPurchase->payment_gateway_transaction_id)
                            <tr>
                                <td><strong>Gateway ID:</strong></td>
                                <td><code>{{ $initialPurchase->payment_gateway_transaction_id }}</code></td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                @else
                <div class="text-center py-3 mb-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                    <p class="text-muted mb-0">No initial purchase transaction found</p>
                </div>
                @endif

                <!-- Renewals -->
                @if($renewals->count() > 0)
                <div>
                    <h6 class="text-info mb-3">
                        <i class="fas fa-sync-alt me-2"></i>Renewal History ({{ $renewals->count() }})
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Period</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($renewals as $renewal)
                                <tr>
                                    <td><code>{{ $renewal->transaction_id }}</code></td>
                                    <td><span class="fw-bold">${{ number_format($renewal->amount, 2) }}</span></td>
                                    <td>
                                        @if($renewal->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($renewal->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($renewal->status == 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($renewal->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($renewal->period_start && $renewal->period_end)
                                            <small>{{ $renewal->period_start->format('M d, Y') }} - {{ $renewal->period_end->format('M d, Y') }}</small>
                                        @else
                                            <small class="text-muted">N/A</small>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $renewal->processed_at ? $renewal->processed_at->format('M d, Y') : $renewal->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-info" onclick="showTransactionDetails({{ $renewal->id }})">
                                            <i class="fas fa-info-circle"></i> Details
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="text-center py-3">
                    <i class="fas fa-history fa-2x text-muted mb-2"></i>
                    <p class="text-muted mb-0">No renewals found</p>
                </div>
                @endif

                <!-- Total Spent Summary -->
                <div class="mt-4 p-3 bg-light rounded">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h6 class="mb-0">Total Amount Spent on This License:</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <h4 class="mb-0 text-success">${{ number_format($totalSpent, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activated Sites -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0">Activated Sites</h6>
            </div>
            <div class="card-body">
                @if($license->activatedSites->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Site URL</th>
                                    <th>IP Address</th>
                                    <th>Activated</th>
                                    <th>Last Seen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($license->activatedSites as $site)
                                    <tr>
                                        <td>
                                            <a href="{{ $site->site_url }}" target="_blank" class="text-decoration-none">
                                                {{ $site->site_url }}
                                                <i class="fas fa-external-link-alt ms-1 small"></i>
                                            </a>
                                        </td>
                                        <td><code>{{ $site->ip_address }}</code></td>
                                        <td>{{ $site->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <small class="text-muted">{{ $site->updated_at->diffForHumans() }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-globe fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No sites have been activated with this license.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="user-avatar me-3">
                        {{ strtoupper(substr($license->subscription->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="mb-0">{{ $license->subscription->user->name }}</h6>
                        <small class="text-muted">{{ $license->subscription->user->email }}</small>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Member Since</label>
                    <p class="mb-0">{{ $license->subscription->user->created_at->format('F d, Y') }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Admin Status</label>
                    <p class="mb-0">
                        @if($license->subscription->user->is_admin)
                            <span class="badge bg-success">Admin User</span>
                        @else
                            <span class="badge bg-secondary">Regular User</span>
                        @endif
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.edit', $license->subscription->user) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-user me-1"></i>View User
                    </a>
                    <a href="mailto:{{ $license->subscription->user->email }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-envelope me-1"></i>Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">Product Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Product</label>
                    <h6 class="mb-0">{{ $license->subscription->product->name }}</h6>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Plan</label>
                    <p class="mb-0">
                        <span class="badge bg-info">{{ ucfirst($license->subscription->plan) }}</span>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Current Price</label>
                    <p class="mb-0 fw-bold">${{ number_format($license->subscription->amount, 2) }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Subscription ID</label>
                    <p class="mb-0"><small>{{ $license->subscription->id }}</small></p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.plugins.show', $license->subscription->product) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-box me-1"></i>View Product
                    </a>
                </div>
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">Financial Summary</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Total Spent</label>
                    <h4 class="mb-0 text-success">${{ number_format($totalSpent, 2) }}</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Initial Purchase</label>
                    <p class="mb-0">
                        @if($initialPurchase)
                            ${{ number_format($initialPurchase->amount, 2) }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Renewals</label>
                    <p class="mb-0">
                        {{ $renewals->count() }} renewal{{ $renewals->count() != 1 ? 's' : '' }}
                        @if($renewals->count() > 0)
                            (${{ number_format($renewals->where('status', 'completed')->sum('amount'), 2) }})
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Total Transactions</label>
                    <p class="mb-0">{{ $transactions->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-secondary" onclick="copyToClipboard('{{ $license->license_key }}')">
                        <i class="fas fa-copy me-2"></i>Copy License Key
                    </button>
                    <button class="btn btn-outline-info" onclick="downloadLicense()">
                        <i class="fas fa-download me-2"></i>Download License File
                    </button>
                    <form action="{{ route('admin.licenses.destroy', $license) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this license? This action cannot be undone.')">
                            <i class="fas fa-trash me-2"></i>Delete License
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction Details Modal -->
<div class="modal fade" id="transactionDetailsModal" tabindex="-1" aria-labelledby="transactionDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionDetailsModalLabel">
                    <i class="fas fa-receipt me-2"></i>Transaction Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="transactionDetailsContent">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Loading transaction details...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
.license-key {
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-family: 'Courier New', monospace;
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--sidebar-bg);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: bold;
}
</style>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-secondary');
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-secondary');
        }, 2000);
    });
}

function downloadLicense() {
    const licenseData = {
        license_key: '{{ $license->license_key }}',
        product: '{{ $license->subscription->product->name }}',
        user: '{{ $license->subscription->user->name }}',
        email: '{{ $license->subscription->user->email }}',
        expires_at: '{{ $license->subscription->expires_at ? $license->subscription->expires_at->format('Y-m-d') : 'never' }}',
        activation_limit: {{ $license->activation_limit }}
    };

    const dataStr = JSON.stringify(licenseData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);

    const exportFileDefaultName = 'license_{{ $license->license_key }}.json';

    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
}

function showTransactionDetails(transactionId) {
    // Find the transaction from the available data
    const transactions = @json($transactions);
    const transaction = transactions.find(t => t.id == transactionId);
    
    if (!transaction) {
        alert('Transaction not found');
        return;
    }
    
    // Build the transaction details HTML
    let statusBadge = '';
    if (transaction.status === 'completed') {
        statusBadge = '<span class="badge bg-success">Completed</span>';
    } else if (transaction.status === 'pending') {
        statusBadge = '<span class="badge bg-warning">Pending</span>';
    } else if (transaction.status === 'failed') {
        statusBadge = '<span class="badge bg-danger">Failed</span>';
    } else {
        statusBadge = '<span class="badge bg-secondary">' + transaction.status.charAt(0).toUpperCase() + transaction.status.slice(1) + '</span>';
    }
    
    let typeBadge = '';
    if (transaction.type === 'purchase') {
        typeBadge = '<span class="badge bg-primary"><i class="fas fa-shopping-cart me-1"></i>Purchase</span>';
    } else if (transaction.type === 'renewal') {
        typeBadge = '<span class="badge bg-info"><i class="fas fa-sync-alt me-1"></i>Renewal</span>';
    } else if (transaction.type === 'refund') {
        typeBadge = '<span class="badge bg-danger"><i class="fas fa-undo me-1"></i>Refund</span>';
    } else {
        typeBadge = '<span class="badge bg-secondary">' + transaction.type.charAt(0).toUpperCase() + transaction.type.slice(1) + '</span>';
    }
    
    const detailsHtml = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-primary mb-3">Transaction Information</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="140"><strong>Transaction ID:</strong></td>
                        <td><code>${transaction.transaction_id}</code></td>
                    </tr>
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>${typeBadge}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>${statusBadge}</td>
                    </tr>
                    <tr>
                        <td><strong>Amount:</strong></td>
                        <td><span class="fw-bold ${transaction.type === 'refund' ? 'text-danger' : 'text-success'}">$${parseFloat(transaction.amount).toFixed(2)}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Currency:</strong></td>
                        <td>${transaction.currency || 'USD'}</td>
                    </tr>
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td>${transaction.payment_method ? transaction.payment_method.charAt(0).toUpperCase() + transaction.payment_method.slice(1) : 'N/A'}</td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>${new Date(transaction.created_at).toLocaleString()}</td>
                    </tr>
                    <tr>
                        <td><strong>Processed:</strong></td>
                        <td>${transaction.processed_at ? new Date(transaction.processed_at).toLocaleString() : 'Not processed'}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-primary mb-3">Product & Plan Details</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="140"><strong>Product:</strong></td>
                        <td>${transaction.product_name || 'N/A'}</td>
                    </tr>
                    <tr>
                        <td><strong>Plan:</strong></td>
                        <td><span class="badge bg-info">${transaction.plan ? transaction.plan.charAt(0).toUpperCase() + transaction.plan.slice(1) : 'N/A'}</span></td>
                    </tr>
                    <tr>
                        <td><strong>License Key:</strong></td>
                        <td><code>${transaction.license_key || 'N/A'}</code></td>
                    </tr>
                    ${transaction.period_start ? `
                    <tr>
                        <td><strong>Period Start:</strong></td>
                        <td>${new Date(transaction.period_start).toLocaleDateString()}</td>
                    </tr>
                    ` : ''}
                    ${transaction.period_end ? `
                    <tr>
                        <td><strong>Period End:</strong></td>
                        <td>${new Date(transaction.period_end).toLocaleDateString()}</td>
                    </tr>
                    ` : ''}
                    ${transaction.original_amount && transaction.original_amount != transaction.amount ? `
                    <tr>
                        <td><strong>Original Amount:</strong></td>
                        <td>$${parseFloat(transaction.original_amount).toFixed(2)}</td>
                    </tr>
                    ` : ''}
                    ${transaction.discount_amount && transaction.discount_amount > 0 ? `
                    <tr>
                        <td><strong>Discount:</strong></td>
                        <td class="text-success">-$${parseFloat(transaction.discount_amount).toFixed(2)}</td>
                    </tr>
                    ` : ''}
                    ${transaction.discount_code ? `
                    <tr>
                        <td><strong>Discount Code:</strong></td>
                        <td><code>${transaction.discount_code}</code></td>
                    </tr>
                    ` : ''}
                </table>
            </div>
        </div>
        
        ${transaction.description ? `
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="text-primary mb-2">Description</h6>
                <p class="text-muted">${transaction.description}</p>
            </div>
        </div>
        ` : ''}
        
        ${transaction.payment_gateway_transaction_id ? `
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="text-primary mb-2">Payment Gateway Information</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="200"><strong>Gateway Transaction ID:</strong></td>
                        <td><code>${transaction.payment_gateway_transaction_id}</code></td>
                    </tr>
                    ${transaction.payment_gateway_customer_id ? `
                    <tr>
                        <td><strong>Gateway Customer ID:</strong></td>
                        <td><code>${transaction.payment_gateway_customer_id}</code></td>
                    </tr>
                    ` : ''}
                </table>
            </div>
        </div>
        ` : ''}
        
        ${transaction.billing_name || transaction.billing_email ? `
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="text-primary mb-2">Billing Information</h6>
                <table class="table table-sm table-borderless">
                    ${transaction.billing_name ? `
                    <tr>
                        <td width="140"><strong>Name:</strong></td>
                        <td>${transaction.billing_name}</td>
                    </tr>
                    ` : ''}
                    ${transaction.billing_email ? `
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>${transaction.billing_email}</td>
                    </tr>
                    ` : ''}
                </table>
            </div>
        </div>
        ` : ''}
    `;
    
    // Update modal content and show it
    document.getElementById('transactionDetailsContent').innerHTML = detailsHtml;
    const modal = new bootstrap.Modal(document.getElementById('transactionDetailsModal'));
    modal.show();
}
</script>
@endpush
