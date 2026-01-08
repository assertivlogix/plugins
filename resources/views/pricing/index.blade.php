@extends('layouts.frontend')

@section('title', 'Pricing - Assertivlogix')
@section('meta_title', 'WordPress Plugin Pricing Plans - Affordable Premium Plugins | Assertivlogix')
@section('meta_description', 'Choose the perfect WordPress plugin plan for your needs. Flexible monthly and yearly pricing for security, SEO, backup, and performance plugins. Start from $19.99/month.')
@section('meta_keywords', 'WordPress plugin pricing, premium plugin prices, WordPress plugin plans, affordable WordPress plugins, plugin subscription')
@section('canonical_url', route('pricing'))
@section('og_type', 'website')
@section('og_image', asset('images/og-pricing.jpg'))

@section('content')
<div class="pricing-header py-5 text-center text-white text-center" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.05) 1px, transparent 0); background-size: 20px 20px;"></div>
    <div class="container position-relative z-1">
        <h1 class="display-3 fw-bolder mb-3" style="letter-spacing: -1px;">Choose Your Plan</h1>
        <p class="lead opacity-75 mb-5 fs-4">Powerful plugins to secure, optimize, and grow your WordPress site.</p>
        
        <div class="pricing-toggle d-inline-flex bg-white bg-opacity-10 rounded-pill p-1 border border-white border-opacity-10 backdrop-blur">
            <button class="btn btn-toggle active text-white px-5 py-2 rounded-pill fw-bold" id="monthlyBtn">Monthly</button>
            <button class="btn btn-toggle text-white px-5 py-2 rounded-pill fw-bold" id="yearlyBtn">
                Yearly <span class="badge bg-warning text-dark ms-2 rounded-pill">Save 20%</span>
            </button>
        </div>
    </div>
</div>

<div class="pricing-content py-5 bg-light">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($products as $product)
            @php
                // Determine color based on category (reusing logic or simplified)
                $colors = [
                    'security' => 'border-top-purple text-purple',
                    'seo' => 'border-top-green text-green',
                    'backup' => 'border-top-orange text-orange',
                    'performance' => 'border-top-red text-red',
                    'analytics' => 'border-top-blue text-blue',
                ];
                $slug = $product->slug;
                $colorClass = 'border-top-primary';
                foreach($colors as $key => $val) {
                    if(str_contains($slug, $key)) {
                        $colorClass = $val;
                        break;
                    }
                }
            @endphp
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-lg pricing-card {{ $colorClass }} position-relative overflow-hidden">
                    @if(str_contains($product->slug, 'security'))
                    <div class="position-absolute top-0 end-0 bg-warning text-dark fw-bold px-3 py-1 rounded-bottom-start shadow-sm" style="font-size: 0.8rem;">BEST SELLER</div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="text-center mb-4">
                            <div class="icon-wrapper mb-3 mx-auto text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: currentColor; opacity: 0.9;">
                                <i class="fas fa-cube fa-xl"></i>
                            </div>
                            <h3 class="h4 fw-bold mb-1 text-dark">{{ $product->name }}</h3>
                            <p class="text-muted small mb-3">{{ $product->short_description }}</p>
                            
                            <div class="price-wrapper mb-3">
                                <span class="display-4 fw-bolder price-monthly text-dark">${{ number_format($product->price_monthly, 0) }}</span>
                                <span class="display-4 fw-bolder price-yearly text-dark" style="display: none;">${{ number_format($product->price_yearly, 0) }}</span>
                                <span class="text-muted fs-6 fw-medium">
                                    <span class="period-monthly">/mo</span>
                                    <span class="period-yearly" style="display: none;">/yr</span>
                                </span>
                            </div>
                            <div class="text-success small fw-bold mb-2 saving-badge" style="display: none; opacity: 0;">Save ${{ number_format(($product->price_monthly * 12) - $product->price_yearly, 0) }} per year</div>
                        </div>
                        
                        <div class="pricing-divider mb-4 mx-auto" style="width: 50px; height: 2px; background: #e2e8f0;"></div>

                        <ul class="list-unstyled mb-4 flex-grow-1 px-2">
                             <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                <span class="text-secondary"><strong>Unlimited</strong> Sites License</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                <span class="text-secondary">1 Year Updates & Support</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                <span class="text-secondary"><strong>Premium</strong> 24/7 Support</span>
                            </li>
                             <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                <span class="text-secondary">30-Day Money Back Guarantee</span>
                            </li>
                        </ul>
                        
                        <div class="text-center mt-auto">
                            <a href="{{ route('checkout.create', $product->slug) }}?plan=monthly" class="btn btn-primary w-100 py-3 fw-bold shadow-sm buy-btn rounded-pill transition-all" data-slug="{{ $product->slug }}">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-5 text-center">
            <h3 class="mb-4">Frequently Asked Questions</h3>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-start">
                    <div class="accordion" id="pricingFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Can I cancel my subscription at any time?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    Yes, you can cancel your subscription at any time from your account dashboard. You will continue to have access until the end of your billing period.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Do you offer refunds?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                                <div class="accordion-body">
                                    We offer a 14-day money-back guarantee. If you're not satisfied with our plugin, simply contact support for a full refund.
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
.pricing-card {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: white;
    border-radius: 1rem;
    border: 1px solid rgba(0,0,0,0.05);
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px -10px rgba(0,0,0,0.15) !important;
}

.pricing-card .icon-wrapper {
    transition: transform 0.3s ease;
}

.pricing-card:hover .icon-wrapper {
    transform: scale(1.1) rotate(5deg);
}

.text-purple { color: #8b5cf6 !important; }
.text-green { color: #10b981 !important; }
.text-orange { color: #f59e0b !important; }
.text-red { color: #ef4444 !important; }
.text-blue { color: #034f61  !important; }

/* Unified button color */
.pricing-card .btn-primary { background-color: #3b82f6; border-color: #3b82f6; color: white; }

.pricing-card .btn-primary:hover {
    filter: brightness(0.9);
    transform: translateY(-2px);
}

.btn-toggle {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.btn-toggle.active {
    background-color: white;
    color: #0f172a !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.accordion-item {
    border: none;
    margin-bottom: 1rem;
    background: transparent;
}

.accordion-button {
    background-color: white;
    border-radius: 0.5rem !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    font-weight: 600;
    color: #334155;
}

.accordion-button:not(.collapsed) {
    background-color: white;
    color: #0f172a;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(0,0,0,0.05);
}

.accordion-body {
    background-color: white;
    border-bottom-left-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
    padding: 1.5rem;
    color: #64748b;
    margin-top: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthlyBtn = document.getElementById('monthlyBtn');
    const yearlyBtn = document.getElementById('yearlyBtn');
    const priceMonthly = document.querySelectorAll('.price-monthly');
    const priceYearly = document.querySelectorAll('.price-yearly');
    const periodMonthly = document.querySelectorAll('.period-monthly');
    const periodYearly = document.querySelectorAll('.period-yearly');
    const buyBtns = document.querySelectorAll('.buy-btn');

    yearlyBtn.addEventListener('click', () => {
        yearlyBtn.classList.add('active');
        monthlyBtn.classList.remove('active');
        
        priceMonthly.forEach(el => el.style.display = 'none');
        priceYearly.forEach(el => el.style.display = 'inline-block');
        periodMonthly.forEach(el => el.style.display = 'none');
        periodYearly.forEach(el => el.style.display = 'inline');

        // Show savings badges
        document.querySelectorAll('.saving-badge').forEach(badge => {
            badge.style.display = 'block';
            setTimeout(() => badge.style.opacity = '1', 10);
        });
        
        buyBtns.forEach(btn => {
            btn.href = `/checkout/${btn.dataset.slug}?plan=yearly`;
        });
    });

    monthlyBtn.addEventListener('click', () => {
        monthlyBtn.classList.add('active');
        yearlyBtn.classList.remove('active');
        
        priceMonthly.forEach(el => el.style.display = 'inline-block');
        priceYearly.forEach(el => el.style.display = 'none');
        periodMonthly.forEach(el => el.style.display = 'inline');
        periodYearly.forEach(el => el.style.display = 'none');

        // Hide savings badges
        document.querySelectorAll('.saving-badge').forEach(badge => {
            badge.style.opacity = '0';
            setTimeout(() => badge.style.display = 'none', 300);
        });
        
        buyBtns.forEach(btn => {
            btn.href = `/checkout/${btn.dataset.slug}?plan=monthly`;
        });
    });
});
</script>
@endsection
