@extends('layouts.frontend')

@section('title', 'My Licenses')

@section('content')
<style>
.licenses-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
    min-height: 100vh;
}

.page-header {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info h1 {
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.header-info p {
    color: #6c757d;
    font-size: 16px;
    margin: 0;
}

.btn-buy-new {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s ease;
}

.btn-buy-new:hover {
    background: #0056b3;
    color: white;
}

.content-wrapper {
    display: flex;
    gap: 30px;
    align-items: flex-start;
}

.main-content {
    flex: 1;
    min-width: 0;
}

.sidebar {
    width: 320px;
    flex-shrink: 0;
}

.main-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-body-custom {
    padding: 30px;
}

/* Quick Actions Sidebar Styles */
.quick-actions-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 20px;
}

.quick-actions-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    text-align: center;
}

.quick-actions-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.quick-actions-header p {
    margin: 5px 0 0 0;
    font-size: 14px;
    opacity: 0.9;
}

.quick-actions-body {
    padding: 20px;
}

.quick-action-item {
    display: flex;
    align-items: center;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    background: #f8f9fa;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}

.quick-action-item:hover {
    background: #e9ecef;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
}

.quick-action-item:last-child {
    margin-bottom: 0;
}

.quick-action-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    margin-right: 15px;
    flex-shrink: 0;
}

.quick-action-content h6 {
    margin: 0 0 3px 0;
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
}

.quick-action-content p {
    margin: 0;
    font-size: 12px;
    color: #6c757d;
}

.quick-action-item:hover .quick-action-content h6 {
    color: #007bff;
}

/* Stats Card */
.stats-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.stats-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 20px;
    text-align: center;
}

.stats-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.stats-body {
    padding: 20px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
}

.stat-value {
    font-weight: 600;
    font-size: 16px;
    color: #2c3e50;
}

.stat-value.text-success {
    color: #28a745;
}

.stat-value.text-warning {
    color: #ffc107;
}

.stat-value.text-danger {
    color: #dc3545;
}

.licenses-table {
    width: 100%;
    border-collapse: collapse;
}

.licenses-table th {
    background: #f8f9fa;
    padding: 15px 20px;
    text-align: left;
    font-weight: 600;
    color: #495057;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #dee2e6;
}

.licenses-table td {
    padding: 20px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.licenses-table tr:hover {
    background: #f8f9fa;
}

.license-key-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.license-key-code {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 6px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    border: 1px solid #dee2e6;
    color: #495057;
}

.btn-copy {
    width: 32px;
    height: 32px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-copy:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-icon {
    width: 40px;
    height: 40px;
    background: #007bff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.product-details h6 {
    margin: 0 0 3px 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
}

.product-details small {
    color: #6c757d;
    font-size: 12px;
}

.badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-info {
    background: #17a2b8;
    color: white;
}

.badge-success {
    background: #28a745;
    color: white;
}

.badge-warning {
    background: #ffc107;
    color: #212529;
}

.badge-secondary {
    background: #6c757d;
    color: white;
}

.activation-info {
    display: flex;
    align-items: center;
    gap: 5px;
}

.activation-info span {
    font-weight: 600;
    color: #2c3e50;
}

.activation-info small {
    color: #6c757d;
    font-size: 12px;
}

.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-action {
    width: 36px;
    height: 36px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.btn-action.btn-info:hover {
    background: #17a2b8;
    border-color: #17a2b8;
}

.btn-action.btn-success:hover {
    background: #28a745;
    border-color: #28a745;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-state i {
    font-size: 64px;
    color: #dee2e6;
    margin-bottom: 25px;
}

.empty-state h5 {
    color: #6c757d;
    margin-bottom: 15px;
    font-weight: 500;
    font-size: 18px;
}

.empty-state p {
    color: #adb5bd;
    margin-bottom: 30px;
    font-size: 16px;
}

.btn-primary-large {
    background: #007bff;
    color: white;
    border: none;
    padding: 14px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: background 0.2s ease;
}

.btn-primary-large:hover {
    background: #0056b3;
    color: white;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

/* Modal Styles */
.modal-content {
    border-radius: 12px;
    border: none;
}

.modal-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 20px 25px;
}

.modal-title {
    color: #2c3e50;
    font-weight: 600;
}

.modal-body {
    padding: 25px;
}

@media (max-width: 768px) {
    .licenses-container {
        padding: 15px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .header-info h1 {
        font-size: 24px;
    }
    
    .content-wrapper {
        flex-direction: column;
        gap: 20px;
    }
    
    .sidebar {
        width: 100%;
    }
    
    .licenses-table {
        font-size: 14px;
    }
    
    .licenses-table th,
    .licenses-table td {
        padding: 12px 10px;
    }
    
    .license-key-cell {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .product-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
}
</style>

<div class="licenses-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-info">
                <h1>My Licenses</h1>
                <p>Manage your license keys and activation details.</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn-buy-new">
                <i class="fas fa-plus"></i> Buy New License
            </a>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Licenses Table -->
            <div class="main-card">
                <div class="card-body-custom">
                    @if($licenses && $licenses->count() > 0)
                        <div style="overflow-x: auto;">
                            <table class="licenses-table">
                                <thead>
                                    <tr>
                                        <th>License Key</th>
                                        <th>Product</th>
                                        <th>Plan</th>
                                        <th>Activation Limit</th>
                                        <th>Status</th>
                                        <th>Expires</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($licenses as $license)
                                        <tr>
                                            <td>
                                                <div class="license-key-cell">
                                                    <code class="license-key-code">{{ $license->license_key }}</code>
                                                    <button class="btn-copy" onclick="copyToClipboard('{{ $license->license_key }}')" title="Copy license key">
                                                        <i class="fas fa-copy"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product-info">
                                                    <div class="product-icon">
                                                        <i class="fas fa-cube"></i>
                                                    </div>
                                                    <div class="product-details">
                                                        <h6>{{ $license->subscription->product->name }}</h6>
                                                        <small>ID: {{ $license->subscription->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ ucfirst($license->subscription->plan) }}</span>
                                            </td>
                                            <td>
                                                <div class="activation-info">
                                                    <span>{{ $license->activations_used ?? 0 }}/{{ $license->activation_limit }}</span>
                                                    <small>sites</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($license->status === 'active' && $license->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($license->status === 'expired')
                                                    <span class="badge badge-danger">Expired</span>
                                                @elseif($license->status === 'suspended')
                                                    <span class="badge badge-warning">Suspended</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst($license->status) }}</span>
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
                                                <div class="action-buttons">
                                                    <button class="btn-action btn-info" onclick="downloadLicense('{{ $license->license_key }}', '{{ $license->subscription->product->name }}')" title="Download license">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                    <button class="btn-action" onclick="showLicenseDetails('{{ $license->id }}')" title="View details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-success" onclick="renewLicense('{{ $license->id }}')" title="Renew license">
                                                        <i class="fas fa-sync"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-wrapper">
                            {{ $licenses->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-key"></i>
                            <h5>No licenses found</h5>
                            <p>You haven't purchased any plugins yet. Get started by browsing our collection.</p>
                            <a href="{{ route('products.index') }}" class="btn-primary-large">
                                <i class="fas fa-shopping-cart"></i> Browse Plugins
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Quick Actions Card -->
            <div class="quick-actions-card">
                <div class="quick-actions-header">
                    <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    <p>Manage your licenses efficiently</p>
                </div>
                <div class="quick-actions-body">
                    <a href="{{ route('products.index') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Buy New License</h6>
                            <p>Purchase additional plugins</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('user.billing.history') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Billing History</h6>
                            <p>View payment records</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="downloadAllLicenses()" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Download All</h6>
                            <p>Export all license keys</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('profile') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Account Settings</h6>
                            <p>Update profile information</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="showSupportModal()" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Get Support</h6>
                            <p>Contact our support team</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="stats-card">
                <div class="stats-header">
                    <h5><i class="fas fa-chart-bar me-2"></i>LICENSE STATS</h5>
                </div>
                <div class="stats-body">
                    <div class="stat-item">
                        <span class="stat-label">Total Licenses</span>
                        <span class="stat-value">{{ $licenses ? $licenses->count() : 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Active Licenses</span>
                        <span class="stat-value text-success">
                            {{ $licenses ? $licenses->where('status', 'active')->count() : 0 }}
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Expiring Soon</span>
                        <span class="stat-value text-warning">
                            {{ $licenses ? $licenses->filter(function($license) {
                                return $license->subscription->expires_at && 
                                       $license->subscription->expires_at->copy()->addDays(7)->isFuture() && 
                                       $license->subscription->expires_at->copy()->addDays(7)->isPast();
                            })->count() : 0 }}
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Expired</span>
                        <span class="stat-value text-danger">
                            {{ $licenses ? $licenses->filter(function($license) {
                                return $license->subscription->expires_at && $license->subscription->expires_at->isPast();
                            })->count() : 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- License Details Modal -->
<div class="modal fade" id="licenseDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white border-0 py-3">
                <h5 class="modal-title fw-bold mb-0">
                    <i class="fas fa-key me-2"></i>License Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <div id="licenseDetailsContent">
                    <!-- License details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Renewal Modal -->
<div class="modal fade" id="renewalModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-sync-alt me-2"></i>Renew Subscription
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="renewalForm" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Step 1: Renewal Details -->
                    <div id="renewalStep">
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Renew your subscription to continue enjoying premium features and updates.
                        </div>
                        
                        <input type="hidden" id="renewalLicenseId" name="license_id">
                        <input type="hidden" id="renewalSubscriptionId" name="subscription_id">
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">
                                    <i class="fas fa-cube me-1"></i>Plugin
                                </label>
                                <input type="text" class="form-control" id="renewalPluginName" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-calendar me-1"></i>Current Plan
                                </label>
                                <input type="text" class="form-control" id="renewalCurrentPlan" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-dollar-sign me-1"></i>Current Price
                                </label>
                                <input type="text" class="form-control" id="renewalCurrentPrice" readonly>
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
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-tag me-1"></i>New Price
                                </label>
                                <input type="text" class="form-control" id="renewalNewPrice" readonly>
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
                        
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-shield-alt me-2"></i>Payment Summary
                                </h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Subtotal:</span>
                                    <span id="subtotalAmount">$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-success">
                                    <strong>Total:</strong>
                                    <strong id="totalAmount">$0.00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Payment Details -->
                    <div id="paymentStep" style="display: none;">
                        <h6 class="mb-3">
                            <i class="fas fa-credit-card me-2"></i>Payment Information
                        </h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Cardholder Name</label>
                                <input type="text" class="form-control" id="cardholderName" placeholder="John Doe" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    You will be redirected to Razorpay to complete your payment securely.
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-warning bg-light mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-lock text-warning me-2"></i>
                                    <small class="mb-0">Your payment information is secure and encrypted</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-2">
                                    <i class="fas fa-receipt me-2"></i>Order Summary
                                </h6>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Plugin:</span>
                                    <strong id="orderPluginName">-</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Plan:</span>
                                    <strong id="orderPlanName">-</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Duration:</span>
                                    <strong id="orderDuration">-</strong>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center text-success">
                                    <strong>Total Amount:</strong>
                                    <strong id="orderTotal">$0.00</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="renewalFooter">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="button" class="btn btn-success" onclick="showPaymentStep()">
                            <i class="fas fa-arrow-right me-1"></i> Proceed to Payment
                        </button>
                    </div>
                    <div id="paymentFooter" style="display: none;">
                        <button type="button" class="btn btn-secondary" onclick="showRenewalStep()">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </button>
                        <button type="button" class="btn btn-success" onclick="processPayment()">
                            <i class="fas fa-lock me-1"></i> Complete Payment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// License data passed from controller
const licenseData = @json($licenses->items());

// Razorpay initialization not needed here as it's done on demand



function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.style.background = '#28a745';
        btn.style.borderColor = '#28a745';
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.style.background = '';
            btn.style.borderColor = '';
        }, 1000);
    });
}

function downloadLicense(licenseKey, productName) {
    // Create license data for download
    const licenseData = {
        license_key: licenseKey,
        product_name: productName,
        downloaded_at: new Date().toISOString(),
        format: 'json'
    };

    const dataStr = JSON.stringify(licenseData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);

    const exportFileDefaultName = 'license_' + licenseKey.replace(/-/g, '_') + '.json';

    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
}

function showLicenseDetails(licenseId) {
    console.log('showLicenseDetails called with ID:', licenseId);
    console.log('Available licenses:', licenseData);
    
    // Wait for Bootstrap to load
    function waitForBootstrap(callback, maxAttempts = 50) {
        var attempts = 0;
        
        function checkBootstrap() {
            attempts++;
            
            if (typeof bootstrap !== 'undefined') {
                console.log('Bootstrap is loaded, proceeding...');
                callback();
            } else if (window.bootstrapLoaded === false) {
                console.error('Bootstrap failed to load completely');
                alert('Error: Bootstrap could not be loaded. Please check your internet connection and refresh the page.');
            } else if (attempts < maxAttempts) {
                console.log('Waiting for Bootstrap to load... attempt:', attempts);
                setTimeout(checkBootstrap, 100);
            } else {
                console.error('Bootstrap loading timeout after', maxAttempts, 'attempts');
                alert('Error: Bootstrap loading timeout. Please refresh the page and try again.');
            }
        }
        
        checkBootstrap();
    }
    
    waitForBootstrap(function() {
        try {
            // Find the license data from the page
            const license = licenseData.find(l => l.id == licenseId);
            
            console.log('Found license:', license);
            
            // Check if modal element exists
            const modalElement = document.getElementById('licenseDetailsModal');
            if (!modalElement) {
                console.error('Modal element not found');
                alert('Error: Modal element not found. Please refresh the page.');
                return;
            }
            
            const modal = new bootstrap.Modal(modalElement);
            const contentDiv = document.getElementById('licenseDetailsContent');
            
            if (license && license.subscription && license.subscription.product) {
                // Show loading state briefly
                contentDiv.innerHTML = `
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3">Loading license details...</p>
                    </div>
                `;
                
                modal.show();
                
                // Simulate loading delay and then show actual data
                setTimeout(() => {
                    try {
                        // Safely escape values for template literal
                        const licenseKey = (license.license_key || '').replace(/`/g, '\\`');
                        const productName = (license.subscription.product.name || '').replace(/`/g, '\\`');
                        const productId = license.subscription.product.id || 'N/A';
                        const subscriptionId = license.subscription.id || 'N/A';
                        const subscriptionPlan = license.subscription.plan || 'unknown';
                        const subscriptionStatus = license.subscription.status || 'unknown';
                        const subscriptionAmount = license.subscription.amount || '0.00';
                        const expiresAt = license.subscription.expires_at;
                        const activationLimit = license.activation_limit || 0;
                        const activationsUsed = license.activations_used || 0;
                        const licenseStatus = license.status || 'active';
                        const licenseVersion = license.version || '1.0.0';
                        const createdAt = license.created_at;
                        const licenseId = license.id;
                        
                        // Calculate activation information
                        const currentActivations = activationsUsed; // Use actual activations used
                        const availableActivations = activationLimit - currentActivations;
                        const activatedWebsites = []; // Empty array since no sites are activated
                        
                        contentDiv.innerHTML = `
                            <div class="p-0">
                                <!-- Clean Header -->
                                <div class="bg-primary text-white p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                                                    <i class="fas fa-key fa-lg"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 fw-bold">${productName}</h4>
                                                    <p class="mb-0 opacity-75">License #${licenseId.toString().padStart(6, '0')}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div class="mb-2">
                                                <span class="badge bg-white text-primary fs-6 px-3 py-2">${subscriptionStatus === 'active' ? 'Active' : subscriptionStatus}</span>
                                            </div>
                                            <small class="opacity-75">${subscriptionPlan.charAt(0).toUpperCase() + subscriptionPlan.slice(1)} Plan</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Content -->
                                <div class="p-4">
                                    <!-- License Key Section -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold text-dark">
                                                <i class="fas fa-shield-alt text-primary me-2"></i>License Key
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex gap-2">
                                                <div class="form-control bg-light font-monospace">${licenseKey}</div>
                                                <button class="btn btn-primary" onclick="copyToClipboard('${licenseKey}')" title="Copy license key">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info Cards Row -->
                                    <div class="row mb-4">
                                        <!-- Product Info -->
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        <i class="fas fa-cube text-primary me-2"></i>Product Details
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Name</small>
                                                                <strong>${productName}</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">ID</small>
                                                                <strong>#${productId}</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Plan</small>
                                                                <span class="badge bg-primary">${subscriptionPlan.charAt(0).toUpperCase() + subscriptionPlan.slice(1)}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Version</small>
                                                                <strong>${licenseVersion}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Subscription Info -->
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        <i class="fas fa-credit-card text-success me-2"></i>Subscription
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Status</small>
                                                                <span class="badge bg-success">${subscriptionStatus === 'active' ? 'Active' : subscriptionStatus}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">License</small>
                                                                <span class="badge bg-${licenseStatus === 'active' ? 'success' : licenseStatus === 'expired' ? 'danger' : 'warning'}">${licenseStatus.charAt(0).toUpperCase() + licenseStatus.slice(1)}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Billing</small>
                                                                <strong>$${parseFloat(subscriptionAmount).toFixed(2)}/${subscriptionPlan === 'monthly' ? 'month' : 'year'}</strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <small class="text-muted d-block">Expires</small>
                                                                <strong class="${expiresAt && new Date(expiresAt) < new Date() ? 'text-danger' : ''}">
                                                                    ${expiresAt ? new Date(expiresAt).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'Never'}
                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Activation Stats -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0 fw-bold text-dark">
                                                <i class="fas fa-server text-info me-2"></i>Activation Information
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="p-3 bg-light rounded">
                                                        <div class="text-primary fs-4 fw-bold">${activationLimit}</div>
                                                        <small class="text-muted">Total Sites</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="p-3 bg-light rounded">
                                                        <div class="text-success fs-4 fw-bold">${currentActivations}</div>
                                                        <small class="text-muted">Activated</small>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="p-3 bg-light rounded">
                                                        <div class="text-info fs-4 fw-bold">${availableActivations}</div>
                                                        <small class="text-muted">Available</small>
                                                    </div>
                                                </div>
                                            </div>
                                            ${currentActivations > 0 ? `
                                            <div class="mt-3">
                                                <small class="text-muted d-block mb-2">Activated Websites</small>
                                                <div class="list-group">
                                                    ${activatedWebsites.map(website => `
                                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <i class="fas fa-globe text-muted me-2"></i>
                                                                <a href="http://${website.domain}" target="_blank" class="text-decoration-none">${website.domain}</a>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <small class="text-muted">${website.activated_at ? new Date(website.activated_at).toLocaleDateString() : 'Unknown'}</small>
                                                                <span class="badge bg-${website.status === 'active' ? 'success' : 'secondary'}">${website.status || 'Active'}</span>
                                                            </div>
                                                        </div>
                                                    `).join('')}
                                                </div>
                                            </div>
                                            ` : `
                                            <div class="alert alert-info mt-3 mb-0">
                                                <i class="fas fa-info-circle me-2"></i>
                                                No websites have been activated yet.
                                            </div>
                                            `}
                                        </div>
                                    </div>

                                    <!-- Transaction History -->
                                    <div class="row">
                                        <!-- Initial Purchase -->
                                        <div class="col-12 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        <i class="fas fa-shopping-cart text-warning me-2"></i>Initial Purchase
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div id="initialPurchaseContent">
                                                        <div class="text-center">
                                                            <div class="spinner-border text-primary mb-2" role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                            <p class="text-muted mb-0">Loading purchase details...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Renewal History -->
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header bg-light">
                                                    <h6 class="mb-0 fw-bold text-dark">
                                                        <i class="fas fa-history text-secondary me-2"></i>Renewal History
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div id="renewalHistoryContent">
                                                        <div class="text-center">
                                                            <div class="spinner-border text-primary mb-2" role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                            <p class="text-muted mb-0">Loading renewal history...</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="bg-light p-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Created: ${createdAt ? new Date(createdAt).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'N/A'}
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i>Close
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="downloadLicense('${licenseKey}', '${productName}')">
                                                <i class="fas fa-download me-1"></i>Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    } catch (templateError) {
                        console.error('Template literal error:', templateError);
                        contentDiv.innerHTML = `
                            <div class="text-center text-danger">
                                <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                <h5>Error Loading License Details</h5>
                                <p>There was an error formatting the license details. Please try again.</p>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        `;
                    }
                // Load initial purchase and renewal history
                    loadInitialPurchase(licenseId);
                    loadRenewalHistory(licenseId, license.subscription.id);
                    
                }, 500);
            } else {
                console.error('License data is incomplete:', license);
                contentDiv.innerHTML = `
                    <div class="text-center text-danger">
                        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                        <h5>License Not Found</h5>
                        <p>Unable to load license details. The license data may be incomplete.</p>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                `;
                modal.show();
            }
        } catch (error) {
            console.error('Error in showLicenseDetails:', error);
            alert('An error occurred while loading license details: ' + error.message);
        }
    });
}

function renewLicense(licenseId) {
    // Find the license data
    const license = licenseData.find(l => l.id == licenseId);
    
    console.log('renewLicense called with ID:', licenseId);
    console.log('Found license:', license);
    
    if (!license) {
        alert('License not found. Please refresh the page and try again.');
        return;
    }
    
    // Get product prices for accurate calculation
    const product = license.subscription.product;
    const monthlyPrice = parseFloat(product.price_monthly) || 0;
    const yearlyPrice = parseFloat(product.price_yearly) || (monthlyPrice * 12);
    
    console.log('Product data:', {
        name: product.name,
        monthlyPrice: monthlyPrice,
        yearlyPrice: yearlyPrice,
        currentPlan: license.subscription.plan,
        currentAmount: license.subscription.amount
    });
    
    // Set the renewal form data
    document.getElementById('renewalLicenseId').value = licenseId;
    document.getElementById('renewalSubscriptionId').value = license.subscription.id;
    document.getElementById('renewalPluginName').value = license.subscription.product.name;
    document.getElementById('renewalCurrentPlan').value = license.subscription.plan.charAt(0).toUpperCase() + license.subscription.plan.slice(1);
    
    // Set current price based on actual plan
    let currentPriceText = '';
    if (license.subscription.plan === 'monthly') {
        currentPriceText = `$${monthlyPrice.toFixed(2)}`;
    } else if (license.subscription.plan === 'yearly') {
        currentPriceText = `$${yearlyPrice.toFixed(2)}`;
    }
    document.getElementById('renewalCurrentPrice').value = currentPriceText;
    
    // Check if license is expired
    const today = new Date();
    const expiryDate = license.subscription.expires_at ? new Date(license.subscription.expires_at) : null;
    const isExpired = expiryDate ? expiryDate < today : true;
    
    let startDate;
    if (isExpired) {
        // License is expired, start from today
        startDate = today;
        console.log('License is expired, starting from today:', startDate.toISOString().split('T')[0]);
    } else {
        // License is still active, start from expiry date
        startDate = expiryDate;
        console.log('License is active, starting from expiry date:', startDate.toISOString().split('T')[0]);
    }
    
    // Set start date
    document.getElementById('renewalStartDate').value = startDate.toISOString().split('T')[0];
    
    // Show the modal first
    const renewalModal = new bootstrap.Modal(document.getElementById('renewalModal'));
    renewalModal.show();
    
    // Small delay to ensure modal is fully rendered, then set up everything
    setTimeout(() => {
        console.log('Modal shown, setting up dropdown selection...');
        console.log('License current plan:', license.subscription.plan);
        
        // Remove existing event listeners to prevent duplicates
        const periodElement = document.getElementById('renewalPeriod');
        const startDateElement = document.getElementById('renewalStartDate');
        
        if (periodElement && startDateElement) {
            // Clone elements to remove event listeners
            const newPeriodElement = periodElement.cloneNode(true);
            const newStartDateElement = startDateElement.cloneNode(true);
            
            periodElement.parentNode.replaceChild(newPeriodElement, periodElement);
            startDateElement.parentNode.replaceChild(newStartDateElement, startDateElement);
            
            // NOW set renewal period to current plan (default selection) - do this after cloning
            const renewalPeriodSelect = document.getElementById('renewalPeriod');
            console.log('Found dropdown element after cloning:', renewalPeriodSelect);
            
            if (renewalPeriodSelect) {
                console.log('Current dropdown value before setting:', renewalPeriodSelect.value);
                renewalPeriodSelect.value = license.subscription.plan;
                
                // Make sure the correct option is selected
                const options = renewalPeriodSelect.options;
                console.log('Dropdown options:', options.length);
                
                for (let i = 0; i < options.length; i++) {
                    console.log(`Option ${i}: value="${options[i].value}", text="${options[i].text}", selected=${options[i].selected}`);
                    if (options[i].value === license.subscription.plan) {
                        options[i].selected = true;
                        console.log(`Selected option ${i} with value ${options[i].value}`);
                    } else {
                        options[i].selected = false;
                    }
                }
                
                console.log('Final dropdown value:', renewalPeriodSelect.value);
                console.log('Selected option text:', renewalPeriodSelect.options[renewalPeriodSelect.selectedIndex]?.text);
            } else {
                console.log('Renewal period select element not found after cloning');
            }
            
            // Add fresh event listeners
            newPeriodElement.addEventListener('change', function() {
                updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, this.value);
                updateEndDate();
                updateDurationDisplay();
            });
            
            newStartDateElement.addEventListener('change', function() {
                updateEndDate();
                updateDurationDisplay();
            });
            
            // Initialize end date
            updateEndDate();
            
            // Calculate price based on actual product prices and current selection
            const selectedPeriod = document.getElementById('renewalPeriod').value;
            console.log('About to call updateRenewalPriceWithProductPrices with:', {
                monthlyPrice: monthlyPrice,
                yearlyPrice: yearlyPrice,
                selectedPeriod: selectedPeriod,
                currentPlan: license.subscription.plan
            });
            updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, selectedPeriod);
        } else {
            console.error('Modal elements not found');
        }
    }, 100);
}

function updateRenewalPriceWithProductPrices(monthlyPrice, yearlyPrice, currentPlan) {
    const period = document.getElementById('renewalPeriod').value;
    let newAmount = 0;
    let priceText = '';
    
    console.log('updateRenewalPriceWithProductPrices called with:', {
        monthlyPrice: monthlyPrice,
        yearlyPrice: yearlyPrice,
        currentPlan: currentPlan,
        selectedPeriod: period
    });
    
    switch(period) {
        case 'monthly':
            newAmount = monthlyPrice;
            priceText = `$${newAmount.toFixed(2)} / month`;
            break;
        case 'yearly':
            newAmount = yearlyPrice;
            priceText = `$${newAmount.toFixed(2)} / year (Save 20%)`;
            break;
    }
    
    console.log('Calculated renewal price:', {
        newAmount: newAmount,
        priceText: priceText
    });
    
    document.getElementById('renewalNewPrice').value = priceText;
    document.getElementById('renewalAmount').value = newAmount.toFixed(2);
    
    // Update payment summary
    document.getElementById('subtotalAmount').textContent = `$${newAmount.toFixed(2)}`;
    document.getElementById('totalAmount').textContent = `$${newAmount.toFixed(2)}`;
}

function updateRenewalPrice(baseAmount) {
    const period = document.getElementById('renewalPeriod').value;
    // Ensure baseAmount is a number
    const amount = parseFloat(baseAmount) || 0;
    let newAmount = amount;
    let priceText = '';
    
    // Debug logging
    console.log('updateRenewalPrice called with:', {
        baseAmount: baseAmount,
        parsedAmount: amount,
        period: period
    });
    
    switch(period) {
        case 'monthly':
            newAmount = amount;
            priceText = `$${newAmount.toFixed(2)} / month`;
            break;
        case 'yearly':
            newAmount = amount * 12 * 0.8; // 20% discount for yearly
            priceText = `$${newAmount.toFixed(2)} / year (Save 20%)`;
            break;
    }
    
    console.log('Calculated price:', {
        newAmount: newAmount,
        priceText: priceText
    });
    
    document.getElementById('renewalNewPrice').value = priceText;
    document.getElementById('renewalAmount').value = newAmount.toFixed(2);
    
    // Update payment summary
    document.getElementById('subtotalAmount').textContent = `$${newAmount.toFixed(2)}`;
    document.getElementById('totalAmount').textContent = `$${newAmount.toFixed(2)}`;
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
    }
    
    document.getElementById('renewalEndDate').value = endDate.toISOString().split('T')[0];
}

// Update duration display function
function updateDurationDisplay() {
    const startDate = document.getElementById('renewalStartDate').value;
    const endDate = document.getElementById('renewalEndDate').value;
    const renewalPeriod = document.getElementById('renewalPeriod').value;
    
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        
        // Format dates for display
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        const formattedStart = start.toLocaleDateString('en-US', options);
        const formattedEnd = end.toLocaleDateString('en-US', options);
        
        // Calculate duration
        let durationText;
        if (renewalPeriod === 'monthly') {
            durationText = `${formattedStart} to ${formattedEnd}`;
        } else {
            durationText = `${formattedStart} to ${formattedEnd}`;
        }
        
        // Update order summary if payment step is visible
        const orderDurationElement = document.getElementById('orderDuration');
        if (orderDurationElement) {
            orderDurationElement.textContent = durationText;
        }
    }
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
            // Close modal and redirect to checkout
            bootstrap.Modal.getInstance(document.getElementById('renewalModal')).hide();
            
            // Show success message and redirect
            const alertHtml = `
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.body.insertAdjacentHTML('afterbegin', alertHtml);
            
            // Redirect to checkout after 2 seconds
            setTimeout(() => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                } else {
                    window.location.reload();
                }
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

// Step navigation functions
function showPaymentStep() {
    // Validate renewal details
    const licenseId = document.getElementById('renewalLicenseId').value;
    const subscriptionId = document.getElementById('renewalSubscriptionId').value;
    const renewalPeriod = document.getElementById('renewalPeriod').value;
    const amount = document.getElementById('renewalAmount').value;
    
    if (!licenseId || !subscriptionId || !renewalPeriod || !amount) {
        alert('Please fill in all renewal details before proceeding.');
        return;
    }
    
    // Update order summary using the duration display function
    document.getElementById('orderPluginName').textContent = document.getElementById('renewalPluginName').value;
    document.getElementById('orderPlanName').textContent = renewalPeriod.charAt(0).toUpperCase() + renewalPeriod.slice(1);
    updateDurationDisplay(); // This will update the orderDuration element
    document.getElementById('orderTotal').textContent = '$' + parseFloat(amount).toFixed(2);
    
    // Show payment step
    document.getElementById('renewalStep').style.display = 'none';
    document.getElementById('paymentStep').style.display = 'block';
    document.getElementById('renewalFooter').style.display = 'none';
    document.getElementById('paymentFooter').style.display = 'block';
}

function showRenewalStep() {
    // Show renewal step
    document.getElementById('renewalStep').style.display = 'block';
    document.getElementById('paymentStep').style.display = 'none';
    document.getElementById('renewalFooter').style.display = 'block';
    document.getElementById('paymentFooter').style.display = 'none';
}

function loadInitialPurchase(licenseId) {
    const purchaseContent = document.getElementById('initialPurchaseContent');
    
    // Fetch initial purchase details from the server
    fetch(`/user/licenses/${licenseId}/initial-purchase`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayInitialPurchase(data.transaction);
            } else {
                purchaseContent.innerHTML = `
                    <div class="text-center text-muted">
                        <i class="fas fa-info-circle mb-2"></i>
                        <p>No initial purchase information available</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading initial purchase:', error);
            purchaseContent.innerHTML = `
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle mb-2"></i>
                    <p>Failed to load purchase information</p>
                </div>
            `;
        });
}

function displayInitialPurchase(transaction) {
    const purchaseContent = document.getElementById('initialPurchaseContent');
    
    if (!transaction) {
        purchaseContent.innerHTML = `
            <div class="text-center text-muted">
                <i class="fas fa-info-circle mb-2"></i>
                <p>No initial purchase information available</p>
            </div>
        `;
        return;
    }
    
    const date = new Date(transaction.created_at);
    const formattedDate = date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    
    const plan = transaction.plan || 'standard';
    const planName = plan.charAt(0).toUpperCase() + plan.slice(1);
    const planIcon = plan === 'monthly' ? 'fa-calendar-alt' : 'fa-calendar-check';
    const planColor = plan === 'monthly' ? 'primary' : 'success';
    const paymentMethod = transaction.payment_method ? (transaction.payment_method.charAt(0).toUpperCase() + transaction.payment_method.slice(1)) : 'Stripe';
    
    purchaseContent.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <div class="bg-light rounded-circle p-2">
                        <i class="fas ${planIcon} text-${planColor}"></i>
                    </div>
                </div>
                <div>
                    <h6 class="mb-1">${transaction.product_name || 'Product'}</h6>
                    <p class="text-muted mb-0">
                        <span class="badge bg-${planColor}">${planName}</span>
                        <span class="ms-2">Initial Purchase</span>
                    </p>
                </div>
            </div>
            <div class="text-end">
                <div class="fw-bold text-success">$${parseFloat(transaction.amount).toFixed(2)}</div>
                <small class="text-muted">${formattedDate}</small>
                <div class="mt-1">
                    <span class="badge bg-success">Completed</span>
                </div>
            </div>
        </div>
        ${transaction.transaction_id ? `
        <div class="mt-3 pt-3 border-top">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">Transaction ID</small>
                    <div class="font-monospace small">${transaction.transaction_id}</div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Payment Method</small>
                    <div class="small">${paymentMethod}</div>
                </div>
            </div>
        </div>
        ` : ''}
    `;
}

function loadRenewalHistory(licenseId, subscriptionId) {
    const historyContent = document.getElementById('renewalHistoryContent');
    
    // Fetch renewal history from the server
    fetch(`/user/licenses/${licenseId}/renewal-history`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayRenewalHistory(data.renewals);
            } else {
                historyContent.innerHTML = `
                    <div class="text-center text-muted">
                        <i class="fas fa-info-circle mb-2"></i>
                        <p>No renewal history available</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading renewal history:', error);
            historyContent.innerHTML = `
                <div class="text-center text-danger">
                    <i class="fas fa-exclamation-triangle mb-2"></i>
                    <p>Failed to load renewal history</p>
                </div>
            `;
        });
}

function displayRenewalHistory(renewals) {
    const historyContent = document.getElementById('renewalHistoryContent');
    
    if (!renewals || renewals.length === 0) {
        historyContent.innerHTML = `
            <div class="text-center text-muted">
                <i class="fas fa-info-circle mb-2"></i>
                <p>No renewal history available</p>
            </div>
        `;
        return;
    }
    
    const historyHtml = renewals.map(renewal => {
        const date = new Date(renewal.created_at);
        const formattedDate = date.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        const planIcon = renewal.plan === 'monthly' ? 'fa-calendar-alt' : 'fa-calendar-check';
        const planColor = renewal.plan === 'monthly' ? 'primary' : 'success';
        
        return `
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <div class="bg-light rounded-circle p-2">
                            <i class="fas fa-sync text-${planColor}"></i>
                        </div>
                    </div>
                    <div>
                        <div class="fw-bold">
                            <i class="fas ${planIcon} me-1 text-${planColor}"></i>
                            ${renewal.plan.charAt(0).toUpperCase() + renewal.plan.slice(1)} Renewal
                        </div>
                        <div class="text-muted small">
                            ${formattedDate}
                        </div>
                        ${renewal.transaction_id ? `<div class="text-muted small">Transaction: ${renewal.transaction_id}</div>` : ''}
                    </div>
                </div>
                <div class="text-end">
                    <div class="fw-bold text-success">
                        $${parseFloat(renewal.amount).toFixed(2)}
                    </div>
                    <div class="text-muted small">
                        ${renewal.renewal_type === 'extension' ? 'Extended' : 'New License'}
                    </div>
                </div>
            </div>
        `;
    }).join('');
    
    historyContent.innerHTML = historyHtml;
}

// Payment processing function
// Payment processing function
async function processPayment() {
    // Validate payment details
    const cardholderName = document.getElementById('cardholderName').value;
    
    if (!cardholderName) {
        alert('Please enter the cardholder name.');
        return;
    }
    
    // Show loading state
    const payBtn = event.target;
    const originalText = payBtn.innerHTML;
    payBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
    payBtn.disabled = true;
    
    try {
        // Create form data for backend processing
        const formData = new FormData();
        formData.append('license_id', document.getElementById('renewalLicenseId').value);
        formData.append('subscription_id', document.getElementById('renewalSubscriptionId').value);
        formData.append('renewal_period', document.getElementById('renewalPeriod').value);
        formData.append('amount', document.getElementById('renewalAmount').value);
        formData.append('start_date', document.getElementById('renewalStartDate').value);
        formData.append('end_date', document.getElementById('renewalEndDate').value);
        
        console.log('Creating Razorpay Order...');
        
        // Step 1: Create Order
        const response = await fetch('{{ route("user.subscriptions.renew.razorpay") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || 'Order creation failed');
        }

        // Step 2: Open Razorpay Checkout
        const options = {
            "key": data.key,
            "amount": data.amount,
            "currency": data.currency,
            "name": data.name,
            "description": data.description,
            "image": "https://assertivlogix.com/logo.png", // Replace with actual logo URL
            "order_id": data.order_id,
            "handler": async function (response){
                // Step 3: Verify Payment
                payBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
                
                try {
                    const verifyData = new FormData();
                    verifyData.append('razorpay_payment_id', response.razorpay_payment_id);
                    verifyData.append('razorpay_order_id', response.razorpay_order_id);
                    verifyData.append('razorpay_signature', response.razorpay_signature);
                    
                    // Add original renewal data for verification/processing
                    verifyData.append('license_id', document.getElementById('renewalLicenseId').value);
                    verifyData.append('subscription_id', document.getElementById('renewalSubscriptionId').value);
                    verifyData.append('renewal_period', document.getElementById('renewalPeriod').value);
                    verifyData.append('amount', document.getElementById('renewalAmount').value);
                    verifyData.append('start_date', document.getElementById('renewalStartDate').value);
                    verifyData.append('end_date', document.getElementById('renewalEndDate').value);

                    const verifyResponse = await fetch('{{ route("user.subscriptions.renew.verify") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: verifyData
                    });

                    const verifyResult = await verifyResponse.json();

                    if (verifyResult.success) {
                        // Show success message
                        const modalBody = document.querySelector('#renewalModal .modal-body');
                        modalBody.innerHTML = `
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                </div>
                                <h5 class="text-success mb-3">Payment Successful!</h5>
                                <p class="mb-3">${verifyResult.message}</p>
                                <div class="bg-light rounded p-3 mb-3">
                                    <small class="text-muted">Transaction ID: ${verifyResult.transaction_id || 'N/A'}</small>
                                </div>
                                <button type="button" class="btn btn-success" onclick="location.reload()">
                                    <i class="fas fa-check me-1"></i> Done
                                </button>
                            </div>
                        `;
                        
                        // Hide footer
                        document.querySelector('#renewalModal .modal-footer').style.display = 'none';
                        
                        // Auto refresh after 3 seconds
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    } else {
                        throw new Error(verifyResult.message || 'Verification failed');
                    }
                } catch (verifyError) {
                    console.error('Verification Error:', verifyError);
                    alert('Payment verification failed: ' + verifyError.message);
                    payBtn.innerHTML = originalText;
                    payBtn.disabled = false;
                }
            },
            "prefill": data.prefill,
            "notes": data.notes,
            "theme": {
                "color": "#2563eb"
            },
            "modal": {
                "ondismiss": function(){
                    payBtn.innerHTML = originalText;
                    payBtn.disabled = false;
                }
            }
        };
        
        const rzp1 = new Razorpay(options);
        rzp1.on('payment.failed', function (response){
            alert('Payment Failed: ' + response.error.description);
            payBtn.innerHTML = originalText;
            payBtn.disabled = false;
        });
        
        rzp1.open();

    } catch (error) {
        console.error('Payment error:', error);
        alert('Payment failed: ' + (error.message || 'An error occurred. Please try again.'));
        payBtn.innerHTML = originalText;
        payBtn.disabled = false;
    }
}

// Test function to verify data is available
console.log('License data loaded:', licenseData.length, 'licenses');
console.log('Modal element exists:', !!document.getElementById('licenseDetailsModal'));

// Quick Actions Functions
function downloadAllLicenses() {
    if (!licenseData || licenseData.length === 0) {
        alert('No licenses to download.');
        return;
    }
    
    const allLicenses = licenseData.map(license => ({
        license_key: license.license_key,
        product_name: license.subscription?.product?.name || 'Unknown',
        plan: license.subscription?.plan || 'unknown',
        status: license.status,
        expires_at: license.subscription?.expires_at || null,
        activation_limit: license.activation_limit,
        activations_used: license.activations_used || 0
    }));
    
    const dataStr = JSON.stringify(allLicenses, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = 'all_licenses_' + new Date().toISOString().split('T')[0] + '.json';
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    // Show success message
    showNotification('All licenses downloaded successfully!', 'success');
}

function showSupportModal() {
    // Create a simple support modal if it doesn't exist
    let supportModal = document.getElementById('supportModal');
    
    if (!supportModal) {
        supportModal = document.createElement('div');
        supportModal.id = 'supportModal';
        supportModal.className = 'modal fade';
        supportModal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-headset me-2"></i>Get Support
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                            <h5>How can we help you?</h5>
                            <p class="text-muted">Our support team is here to assist you with any questions or issues.</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-primary">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Email Support</h6>
                                        <p class="card-text small">support@moonplugins.com</p>
                                        <small class="text-muted">Response within 24 hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-comments fa-2x text-success mb-2"></i>
                                        <h6 class="card-title">Live Chat</h6>
                                        <p class="card-text small">Available 9am-5pm EST</p>
                                        <small class="text-muted">Instant response</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label">Describe your issue:</label>
                            <textarea class="form-control" rows="3" placeholder="Please describe your issue or question..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitSupportRequest()">
                            <i class="fas fa-paper-plane me-1"></i> Submit Request
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(supportModal);
    }
    
    // Show the modal
    const modal = new bootstrap.Modal(supportModal);
    modal.show();
}

function submitSupportRequest() {
    const textarea = document.querySelector('#supportModal textarea');
    const message = textarea.value.trim();
    
    if (!message) {
        alert('Please describe your issue before submitting.');
        return;
    }
    
    // Simulate sending the support request
    showNotification('Support request submitted successfully! We\'ll respond within 24 hours.', 'success');
    
    // Close modal and clear textarea
    const modal = bootstrap.Modal.getInstance(document.getElementById('supportModal'));
    modal.hide();
    textarea.value = '';
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}
</script>
@endsection
