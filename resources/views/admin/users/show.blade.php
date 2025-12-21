@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">User Details: {{ $user->name }}</h1>
                <div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Users
                    </a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit User
                    </a>
                </div>
            </div>

            <!-- User Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Subscriptions</h5>
                            <h2>{{ $stats['total_subscriptions'] }}</h2>
                            <small>{{ $stats['active_subscriptions'] }} active</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Spent</h5>
                            <h2>${{ number_format($stats['total_spent'], 2) }}</h2>
                            <small>{{ $stats['completed_transactions'] }} successful transactions</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Licenses</h5>
                            <h2>{{ $stats['total_licenses'] }}</h2>
                            <small>Generated licenses</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Transactions</h5>
                            <h2>{{ $stats['total_transactions'] }}</h2>
                            <small>{{ $stats['completed_transactions'] }} completed</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Company:</strong></td>
                                    <td>{{ $user->company ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Website:</strong></td>
                                    <td>
                                        @if($user->website)
                                            <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Account Status:</strong></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Admin Access:</strong></td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="badge bg-warning">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Member Since:</strong></td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Login:</strong></td>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Timezone:</strong></td>
                                    <td>{{ $user->timezone ?? 'UTC' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($user->bio)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Bio:</strong></h6>
                            <p>{{ $user->bio }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Address Information -->
                    @if($user->address || $user->city || $user->state || $user->country)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Address:</strong></h6>
                            <p>
                                @if($user->address){{ $user->address }}<br>@endif
                                @if($user->city || $user->state)
                                    {{ $user->city }}{{ $user->state ? ', ' . $user->state : '' }}<br>
                                @endif
                                @if($user->country){{ $user->country }}@endif
                                @if($user->postal_code) {{ $user->postal_code }}@endif
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Social Media Links -->
                    @if($user->linkedin || $user->twitter || $user->facebook || $user->instagram)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Social Media:</strong></h6>
                            <div class="d-flex gap-2">
                                @if($user->linkedin)
                                    <a href="{{ $user->linkedin }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-linkedin"></i> LinkedIn
                                    </a>
                                @endif
                                @if($user->twitter)
                                    <a href="{{ $user->twitter }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fab fa-twitter"></i> Twitter
                                    </a>
                                @endif
                                @if($user->facebook)
                                    <a href="{{ $user->facebook }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                @endif
                                @if($user->instagram)
                                    <a href="{{ $user->instagram }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="fab fa-instagram"></i> Instagram
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Notification Preferences -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h6><strong>Notification Preferences:</strong></h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $user->email_notifications ? 'checked' : '' }} disabled>
                                        Email Notifications
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $user->security_alerts ? 'checked' : '' }} disabled>
                                        Security Alerts
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $user->marketing_emails ? 'checked' : '' }} disabled>
                                        Marketing Emails
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-check">
                                        <input type="checkbox" class="form-check-input" {{ $user->product_updates ? 'checked' : '' }} disabled>
                                        Product Updates
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    @if($recentActivity->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Plugin</th>
                                        <th>Plan</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentActivity as $activity)
                                    <tr>
                                        <td>
                                            @if($activity['type'] == 'transaction')
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-credit-card me-1"></i>
                                                    {{ ucfirst($activity['transaction_type']) }}
                                                </span>
                                            @else
                                                <span class="badge bg-info">
                                                    <i class="fas fa-sync me-1"></i>
                                                    Subscription
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($activity['product']) && $activity['product'])
                                                {{ $activity['product']->name }}
                                            @elseif(isset($activity['product_name']))
                                                {{ $activity['product_name'] }}
                                            @else
                                                Unknown Plugin
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($activity['plan']) }}</span>
                                        </td>
                                        <td>${{ number_format($activity['amount'], 2) }}</td>
                                        <td>
                                            @if($activity['status'] == 'active' || $activity['status'] == 'completed')
                                                <span class="badge bg-success">{{ ucfirst($activity['status']) }}</span>
                                            @elseif($activity['status'] == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @elseif($activity['status'] == 'expired')
                                                <span class="badge bg-warning">Expired</span>
                                            @elseif($activity['status'] == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($activity['status'] == 'failed')
                                                <span class="badge bg-danger">Failed</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($activity['status']) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($activity['type'] == 'transaction')
                                                {{ $activity['processed_at'] ? $activity['processed_at']->format('M d, Y H:i') : $activity['created_at']->format('M d, Y H:i') }}
                                            @else
                                                {{ $activity['created_at']->format('M d, Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                @if($activity['type'] == 'transaction' && isset($activity['license_key']))
                                                    <button class="btn btn-outline-info" onclick="showLicense('{{ $activity['license_key'] }}')">
                                                        <i class="fas fa-key"></i> License
                                                    </button>
                                                @elseif($activity['type'] == 'subscription' && isset($activity['license']))
                                                    <button class="btn btn-outline-info" onclick="showLicense('{{ $activity['license']->license_key }}')">
                                                        <i class="fas fa-key"></i> License
                                                    </button>
                                                @endif
                                                
                                                @if($activity['type'] == 'transaction')
                                                    <button class="btn btn-outline-primary" onclick="showTransactionDetails({{ $activity['id'] }})">
                                                        <i class="fas fa-info-circle"></i> Details
                                                    </button>
                                                @else
                                                    <button class="btn btn-outline-primary" onclick="showSubscriptionDetails({{ $activity['id'] }})">
                                                        <i class="fas fa-info-circle"></i> Details
                                                    </button>
                                                @endif
                                                
                                                @if($activity['type'] == 'subscription' && ($activity['status'] == 'expired' || $activity['status'] == 'cancelled'))
                                                    <button class="btn btn-success" onclick="showRenewModal({{ $activity['id'] }}, '{{ $activity['product_name'] ?? 'Unknown' }}', '{{ $activity['plan'] }}', {{ $activity['amount'] }})">
                                                        <i class="fas fa-sync-alt"></i> Renew
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-history fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent activity found</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Activated Sites -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Activated Sites</h5>
                </div>
                <div class="card-body">
                    @if($activatedSites->count() > 0)
                        @foreach($activatedSites as $siteGroup)
                            <div class="mb-4">
                                <h6 class="text-primary">{{ $siteGroup['product_name'] }}</h6>
                                <div class="row">
                                    @foreach($siteGroup['sites'] as $site)
                                        <div class="col-md-4 mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-globe text-success me-2"></i>
                                                <a href="http://{{ $site }}" target="_blank" class="text-decoration-none">
                                                    {{ $site }}
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-globe fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No activated sites found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- License Modal -->
<div class="modal fade" id="licenseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-key me-2"></i>License Key
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Copy this license key and use it to activate the plugin.
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-text">
                        <i class="fas fa-key"></i>
                    </span>
                    <input type="text" id="licenseKey" class="form-control font-monospace" readonly>
                    <button class="btn btn-success" onclick="copyLicenseKey()">
                        <i class="fas fa-copy me-1"></i> Copy
                    </button>
                </div>
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        This license key is unique to this user and subscription.
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Renewal Modal -->
<div class="modal fade" id="renewalModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-sync-alt me-2"></i>Renew Subscription
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="renewalForm" method="POST" action="{{ route('admin.subscriptions.renew') }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Renew this subscription to extend access for the user.
                    </div>
                    
                    <input type="hidden" id="renewalSubscriptionId" name="subscription_id">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-cube me-1"></i>Plugin
                            </label>
                            <input type="text" class="form-control" id="renewalPluginName" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-calendar me-1"></i>Current Plan
                            </label>
                            <input type="text" class="form-control" id="renewalCurrentPlan" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>Renewal Period
                            </label>
                            <select class="form-select" id="renewalPeriod" name="renewal_period" required>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly (Save 20%)</option>
                                <option value="lifetime">Lifetime</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-dollar-sign me-1"></i>Price
                            </label>
                            <input type="text" class="form-control" id="renewalPrice" readonly>
                            <input type="hidden" id="renewalAmount" name="amount">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-check me-1"></i>Start Date
                        </label>
                        <input type="date" class="form-control" id="renewalStartDate" name="start_date" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-times me-1"></i>End Date
                        </label>
                        <input type="date" class="form-control" id="renewalEndDate" name="end_date" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-comment me-1"></i>Notes (Optional)
                        </label>
                        <textarea class="form-control" id="renewalNotes" name="notes" rows="2" placeholder="Add any notes about this renewal..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync-alt me-1"></i> Renew Subscription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Pass Laravel data to JavaScript
const recentActivityData = @json($recentActivity);

// Initialize Bootstrap modal
let licenseModal;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize the modal
    licenseModal = new bootstrap.Modal(document.getElementById('licenseModal'));
});

function showLicense(licenseKey) {
    document.getElementById('licenseKey').value = licenseKey;
    licenseModal.show();
}

function copyLicenseKey() {
    const licenseKey = document.getElementById('licenseKey');
    licenseKey.select();
    licenseKey.setSelectionRange(0, 99999); // For mobile devices
    
    try {
        document.execCommand('copy');
        
        // Show feedback
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i> Copied!';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');
        
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
        }, 2000);
    } catch (err) {
        console.error('Failed to copy license key:', err);
        alert('Failed to copy license key. Please copy it manually.');
    }
}

function showSubscriptionDetails(subscriptionId) {
    // Find the subscription data from the recentActivity collection
    const subscription = recentActivityData.find(sub => sub.id == subscriptionId);
    
    if (subscription) {
        const statusBadge = getStatusBadge(subscription.status);
        const planBadge = getPlanBadge(subscription.plan);
        
        // Create and show a modal with subscription details
        const modalHtml = `
            <div class="modal fade" id="subscriptionDetailsModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-info-circle me-2"></i>Subscription Details
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary mb-3">
                                                <i class="fas fa-cube me-2"></i>Plugin Information
                                            </h6>
                                            <div class="mb-2">
                                                <strong>Plugin:</strong><br>
                                                <span class="text-muted">${subscription.product ? subscription.product.name : 'Unknown'}</span>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Plan:</strong><br>
                                                ${planBadge}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Status:</strong><br>
                                                ${statusBadge}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light mb-3">
                                        <div class="card-body">
                                            <h6 class="card-title text-success mb-3">
                                                <i class="fas fa-dollar-sign me-2"></i>Payment Information
                                            </h6>
                                            <div class="mb-2">
                                                <strong>Amount:</strong><br>
                                                <span class="h5 text-success">$${subscription.amount}</span>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Created:</strong><br>
                                                <span class="text-muted">${new Date(subscription.created_at).toLocaleString()}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card border-0 bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title text-warning mb-3">
                                        <i class="fas fa-calendar-alt me-2"></i>Subscription Period
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <strong>Start Date:</strong><br>
                                                <span class="text-muted">${subscription.starts_at ? new Date(subscription.starts_at).toLocaleDateString() : 'N/A'}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <strong>End Date:</strong><br>
                                                <span class="text-muted">${subscription.expires_at ? new Date(subscription.expires_at).toLocaleDateString() : 'N/A'}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <h6 class="card-title text-secondary mb-3">
                                        <i class="fas fa-credit-card me-2"></i>Stripe Information
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <strong>Subscription ID:</strong><br>
                                                <code class="text-muted">${subscription.stripe_subscription_id || 'N/A'}</code>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <strong>Payment Intent ID:</strong><br>
                                                <code class="text-muted">${subscription.stripe_payment_intent_id || 'N/A'}</code>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Remove existing modal if present
        const existingModal = document.getElementById('subscriptionDetailsModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        // Add modal to page and show it
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        const detailsModal = new bootstrap.Modal(document.getElementById('subscriptionDetailsModal'));
        detailsModal.show();
        
        // Remove modal from DOM after it's hidden
        document.getElementById('subscriptionDetailsModal').addEventListener('hidden.bs.modal', function() {
            this.remove();
        });
    } else {
        alert('Subscription details not found for ID: ' + subscriptionId);
    }
}

function getStatusBadge(status) {
    const badges = {
        'active': '<span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Active</span>',
        'cancelled': '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Cancelled</span>',
        'expired': '<span class="badge bg-warning"><i class="fas fa-exclamation-triangle me-1"></i>Expired</span>',
        'pending': '<span class="badge bg-info"><i class="fas fa-clock me-1"></i>Pending</span>'
    };
    return badges[status] || '<span class="badge bg-secondary"><i class="fas fa-question-circle me-1"></i>' + status + '</span>';
}

function getPlanBadge(plan) {
    const badges = {
        'monthly': '<span class="badge bg-primary"><i class="fas fa-calendar me-1"></i>Monthly</span>',
        'yearly': '<span class="badge bg-info"><i class="fas fa-calendar-alt me-1"></i>Yearly</span>',
        'lifetime': '<span class="badge bg-success"><i class="fas fa-infinity me-1"></i>Lifetime</span>'
    };
    return badges[plan] || '<span class="badge bg-secondary"><i class="fas fa-tag me-1"></i>' + plan + '</span>';
}

function showRenewModal(subscriptionId, pluginName, currentPlan, currentAmount) {
    // Set the subscription details
    document.getElementById('renewalSubscriptionId').value = subscriptionId;
    document.getElementById('renewalPluginName').value = pluginName;
    document.getElementById('renewalCurrentPlan').value = currentPlan.charAt(0).toUpperCase() + currentPlan.slice(1);
    
    // Set default dates
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    document.getElementById('renewalStartDate').value = tomorrow.toISOString().split('T')[0];
    
    // Calculate price based on period
    updateRenewalPrice(currentAmount, currentPlan);
    
    // Add event listener for period change
    document.getElementById('renewalPeriod').addEventListener('change', function() {
        updateRenewalPrice(currentAmount, currentPlan);
    });
    
    // Add event listener for start date change
    document.getElementById('renewalStartDate').addEventListener('change', function() {
        updateEndDate();
    });
    
    // Initialize end date
    updateEndDate();
    
    // Show the modal
    const renewalModal = new bootstrap.Modal(document.getElementById('renewalModal'));
    renewalModal.show();
}

function updateRenewalPrice(baseAmount, currentPlan) {
    const period = document.getElementById('renewalPeriod').value;
    let newAmount = baseAmount;
    let priceText = '';
    
    switch(period) {
        case 'monthly':
            newAmount = baseAmount;
            priceText = `$${newAmount.toFixed(2)} / month`;
            break;
        case 'yearly':
            newAmount = baseAmount * 12 * 0.8; // 20% discount for yearly
            priceText = `$${newAmount.toFixed(2)} / year (Save 20%)`;
            break;
        case 'lifetime':
            newAmount = baseAmount * 24; // 2 years worth for lifetime
            priceText = `$${newAmount.toFixed(2)} (One-time)`;
            break;
    }
    
    document.getElementById('renewalPrice').value = priceText;
    document.getElementById('renewalAmount').value = newAmount.toFixed(2);
}

function updateEndDate() {
    const startDate = new Date(document.getElementById('renewalStartDate').value);
    const period = document.getElementById('renewalPeriod').value;
    let endDate = new Date(startDate);
    
    switch(period) {
        case 'monthly':
            endDate.setMonth(endDate.getMonth() + 1);
            break;
        case 'yearly':
            endDate.setFullYear(endDate.getFullYear() + 1);
            break;
        case 'lifetime':
            endDate.setFullYear(endDate.getFullYear() + 100); // Far future date
            break;
    }
    
    document.getElementById('renewalEndDate').value = endDate.toISOString().split('T')[0];
}

// Handle form submission
document.getElementById('renewalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
    submitBtn.disabled = true;
    
    // Submit the form
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and show success message
            bootstrap.Modal.getInstance(document.getElementById('renewalModal')).hide();
            
            // Show success alert
            const alertHtml = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.querySelector('.container-fluid').insertAdjacentHTML('afterbegin', alertHtml);
            
            // Reload page after 2 seconds to show updated data
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            // Show error message
            alert('Error: ' + (data.message || 'Something went wrong. Please try again.'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: Something went wrong. Please try again.');
    })
    .finally(() => {
        // Reset button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});
</script>
@endsection
