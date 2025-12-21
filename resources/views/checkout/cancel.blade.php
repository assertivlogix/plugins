@extends('layouts.frontend')

@section('title', 'Checkout Cancelled - Moon Plugins')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <!-- Cancel Icon -->
                    <div class="mb-4">
                        <div class="cancel-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>

                    <!-- Cancel Message -->
                    <h2 class="mb-3">Checkout Cancelled</h2>
                    <p class="text-muted mb-4">
                        Your checkout process was cancelled. No charges were made to your account. 
                        You can try again anytime or contact our support team if you need assistance.
                    </p>

                    <!-- Why Cancelled -->
                    <div class="text-start mb-4">
                        <div class="alert alert-info">
                            <h6 class="alert-heading">Common Reasons for Cancellation</h6>
                            <ul class="mb-0">
                                <li>Payment information was entered incorrectly</li>
                                <li>Browser or connection issues during checkout</li>
                                <li>Decided to review the purchase details</li>
                                <li>Payment method was declined by the bank</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Continue Shopping
                        </a>
                        <a href="#" class="btn btn-outline-primary" onclick="history.back()">
                            <i class="fas fa-arrow-left me-2"></i>
                            Try Again
                        </a>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <h6 class="mb-3">Need Help Completing Your Purchase?</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-credit-card text-primary me-3 mt-1"></i>
                                <div>
                                    <h6>Payment Issues</h6>
                                    <p class="text-muted small">Check your card details, billing address, and available balance. Ensure your bank allows online transactions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-globe text-primary me-3 mt-1"></i>
                                <div>
                                    <h6>Technical Problems</h6>
                                    <p class="text-muted small">Try clearing your browser cache, using a different browser, or checking your internet connection.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-headset text-primary me-3 mt-1"></i>
                                <div>
                                    <h6>Contact Support</h6>
                                    <p class="text-muted small">Our support team is available 24/7 to help you complete your purchase successfully.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-shield-alt text-primary me-3 mt-1"></i>
                                <div>
                                    <h6>Security & Privacy</h6>
                                    <p class="text-muted small">Your payment information is encrypted and secure. We never store your card details on our servers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cancel-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    margin: 0 auto;
    animation: scaleIn 0.5s ease-out;
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
</style>
@endsection
