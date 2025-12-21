@extends('layouts.frontend')

@section('title', $plugin['name'] . ' - Assertivlogix')

@section('content')
<style>
.plugin-hero {
    background: linear-gradient(135deg, {{ $plugin['hero_color'] }} 0%, {{ $plugin['hero_color_dark'] }} 50%, {{ $plugin['hero_color_darker'] }} 100%);
    color: white;
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
}

.plugin-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.plugin-hero-content {
    position: relative;
    z-index: 1;
}

.plugin-icon-large {
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.5rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.plugin-name {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.plugin-tagline {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.plugin-description {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    opacity: 0.8;
    max-width: 600px;
}

.plugin-pricing {
    margin-bottom: 2rem;
}

.pricing-toggle {
    display: flex;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 4px;
    margin-bottom: 1rem;
    backdrop-filter: blur(10px);
}

.pricing-btn {
    flex: 1;
    padding: 0.5rem 1rem;
    border: none;
    background: transparent;
    color: white;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s;
    font-weight: 600;
}

.pricing-btn.active {
    background: white;
    color: {{ $plugin['hero_color_dark'] }};
}

.price-display {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.price-monthly,
.price-yearly {
    display: inline-block;
}

.features-section {
    padding: 5rem 0;
    background: white;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 3rem;
    color: #1f2937;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.feature-card {
    background: #f8fafc;
    padding: 2rem;
    border-radius: 12px;
    border-left: 4px solid {{ $plugin['feature_color'] }};
    transition: transform 0.3s, box-shadow 0.3s;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, {{ $plugin['feature_color'] }}, {{ $plugin['feature_color_dark'] }});
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-bottom: 1rem;
}

.benefits-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.benefit-item {
    text-align: center;
    padding: 2rem;
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, {{ $plugin['benefit_color'] }}, {{ $plugin['benefit_color_dark'] }});
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.screenshots-section {
    padding: 5rem 0;
    background: white;
}

.screenshots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.screenshot-card {
    background: #f8fafc;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.screenshot-placeholder {
    height: 200px;
    background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-weight: 600;
}

.screenshot-info {
    padding: 1.5rem;
}

.screenshot-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.screenshot-description {
    color: #64748b;
    font-size: 0.9rem;
}

.testimonials-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, #1f2937, #374151);
    color: white;
    position: relative;
    overflow: hidden;
}

.testimonials-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="testimonial-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23testimonial-grid)"/></svg>');
    opacity: 0.3;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    position: relative;
    z-index: 1;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.08);
    padding: 2.5rem;
    border-radius: 16px;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.3s ease;
    position: relative;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.12);
    border-color: rgba(255, 255, 255, 0.25);
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: 1rem;
    left: 1.5rem;
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.1);
    font-family: Georgia, serif;
    line-height: 1;
}

.testimonial-content {
    font-style: italic;
    margin-bottom: 2rem;
    line-height: 1.7;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

.testimonial-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, {{ $plugin['feature_color'] }}, {{ $plugin['feature_color_dark'] }});
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.2rem;
    border: 3px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.testimonial-info h4 {
    margin-bottom: 0.25rem;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
}

.testimonial-info p {
    color: #94a3b8;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.rating {
    color: #fbbf24;
    margin-top: 0.5rem;
    display: flex;
    gap: 0.25rem;
}

.rating i {
    font-size: 1rem;
}

.cta-section {
    padding: 5rem 0;
    background: linear-gradient(135deg, {{ $plugin['hero_color'] }}, {{ $plugin['hero_color_dark'] }});
    color: white;
    text-align: center;
}

.cta-pricing {
    margin: 3rem 0;
}

.pricing-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.pricing-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 2rem;
    border-radius: 16px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    transition: transform 0.3s, box-shadow 0.3s;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.pricing-card.yearly-card {
    border: 2px solid rgba(255, 255, 255, 0.4);
}

.popular-badge {
    position: absolute;
    top: -15px;
    right: 20px;
    background: #fbbf24;
    color: #1f2937;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.875rem;
}

.pricing-card h3 {
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.pricing-card .price {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.pricing-card .price span {
    font-size: 1rem;
    opacity: 0.8;
}

.savings {
    color: #fbbf24;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 1.5rem 0;
    text-align: left;
}

.features-list li {
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
}

.features-list li i {
    color: #fbbf24;
    margin-right: 0.75rem;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.cta-description {
    font-size: 1.125rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-plugin {
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary-plugin {
    background: white;
    color: {{ $plugin['hero_color_dark'] }};
}

.btn-primary-plugin:hover {
    background: #f3f4f6;
    transform: translateY(-2px);
}

.btn-outline-plugin {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-outline-plugin:hover {
    background: white;
    color: {{ $plugin['hero_color_dark'] }};
}

@media (max-width: 768px) {
    .plugin-name {
        font-size: 2rem;
    }
    
    .plugin-tagline {
        font-size: 1.25rem;
    }
    
    .features-grid,
    .benefits-grid,
    .screenshots-grid,
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Plugin Hero Section -->
<section class="plugin-hero">
    <div class="container">
        <div class="plugin-hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="plugin-icon-large">
                        <i class="{{ $plugin['icon'] }}"></i>
                    </div>
                    <h1 class="plugin-name">{{ $plugin['name'] }}</h1>
                    <p class="plugin-tagline">{{ $plugin['tagline'] }}</p>
                    <p class="plugin-description">{{ $plugin['description'] }}</p>
                    
                    <!-- Pricing Display -->
                    <div class="plugin-pricing">
                        <div class="pricing-toggle">
                            <button class="pricing-btn active" data-period="monthly">Monthly</button>
                            <button class="pricing-btn" data-period="yearly">Yearly (Save 20%)</button>
                        </div>
                        <div class="price-display">
                            <span class="price-monthly">${{ number_format($plugin['price_monthly'], 2) }}/month</span>
                            <span class="price-yearly" style="display: none;">${{ number_format($plugin['price_yearly'], 2) }}/year</span>
                        </div>
                    </div>
                    
                    <div class="cta-buttons">
                        @auth
                            <a href="{{ route('checkout.create', $product) }}?plan=monthly" class="btn btn-plugin btn-primary-plugin buy-btn" id="buyNowBtn">
                                <i class="fas fa-shopping-cart"></i> Buy Now
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-plugin btn-primary-plugin buy-btn">
                                <i class="fas fa-shopping-cart"></i> Buy Now
                            </a>
                        @endauth
                        <a href="#" class="btn btn-plugin btn-outline-plugin">
                            <i class="fas fa-play-circle"></i> Watch Demo
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ $plugin['banner_image'] }}" alt="{{ $plugin['name'] }} Dashboard" class="img-fluid rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <h2 class="section-title">Powerful {{ $plugin['plugin_category'] }} Features</h2>
        <div class="features-grid">
            @foreach($plugin['features'] as $feature)
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3>{{ $feature }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="benefits-section">
    <div class="container">
        <h2 class="section-title">Why Choose {{ $plugin['name'] }}?</h2>
        <div class="benefits-grid">
            @foreach($plugin['benefits'] as $benefit)
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>{{ $benefit }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Screenshots Section -->
<section class="screenshots-section">
    <div class="container">
        <h2 class="section-title">Interface Preview</h2>
        <div class="screenshots-grid">
            @foreach($plugin['screenshots'] as $key => $screenshot)
            <div class="screenshot-card">
                <div class="screenshot-placeholder">
                    <i class="fas fa-image fa-3x"></i>
                </div>
                <div class="screenshot-info">
                    <h4 class="screenshot-title">{{ ucfirst($key) }}</h4>
                    <p class="screenshot-description">{{ $screenshot }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="section-title">What Our Users Say</h2>
        <div class="testimonials-grid">
            @foreach($plugin['testimonials'] as $testimonial)
            <div class="testimonial-card">
                <div class="testimonial-content">
                    "{{ $testimonial['content'] }}"
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        {{ substr($testimonial['name'], 0, 1) }}
                    </div>
                    <div class="testimonial-info">
                        <h4>{{ $testimonial['name'] }}</h4>
                        <p>{{ $testimonial['role'] }}</p>
                        <div class="rating">
                            @for($i = 1; $i <= $testimonial['rating']; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">Ready to {{ $plugin['cta_action'] }}?</h2>
        <p class="cta-description">Join thousands of satisfied customers who trust {{ $plugin['name'] }} for their {{ $plugin['plugin_category'] }} needs.</p>
        
        <!-- Pricing Options -->
        <div class="cta-pricing">
            <div class="pricing-cards">
                <div class="pricing-card monthly-card active">
                    <h3>Monthly Plan</h3>
                    <div class="price">${{ number_format($plugin['price_monthly'], 2) }}<span>/month</span></div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> All {{ $plugin['plugin_category'] }} features</li>
                        <li><i class="fas fa-check"></i> 24/7 monitoring</li>
                        <li><i class="fas fa-check"></i> Automatic updates</li>
                        <li><i class="fas fa-check"></i> Email support</li>
                    </ul>
                    <button class="btn btn-plugin btn-primary-plugin buy-btn" data-plugin="{{ $plugin['slug'] }}" data-period="monthly">
                        <i class="fas fa-shopping-cart"></i> Buy Monthly
                    </button>
                </div>
                
                <div class="pricing-card yearly-card">
                    <div class="popular-badge">Save 20%</div>
                    <h3>Yearly Plan</h3>
                    <div class="price">${{ number_format($plugin['price_yearly'], 2) }}<span>/year</span></div>
                    <div class="savings">Save ${{ number_format(($plugin['price_monthly'] * 12) - $plugin['price_yearly'], 2) }} per year</div>
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> All {{ $plugin['plugin_category'] }} features</li>
                        <li><i class="fas fa-check"></i> 24/7 monitoring</li>
                        <li><i class="fas fa-check"></i> Automatic updates</li>
                        <li><i class="fas fa-check"></i> Priority support</li>
                        <li><i class="fas fa-check"></i> Advanced reporting</li>
                    </ul>
                    <button class="btn btn-plugin btn-primary-plugin buy-btn" data-plugin="{{ $plugin['slug'] }}" data-period="yearly">
                        <i class="fas fa-shopping-cart"></i> Buy Yearly
                    </button>
                </div>
            </div>
        </div>
        
        <div class="cta-buttons">
            <a href="#" class="btn btn-plugin btn-outline-plugin">
                <i class="fas fa-phone"></i> Contact Sales
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pricing toggle functionality
    const pricingBtns = document.querySelectorAll('.pricing-btn');
    const priceMonthly = document.querySelector('.price-monthly');
    const priceYearly = document.querySelector('.price-yearly');
    const buyNowBtn = document.getElementById('buyNowBtn');
    
    pricingBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            pricingBtns.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Toggle price display
            const period = this.dataset.period;
            if (period === 'monthly') {
                priceMonthly.style.display = 'inline-block';
                priceYearly.style.display = 'none';
                // Update Buy Now button href for monthly plan
                if (buyNowBtn) {
                    buyNowBtn.href = '{{ route("checkout.create", $product) }}?plan=monthly';
                }
            } else {
                priceMonthly.style.display = 'none';
                priceYearly.style.display = 'inline-block';
                // Update Buy Now button href for yearly plan
                if (buyNowBtn) {
                    buyNowBtn.href = '{{ route("checkout.create", $product) }}?plan=yearly';
                }
            }
        });
    });
});
</script>
@endsection
