@extends('layouts.frontend')

@section('title', 'Payment Successful - Moon Plugins')

@push('styles')
<style>
.success-page {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.success-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 900px;
    margin: 0 auto;
}

.success-header {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 3rem 2rem;
    text-align: center;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem auto;
    animation: scaleIn 0.5s ease-out;
}

.success-header h1 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
}

.success-header p {
    margin: 1rem 0 0 0;
    font-size: 1.1rem;
    opacity: 0.9;
}

.success-body {
    padding: 3rem 2rem;
}

.payment-details {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.payment-details h6 {
    color: #334155;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.payment-details h6 i {
    margin-right: 0.5rem;
    color: #2563eb;
}

.payment-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.payment-row:last-child {
    border-bottom: none;
    padding-top: 1rem;
    font-weight: 600;
    font-size: 1.1rem;
    color: #059669;
}

.payment-label {
    color: #64748b;
    font-weight: 500;
}

.payment-value {
    color: #1e293b;
    font-weight: 600;
}

.license-card {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    border: 1px solid #bae6fd;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.license-key {
    background: white;
    border: 2px dashed #0ea5e9;
    border-radius: 8px;
    padding: 1rem;
    font-family: 'Courier New', monospace;
    font-size: 1.2rem;
    font-weight: 600;
    color: #0369a1;
    text-align: center;
    margin: 1rem 0;
    position: relative;
}

.copy-btn {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: #0ea5e9;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.copy-btn:hover {
    background: #0284c7;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.product-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.product-details h6 {
    margin: 0;
    color: #1e293b;
    font-weight: 600;
}

.product-details p {
    margin: 0.25rem 0 0 0;
    color: #64748b;
    font-size: 0.9rem;
}

.next-steps {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.next-steps h6 {
    color: #059669;
    font-weight: 600;
    margin-bottom: 1rem;
}

.next-steps ul {
    margin: 0;
    padding-left: 1.5rem;
}

.next-steps li {
    margin-bottom: 0.5rem;
    color: #374151;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

.btn-outline-primary {
    border: 2px solid #2563eb;
    color: #2563eb;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #2563eb;
    color: white;
    transform: translateY(-2px);
}

.help-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    margin-top: 2rem;
}

.help-item {
    text-align: center;
    padding: 1.5rem;
}

.help-item i {
    color: #2563eb;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.help-item h6 {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.help-item p {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .success-header {
        padding: 2rem 1rem;
    }
    
    .success-body {
        padding: 2rem 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn-primary, .btn-outline-primary {
        width: 100%;
    }
    
    .payment-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .license-key {
        font-size: 1rem;
        padding: 0.75rem;
    }
    
    .copy-btn {
        position: static;
        transform: none;
        margin-top: 0.5rem;
        width: 100%;
    }
}
</style>
@endpush

@section('content')
<div class="success-page">
    <div class="container">
        <div class="success-container">
            <!-- Success Header -->
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h1>Payment Successful!</h1>
                <p>Thank you for your purchase! Your subscription is now active.</p>
            </div>

            <!-- Success Body -->
            <div class="success-body">
                @if($unauthenticated ?? false)
                    <!-- Unauthenticated User Message -->
                    <div class="payment-details">
                        <h6><i class="fas fa-user-clock"></i>Authentication Required</h6>
                        <p class="text-muted">
                            Your payment was processed successfully! However, you need to log in to view your subscription details and license key.
                        </p>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Next Steps:</strong> Please log in to your account to access your purchase details, license key, and manage your subscription.
                        </div>
                        
                        <div class="action-buttons mt-3">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Log In to Your Account
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus me-2"></i>
                                Create Account
                            </a>
                        </div>
                    </div>
                @elseif($subscription && $product && $license)
                    <!-- Product Information -->
                    <div class="payment-details">
                        <h6><i class="fas fa-cube"></i>Product Information</h6>
                        <div class="product-info">
                            <div class="product-icon">
                                <i class="fas fa-cube"></i>
                            </div>
                            <div class="product-details">
                                <h6>{{ $product->name }}</h6>
                                <p>{{ $product->description ?? 'Premium WordPress plugin' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="payment-details">
                        <h6><i class="fas fa-receipt"></i>Payment Details</h6>
                        <div class="payment-row">
                            <span class="payment-label">Subscription Plan</span>
                            <span class="payment-value">{{ ucfirst($subscription->plan) }}</span>
                        </div>
                        <div class="payment-row">
                            <span class="payment-label">Amount Paid</span>
                            <span class="payment-value">${{ number_format($subscription->amount, 2) }}</span>
                        </div>
                        <div class="payment-row">
                            <span class="payment-label">Payment Date</span>
                            <span class="payment-value">{{ $subscription->created_at->format('M j, Y - g:i A') }}</span>
                        </div>
                        <div class="payment-row">
                            <span class="payment-label">Subscription Status</span>
                            <span class="payment-value">
                                <span class="badge bg-success">{{ ucfirst($subscription->status) }}</span>
                            </span>
                        </div>
                        <div class="payment-row">
                            <span class="payment-label">Next Billing</span>
                            <span class="payment-value">{{ $subscription->expires_at->format('M j, Y') }}</span>
                        </div>
                    </div>

                    <!-- License Information -->
                    <div class="license-card">
                        <h6><i class="fas fa-key me-2"></i>Your License Key</h6>
                        <div class="license-key">
                            {{ $license->license_key }}
                            <button class="copy-btn" onclick="copyLicenseKey()">
                                <i class="fas fa-copy me-1"></i>Copy
                            </button>
                        </div>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Keep this license key safe. You'll need it to activate your plugin.
                        </p>
                    </div>
                @else
                    <!-- Generic Success Message (no subscription data) -->
                    <div class="payment-details">
                        <h6><i class="fas fa-check-circle"></i>Order Confirmed</h6>
                        <p class="text-muted">
                            Your payment has been processed successfully. Your subscription details and license key will be available in your dashboard.
                        </p>
                        
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Next Steps:</strong> Please visit your dashboard to view your subscription details and license information.
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="payment-details">
                        <h6><i class="fas fa-rocket"></i>Quick Actions</h6>
                        <div class="action-buttons">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Go to Dashboard
                            </a>
                            <a href="{{ route('licenses') }}" class="btn btn-outline-primary">
                                <i class="fas fa-key me-2"></i>
                                View Licenses
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Next Steps -->
                <div class="next-steps">
                    <h6><i class="fas fa-rocket me-2"></i>What's Next?</h6>
                    <ul>
                        <li>Your license key has been generated and is ready to use</li>
                        <li>You can manage your licenses from your dashboard</li>
                        <li>Download the plugin and install it on your WordPress site</li>
                        <li>Activate your license using the provided key</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Go to Dashboard
                    </a>
                    <a href="{{ route('licenses') }}" class="btn btn-outline-primary">
                        <i class="fas fa-key me-2"></i>
                        View Licenses
                    </a>
                </div>

                <!-- Help Section -->
                <div class="help-section">
                    <h6 class="text-center mb-4">Need Help?</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="help-item">
                                <i class="fas fa-book"></i>
                                <h6>Documentation</h6>
                                <p>Get started with our comprehensive guides</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Docs</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="help-item">
                                <i class="fas fa-headset"></i>
                                <h6>Support</h6>
                                <p>Our team is here to help you 24/7</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Contact Support</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="help-item">
                                <i class="fas fa-users"></i>
                                <h6>Community</h6>
                                <p>Join our community of WordPress experts</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyLicenseKey() {
    const licenseKey = '{{ $license->license_key ?? "" }}';
    if (licenseKey) {
        navigator.clipboard.writeText(licenseKey).then(function() {
            const btn = document.querySelector('.copy-btn');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            btn.style.background = '#059669';
            
            setTimeout(function() {
                btn.innerHTML = originalHTML;
                btn.style.background = '#0ea5e9';
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy license key: ', err);
            alert('Failed to copy license key. Please copy it manually.');
        });
    }
}
</script>
@endsection
