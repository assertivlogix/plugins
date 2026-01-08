@extends('layouts.frontend')

@section('title', 'Checkout - Moon Plugins')

@push('styles')
<style>
/* Modern Checkout Layout */
.checkout-page {
    background: linear-gradient(135deg, #034f61 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.checkout-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 1200px;
    margin: 0 auto;
}

.checkout-header {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 2rem;
    text-align: center;
}

.checkout-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 700;
}

.checkout-header .breadcrumb {
    background: none;
    padding: 0;
    margin: 1rem 0 0 0;
}

.checkout-header .breadcrumb a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}

.checkout-header .breadcrumb a:hover {
    color: white;
}

.checkout-body {
    padding: 3rem 2rem;
}

.checkout-main {
    padding-right: 2rem;
}

.checkout-sidebar {
    padding-left: 2rem;
    border-left: 1px solid #e5e7eb;
}

.order-summary-card {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: white;
    border-radius: 8px;
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
}

.product-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin-right: 1.5rem;
    flex-shrink: 0;
}

.product-details h6 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
}

.product-details p {
    margin: 0;
    color: #64748b;
    font-size: 0.9rem;
}

.product-price {
    margin-left: auto;
    text-align: right;
}

.product-price .price {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2563eb;
}

.product-price .period {
    font-size: 0.875rem;
    color: #64748b;
}

.plan-selection {
    margin: 2rem 0;
}

.plan-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-top: 1rem;
}

.plan-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.plan-card:hover {
    border-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
}

.plan-card.selected {
    border-color: #2563eb;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(29, 78, 216, 0.05));
}

.plan-card h6 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.plan-card .price {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2563eb;
    margin: 0.5rem 0;
}

.plan-card .price small {
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 400;
}

.plan-card ul {
    list-style: none;
    padding: 0;
    margin: 1rem 0 0 0;
}

.plan-card ul li {
    padding: 0.25rem 0;
    font-size: 0.9rem;
    color: #475569;
}

.plan-card ul li i {
    color: #10b981;
    margin-right: 0.5rem;
}

.payment-form {
    background: #f8fafc;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem 0;
}

.payment-form h5 {
    margin: 0 0 1.5rem 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
}

.form-label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Stripe Card Element Styling */
#card-element {
    padding: 0.75rem 1rem !important;
    border: 1px solid #d1d5db !important;
    border-radius: 8px !important;
    background: white !important;
    transition: all 0.3s ease !important;
}

#card-element:focus-within {
    border-color: #034f61  !important;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1) !important;
}

#card-errors {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.order-total {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
}

.order-total .line-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.order-total .line-item.total {
    border-top: 1px solid #e5e7eb;
    margin-top: 1rem;
    padding-top: 1rem;
    font-weight: 700;
    font-size: 1.1rem;
    color: #1e293b;
}

.checkout-button {
    width: 100%;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1.5rem;
}

.checkout-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

.checkout-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.security-notice {
    text-align: center;
    margin-top: 1rem;
    color: #64748b;
    font-size: 0.875rem;
}

.security-notice i {
    color: #10b981;
    margin-right: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .checkout-body {
        padding: 2rem 1rem;
    }
    
    .checkout-main {
        padding-right: 0;
        margin-bottom: 2rem;
    }
    
    .checkout-sidebar {
        padding-left: 0;
        border-left: none;
        border-top: 1px solid #e5e7eb;
        padding-top: 2rem;
    }
    
    .plan-options {
        grid-template-columns: 1fr;
    }
    
    .product-item {
        flex-direction: column;
        text-align: center;
    }
    
    .product-icon {
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .product-price {
        margin-left: 0;
        margin-top: 1rem;
        text-align: center;
    }
}
</style>
@endpush

@section('content')
<div class="checkout-page">
    <div class="container">
        <div class="checkout-container">
            <!-- Checkout Header -->
            <div class="checkout-header">
                <h1>Secure Checkout</h1>
                <div class="breadcrumb">
                    <a href="{{ route('products.index') }}">Plugins</a>
                    <span class="mx-2">/</span>
                    <span>Checkout</span>
                </div>
            </div>

            <!-- Checkout Body -->
            <div class="checkout-body">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-7 checkout-main">
                        <!-- Order Summary -->
                        <div class="order-summary-card">
                            <h5 class="mb-4">Order Summary</h5>
                            
                            <div class="product-item">
                                <div class="product-icon">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <div class="product-details">
                                    <h6>{{ $product->name }}</h6>
                                    <p>{{ $product->description ?? 'Premium WordPress plugin' }}</p>
                                </div>
                                <div class="product-price">
                                    <div class="price">${{ $price }}</div>
                                    <div class="period">/{{ $plan === 'monthly' ? 'month' : 'year' }}</div>
                                </div>
                            </div>

                            <!-- Plan Selection -->
                            <div class="plan-selection">
                                <h5 class="mb-3">Choose Your Plan</h5>
                                <div class="plan-options">
                                    <div class="plan-card {{ $plan === 'monthly' ? 'selected' : '' }}" onclick="selectPlan('monthly')">
                                        <h6>Monthly</h6>
                                        <div class="price">${{ $product->price_monthly }}<small>/month</small></div>
                                        <ul>
                                            <li><i class="fas fa-check"></i>Monthly billing</li>
                                            <li><i class="fas fa-check"></i>Cancel anytime</li>
                                            <li><i class="fas fa-check"></i>Full access</li>
                                        </ul>
                                    </div>
                                    <div class="plan-card {{ $plan === 'yearly' ? 'selected' : '' }}" onclick="selectPlan('yearly')">
                                        <h6>Yearly <span class="badge bg-success">Best Value</span></h6>
                                        <div class="price">${{ $product->price_yearly ?? ($product->price_monthly * 10) }}<small>/year</small></div>
                                        <ul>
                                            <li><i class="fas fa-check"></i>Save 20% annually</li>
                                            <li><i class="fas fa-check"></i>Priority support</li>
                                            <li><i class="fas fa-check"></i>Full access</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-5 checkout-sidebar">
                        <!-- Order Total -->
                        <div class="order-total">
                            <h6 class="mb-3">Order Total</h6>
                            
                            <div class="line-item">
                                <span>Subtotal</span>
                                <span>${{ $price }}</span>
                            </div>
                            
                            <div class="line-item">
                                <span>Tax</span>
                                <span>$0.00</span>
                            </div>
                            
                            @if($discount)
                            <div class="line-item text-success">
                                <span>Discount</span>
                                <span>-${{ number_format($discount, 2) }}</span>
                            </div>
                            @endif
                            
                            <div class="line-item total">
                                <span>Total</span>
                                <span>${{ $price }}</span>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        <form id="checkoutForm" class="payment-form">
                            <h5>Payment Information</h5>
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="cardholderName" class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" id="cardholderName" value="{{ auth()->user()->name }}" required>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        You will be redirected to Razorpay to complete your payment securely.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hidden fields for processing -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="plan" value="{{ $plan }}">

                        </form>

                        <!-- Checkout Button -->
                        <button type="submit" form="checkoutForm" class="checkout-button" id="submitBtn">
                            <i class="fas fa-lock me-2"></i>
                            Complete Purchase - ${{ $price }}
                        </button>

                        <!-- Security Notice -->
                        <div class="security-notice">
                            <i class="fas fa-shield-alt"></i>
                            Your payment information is encrypted and secure
                        </div>

                        <!-- Trust Badges -->
                        <div class="text-center mt-4">
                            <div class="d-flex justify-content-center align-items-center gap-3">
                                <i class="fab fa-cc-visa fa-2x text-muted"></i>
                                <i class="fab fa-cc-mastercard fa-2x text-muted"></i>
                                <i class="fab fa-cc-amex fa-2x text-muted"></i>
                                <i class="fab fa-cc-discover fa-2x text-muted"></i>
                            </div>
                            <p class="text-muted small mt-2 mb-0">Secured by 256-bit SSL encryption</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <small>Instant license delivery</small>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <small>Priority customer support</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <small>Trusted by 5M+ websites</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    
    // Handle form submission
    document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        try {
            // Create form data for backend processing
            const formData = new FormData();
            formData.append('product_id', '{{ $product->id }}');
            formData.append('plan', '{{ $plan }}');
            
            console.log('Creating Razorpay Order...');
            
            // Step 1: Create Order
            const response = await fetch('{{ route("checkout.process") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                "image": "https://assertivlogix.com/logo.png", // Replace with actual logo URL if available
                "order_id": data.order_id,
                "handler": async function (response){
                    // Step 3: Verify Payment
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
                    
                    try {
                        const verifyData = new FormData();
                        verifyData.append('razorpay_payment_id', response.razorpay_payment_id);
                        verifyData.append('razorpay_order_id', response.razorpay_order_id);
                        verifyData.append('razorpay_signature', response.razorpay_signature);
                        verifyData.append('product_id', '{{ $product->id }}');
                        verifyData.append('plan', '{{ $plan }}');

                        const verifyResponse = await fetch('{{ route("checkout.verify") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                            body: verifyData
                        });

                        const verifyResult = await verifyResponse.json();

                        if (verifyResult.success) {
                            window.location.href = verifyResult.redirect;
                        } else {
                            throw new Error(verifyResult.message || 'Verification failed');
                        }
                    } catch (verifyError) {
                        console.error('Verification Error:', verifyError);
                        alert('Payment verification failed: ' + verifyError.message);
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                },
                "prefill": data.prefill,
                "notes": data.notes,
                "theme": {
                    "color": "#2563eb"
                },
                "modal": {
                    "ondismiss": function(){
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                }
            };
            
            const rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert('Payment Failed: ' + response.error.description);
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
            
            rzp1.open();

        } catch (error) {
            console.error('Payment error:', error);
            alert('Payment failed: ' + (error.message || 'An error occurred. Please try again.'));
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    // Plan selection function
    window.selectPlan = function(plan) {
        // Update URL with new plan
        const url = new URL(window.location);
        url.searchParams.set('plan', plan);
        window.location.href = url.toString();
    };
});
</script>
@endpush
@endsection
