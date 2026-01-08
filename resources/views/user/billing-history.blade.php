@extends('layouts.frontend')

@section('title', 'Billing History')

@section('content')
<style>
.billing-history-container {
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

.page-header h1 {
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.page-header p {
    color: #6c757d;
    font-size: 16px;
    margin: 0;
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

/* Quick Actions Sidebar Styles */
.quick-actions-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 20px;
}

.quick-actions-header {
    background: linear-gradient(135deg, #034f61 0%, #764ba2 100%);
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

/* Billing Stats Card */
.billing-stats-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.billing-stats-header {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 20px;
    text-align: center;
}

.billing-stats-header h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.billing-stats-body {
    padding: 20px;
}

.billing-stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.billing-stat-item:last-child {
    border-bottom: none;
}

.billing-stat-label {
    color: #6c757d;
    font-size: 14px;
}

.billing-stat-value {
    font-weight: 600;
    font-size: 16px;
    color: #2c3e50;
}

.billing-stat-value.text-success {
    color: #28a745;
}

.billing-stat-value.text-warning {
    color: #ffc107;
}

.billing-stat-value.text-danger {
    color: #dc3545;
}

.billing-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.stat-card .stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px auto;
    font-size: 24px;
    color: white;
}

.stat-card.total .stat-icon {
    background: linear-gradient(135deg, #007bff, #0056b3);
}

.stat-card.year .stat-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.stat-card.month .stat-icon {
    background: linear-gradient(135deg, #ffc107, #ff8c00);
}

.stat-card.subscriptions .stat-icon {
    background: linear-gradient(135deg, #17a2b8, #007bff);
}

.stat-card.renewals .stat-icon {
    background: linear-gradient(135deg, #6f42c1, #e83e8c);
}

.stat-card.purchases .stat-icon {
    background: linear-gradient(135deg, #fd7e14, #ffc107);
}

.stat-card .stat-value {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 5px;
}

.stat-card .stat-label {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
}

.billing-history-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2 {
    color: #2c3e50;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

.card-header .transaction-count {
    background: #007bff;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.card-body {
    padding: 0;
}

/* Transaction Cards Layout */
.transactions-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 20px;
}

.transaction-card {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.transaction-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #dee2e6;
    transition: all 0.3s ease;
}

.transaction-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: translateY(-2px);
    border-color: #007bff;
}

.transaction-card:hover::before {
    background: #007bff;
}

.transaction-card.completed::before {
    background: #28a745;
}

.transaction-card.failed::before {
    background: #dc3545;
}

.transaction-card.pending::before {
    background: #ffc107;
}

.transaction-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f3f4;
}

.transaction-header-left {
    flex: 1;
}

.transaction-header-right {
    text-align: right;
}

.transaction-title {
    font-size: 16px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 6px;
}

.transaction-id {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    color: #6c757d;
    background: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    display: inline-block;
    margin-top: 4px;
}

.transaction-amount-large {
    font-size: 24px;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 4px;
}

.transaction-status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.transaction-body {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 16px;
}

.transaction-info-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.transaction-info-item i {
    width: 20px;
    color: #6c757d;
    font-size: 14px;
}

.transaction-info-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 500;
    margin-right: 4px;
}

.transaction-info-value {
    font-size: 14px;
    color: #2c3e50;
    font-weight: 500;
}

.transaction-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.transaction-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid #f1f3f4;
    margin-top: 16px;
}

.transaction-date {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6c757d;
    font-size: 13px;
}

.transaction-actions-new {
    display: flex;
    gap: 8px;
}

.btn-transaction-action {
    padding: 8px 16px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    color: #6c757d;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-transaction-action:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
    text-decoration: none;
}

.btn-transaction-action i {
    font-size: 12px;
}

/* Legacy table styles for backward compatibility */
.billing-table {
    width: 100%;
    border-collapse: collapse;
    display: none; /* Hide table, use cards instead */
}

.billing-table th {
    background: #f8f9fa;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
    border-bottom: 1px solid #dee2e6;
}

.billing-table td {
    padding: 20px 15px;
    border-bottom: 1px solid #f1f3f4;
    vertical-align: middle;
}

.billing-table tr:hover {
    background: #f8f9fa;
}

.transaction-id {
    font-family: monospace;
    color: #007bff;
    font-weight: 500;
}

.transaction-desc {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 3px;
}

.transaction-plan {
    color: #6c757d;
    font-size: 13px;
}

.transaction-amount {
    font-weight: 600;
    color: #28a745;
    font-size: 16px;
}

.transaction-status {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.transaction-status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.transaction-status.active,
.transaction-status.completed {
    background: #d4edda;
    color: #155724;
}

.transaction-status.expired {
    background: #f8d7da;
    color: #721c24;
}

.transaction-status.cancelled {
    background: #f8f9fa;
    color: #6c757d;
}

.transaction-status.failed {
    background: #f8d7da;
    color: #721c24;
}

.transaction-status.pending {
    background: #fff3cd;
    color: #856404;
}

.transaction-type {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.transaction-type.purchase {
    background: #fff3cd;
    color: #856404;
}

.transaction-type.renewal {
    background: #d1ecf1;
    color: #0c5460;
}

.transaction-type.refund {
    background: #f8d7da;
    color: #721c24;
}

.transaction-type.failed {
    background: #f8d7da;
    color: #721c24;
}

.transaction-type.pending {
    background: #fff3cd;
    color: #856404;
}

.transaction-details {
    font-size: 12px;
    color: #6c757d;
    margin-top: 3px;
}

.transaction-actions {
    display: flex;
    gap: 8px;
}

.btn-action {
    padding: 6px 12px;
    border: 1px solid #dee2e6;
    background: white;
    border-radius: 6px;
    color: #6c757d;
    text-decoration: none;
    font-size: 12px;
    transition: all 0.2s ease;
}

.btn-action:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-state i {
    font-size: 48px;
    margin-bottom: 20px;
    color: #dee2e6;
}

.empty-state h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #2c3e50;
}

.empty-state p {
    font-size: 14px;
    margin: 0;
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 768px) {
    .content-wrapper {
        flex-direction: column;
        gap: 20px;
    }
    
    .sidebar {
        width: 100%;
    }
    
    .billing-stats-grid {
        grid-template-columns: 1fr;
    }
    
    .transaction-card {
        padding: 16px;
    }
    
    .transaction-header {
        flex-direction: column;
        gap: 12px;
    }
    
    .transaction-header-right {
        text-align: left;
        width: 100%;
    }
    
    .transaction-body {
        grid-template-columns: 1fr;
    }
    
    .transaction-footer {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }
    
    .transaction-actions-new {
        width: 100%;
        flex-direction: column;
    }
    
    .btn-transaction-action {
        width: 100%;
        justify-content: center;
    }
    
    .billing-table {
        font-size: 14px;
    }
    
    .billing-table th,
    .billing-table td {
        padding: 12px 10px;
    }
    
    .transaction-actions {
        flex-direction: column;
    }
}
</style>

<div class="billing-history-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Billing History</h1>
        <p>View and manage your subscription payments and transactions</p>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Billing Statistics -->
            <div class="billing-stats-grid">
                <div class="stat-card total">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-value">${{ number_format($totalSpent, 2) }}</div>
                    <div class="stat-label">Total Spent</div>
                </div>
                
                <div class="stat-card year">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-value">${{ number_format($thisYearSpent, 2) }}</div>
                    <div class="stat-label">This Year</div>
                </div>
                
                <div class="stat-card month">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-value">${{ number_format($thisMonthSpent, 2) }}</div>
                    <div class="stat-label">This Month</div>
                </div>
                
                <div class="stat-card subscriptions">
                    <div class="stat-icon">
                        <i class="fas fa-repeat"></i>
                    </div>
                    <div class="stat-value">{{ $activeSubscriptions }}</div>
                    <div class="stat-label">Active Subscriptions</div>
                </div>
                
                <div class="stat-card renewals">
                    <div class="stat-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="stat-value">{{ $renewalCount ?? 0 }}</div>
                    <div class="stat-label">Total Renewals</div>
                </div>
                
                <div class="stat-card purchases">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-value">{{ $purchaseCount ?? 0 }}</div>
                    <div class="stat-label">Total Purchases</div>
                </div>
            </div>

            <!-- Billing History Table -->
            <div class="billing-history-card">
                <div class="card-header">
                    <h2>Transaction History</h2>
                    <span class="transaction-count">{{ $totalTransactions }} transactions</span>
                </div>
                
                <div class="card-body">
                    @if($billingHistory->count() > 0)
                        <div class="transactions-list">
                            @foreach($billingHistory as $transaction)
                            <div class="transaction-card {{ $transaction['status'] }}">
                                <div class="transaction-header">
                                    <div class="transaction-header-left">
                                        <div class="transaction-title">{{ $transaction['description'] }}</div>
                                        <div class="transaction-id">
                                            <i class="fas fa-hashtag me-1"></i>{{ $transaction['transaction_id'] }}
                                        </div>
                                    </div>
                                    <div class="transaction-header-right">
                                        <div class="transaction-amount-large">${{ number_format($transaction['amount'], 2) }}</div>
                                        <span class="transaction-status-badge transaction-status {{ $transaction['status'] }}">
                                            {{ ucfirst($transaction['status']) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="transaction-body">
                                    <div class="transaction-info-item">
                                        <i class="fas fa-tag"></i>
                                        <span class="transaction-info-label">Type:</span>
                                        <span class="transaction-type-badge transaction-type {{ $transaction['type'] }}">
                                            {{ ucfirst($transaction['type']) }}
                                        </span>
                                    </div>
                                    
                                    <div class="transaction-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span class="transaction-info-label">Plan:</span>
                                        <span class="transaction-info-value">{{ ucfirst($transaction['plan']) }} Plan</span>
                                    </div>
                                    
                                    @if(isset($transaction['metadata']['license_key']))
                                    <div class="transaction-info-item">
                                        <i class="fas fa-key"></i>
                                        <span class="transaction-info-label">License:</span>
                                        <span class="transaction-info-value" style="font-family: monospace; font-size: 12px;">
                                            {{ Str::limit($transaction['metadata']['license_key'], 25, '...') }}
                                        </span>
                                    </div>
                                    @endif
                                    
                                    @if(isset($transaction['metadata']['period_start']) && isset($transaction['metadata']['period_end']))
                                    <div class="transaction-info-item">
                                        <i class="fas fa-calendar-check"></i>
                                        <span class="transaction-info-label">Period:</span>
                                        <span class="transaction-info-value">
                                            {{ $transaction['metadata']['period_start'] }} - {{ $transaction['metadata']['period_end'] }}
                                        </span>
                                    </div>
                                    @endif
                                    
                                    @if(isset($transaction['metadata']['discount_amount']) && $transaction['metadata']['discount_amount'] > 0)
                                    <div class="transaction-info-item">
                                        <i class="fas fa-tag text-success"></i>
                                        <span class="transaction-info-label">Discount:</span>
                                        <span class="transaction-info-value text-success">
                                            ${{ number_format($transaction['metadata']['discount_amount'], 2) }}
                                            @if(isset($transaction['metadata']['discount_code']))
                                                ({{ $transaction['metadata']['discount_code'] }})
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    
                                    @if($transaction['status'] === 'failed' && isset($transaction['metadata']['failure_reason']))
                                    <div class="transaction-info-item" style="grid-column: 1 / -1;">
                                        <i class="fas fa-exclamation-triangle text-danger"></i>
                                        <span class="transaction-info-value text-danger">
                                            {{ $transaction['metadata']['failure_reason'] }}
                                        </span>
                                    </div>
                                    @endif
                                    
                                    @if($transaction['status'] === 'pending')
                                    <div class="transaction-info-item" style="grid-column: 1 / -1;">
                                        <i class="fas fa-clock text-warning"></i>
                                        <span class="transaction-info-value text-warning">
                                            Awaiting payment confirmation
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="transaction-footer">
                                    <div class="transaction-date">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $transaction['date']->format('M d, Y') }} at {{ $transaction['date']->format('h:i A') }}</span>
                                    </div>
                                    <div class="transaction-actions-new">
                                        <a href="#" onclick="viewInvoice('{{ $transaction['invoice_url'] }}', '{{ $transaction['transaction_id'] }}'); return false;" class="btn-transaction-action">
                                            <i class="fas fa-file-invoice"></i>
                                            <span>Invoice</span>
                                        </a>
                                        <a href="#" onclick="viewReceipt('{{ $transaction['receipt_url'] }}', '{{ $transaction['transaction_id'] }}'); return false;" class="btn-transaction-action">
                                            <i class="fas fa-receipt"></i>
                                            <span>Receipt</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-receipt"></i>
                            <h3>No Billing History</h3>
                            <p>You haven't made any purchases yet. Your billing history will appear here once you make your first purchase.</p>
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
                    <p>Manage your billing efficiently</p>
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
                    
                    <a href="{{ route('user.licenses') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>My Licenses</h6>
                            <p>View and manage licenses</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="downloadBillingHistory()" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Download History</h6>
                            <p>Export billing records</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('user.profile') }}" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Account Settings</h6>
                            <p>Update payment methods</p>
                        </div>
                    </a>
                    
                    <a href="#" onclick="showBillingSupportModal()" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Billing Support</h6>
                            <p>Get help with payments</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Billing Stats Card -->
            <div class="billing-stats-card">
                <div class="billing-stats-header">
                    <h5><i class="fas fa-chart-bar me-2"></i>BILLING SUMMARY</h5>
                </div>
                <div class="billing-stats-body">
                    <div class="billing-stat-item">
                        <span class="billing-stat-label">Total Spent</span>
                        <span class="billing-stat-value text-success">${{ number_format($totalSpent, 2) }}</span>
                    </div>
                    <div class="billing-stat-item">
                        <span class="billing-stat-label">This Month</span>
                        <span class="billing-stat-value">${{ number_format($thisMonthSpent, 2) }}</span>
                    </div>
                    <div class="billing-stat-item">
                        <span class="billing-stat-label">Active Subscriptions</span>
                        <span class="billing-stat-value">{{ $activeSubscriptions }}</span>
                    </div>
                    <div class="billing-stat-item">
                        <span class="billing-stat-label">Total Transactions</span>
                        <span class="billing-stat-value">{{ $totalTransactions }}</span>
                    </div>
                    <div class="billing-stat-item">
                        <span class="billing-stat-label">Failed Payments</span>
                        <span class="billing-stat-value text-danger">
                            {{ $billingHistory->where('status', 'failed')->count() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Invoice Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" style="height: 600px;">
                <iframe id="invoiceFrame" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="printInvoice()">
                    <i class="fas fa-print me-1"></i> Print
                </button>
                <button type="button" class="btn btn-primary" onclick="downloadInvoicePdf()">
                    <i class="fas fa-download me-1"></i> Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Receipt Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0" style="height: 600px;">
                <iframe id="receiptFrame" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="printReceipt()">
                    <i class="fas fa-print me-1"></i> Print
                </button>
                <button type="button" class="btn btn-primary" onclick="downloadReceiptPdf()">
                    <i class="fas fa-download me-1"></i> Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Invoice Functions
function viewInvoice(url, transactionId) {
    const modal = new bootstrap.Modal(document.getElementById('invoiceModal'));
    const frame = document.getElementById('invoiceFrame');
    frame.src = url;
    frame.dataset.transactionId = transactionId;
    modal.show();
}

function printInvoice() {
    const frame = document.getElementById('invoiceFrame');
    frame.contentWindow.print();
}

async function downloadInvoicePdf() {
    const frame = document.getElementById('invoiceFrame');
    const url = frame.src;
    
    // Add download parameter
    const separator = url.includes('?') ? '&' : '?';
    const downloadUrl = url + separator + 'download=true&t=' + new Date().getTime();
    
    // Create a new window for PDF generation
    const newWindow = window.open(downloadUrl, '_blank');
    
    // Close the modal after opening download window
    setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('invoiceModal'));
        if (modal) {
            modal.hide();
        }
    }, 500);
}

// Receipt Functions
function viewReceipt(url, transactionId) {
    const modal = new bootstrap.Modal(document.getElementById('receiptModal'));
    const frame = document.getElementById('receiptFrame');
    frame.src = url;
    frame.dataset.transactionId = transactionId;
    modal.show();
}

function printReceipt() {
    const frame = document.getElementById('receiptFrame');
    frame.contentWindow.print();
}

async function downloadReceiptPdf() {
    const frame = document.getElementById('receiptFrame');
    const url = frame.src;
    
    // Add download parameter
    const separator = url.includes('?') ? '&' : '?';
    const downloadUrl = url + separator + 'download=true&t=' + new Date().getTime();
    
    // Create a new window for PDF generation
    const newWindow = window.open(downloadUrl, '_blank');
    
    // Close the modal after opening download window
    setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('receiptModal'));
        if (modal) {
            modal.hide();
        }
    }, 500);
}

// Quick Actions Functions for Billing History
function downloadBillingHistory() {
    const billingData = @json($billingHistory);
    
    if (!billingData || billingData.length === 0) {
        alert('No billing history to download.');
        return;
    }
    
    const exportData = billingData.map(transaction => ({
        transaction_id: transaction.transaction_id,
        description: transaction.description,
        type: transaction.type,
        plan: transaction.plan,
        amount: transaction.amount,
        status: transaction.status,
        date: transaction.date,
        invoice_url: transaction.invoice_url,
        receipt_url: transaction.receipt_url,
        metadata: transaction.metadata
    }));
    
    const dataStr = JSON.stringify(exportData, null, 2);
    const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
    
    const exportFileDefaultName = 'billing_history_' + new Date().toISOString().split('T')[0] + '.json';
    
    const linkElement = document.createElement('a');
    linkElement.setAttribute('href', dataUri);
    linkElement.setAttribute('download', exportFileDefaultName);
    linkElement.click();
    
    showNotification('Billing history downloaded successfully!', 'success');
}

function showBillingSupportModal() {
    // Create a billing-specific support modal
    let supportModal = document.getElementById('billingSupportModal');
    
    if (!supportModal) {
        supportModal = document.createElement('div');
        supportModal.id = 'billingSupportModal';
        supportModal.className = 'modal fade';
        supportModal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-credit-card me-2"></i>Billing Support
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-credit-card fa-3x text-primary mb-3"></i>
                            <h5>Having billing issues?</h5>
                            <p class="text-muted">Our billing support team is here to help with payment and subscription issues.</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-primary">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                                        <h6 class="card-title">Email Support</h6>
                                        <p class="card-text small">salse@assertivlogix.com</p>
                                        <small class="text-muted">Response within 24 hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-phone fa-2x text-success mb-2"></i>
                                        <h6 class="card-title">Phone Support</h6>
                                        <p class="card-text small">+91 8128128981</p>
                                        <small class="text-muted">Mon-Fri 9am-5pm EST</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label">Describe your billing issue:</label>
                            <textarea class="form-control" rows="3" placeholder="Please describe your billing issue or question..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitBillingSupportRequest()">
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

function submitBillingSupportRequest() {
    const textarea = document.querySelector('#billingSupportModal textarea');
    const message = textarea.value.trim();
    
    if (!message) {
        alert('Please describe your billing issue before submitting.');
        return;
    }
    
    // Simulate sending the support request
    showNotification('Billing support request submitted successfully! We\'ll respond within 24 hours.', 'success');
    
    // Close modal and clear textarea
    const modal = bootstrap.Modal.getInstance(document.getElementById('billingSupportModal'));
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
