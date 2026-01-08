@extends('layouts.frontend')

@section('title', 'WordPress Plugins - Assertivlogix')
@section('meta_title', 'WordPress Plugins - Premium Security, SEO, Backup & Performance Tools | Assertivlogix')
@section('meta_description', 'Browse our complete collection of premium WordPress plugins. Security, SEO optimization, automated backups, performance tools, and more. Trusted by millions of website owners.')
@section('meta_keywords', 'WordPress plugins, security plugins, SEO plugins, backup plugins, performance plugins, WordPress tools, premium plugins')
@section('canonical_url', route('products.index'))
@section('og_type', 'website')
@section('og_image', asset('images/og-plugins.jpg'))

@section('schema_json')
@php
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'WordPress Plugins',
    'description' => 'Premium WordPress plugins collection',
    'url' => route('products.index'),
    'mainEntity' => [
        '@type' => 'ItemList',
        'itemListElement' => []
    ]
];

foreach($products as $index => $product) {
    $schema['mainEntity']['itemListElement'][] = [
        '@type' => 'ListItem',
        'position' => $index + 1,
        'item' => [
            '@type' => 'SoftwareApplication',
            'name' => $product->name,
            'url' => route('products.show', $product->slug),
            'description' => Str::limit($product->short_description, 150)
        ]
    ];
}
@endphp
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endsection

@section('content')
<style>
/* Override and enhance styles specifically for this page */
.hero-modern {
    background: linear-gradient(135deg, #8b5cf6 0%, #034f61 50%, #6d28d9 100%) !important;
    color: white !important;
    padding: 6rem 0 !important;
    min-height: 80vh !important;
    display: flex !important;
    align-items: center !important;
}

.hero-content {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 4rem !important;
    align-items: center !important;
    max-width: 1200px !important;
    margin: 0 auto !important;
}

.hero-text h1 {
    font-size: 3.5rem !important;
    font-weight: 700 !important;
    margin-bottom: 1.5rem !important;
    line-height: 1.2 !important;
    color: white !important;
}

.hero-text p {
    font-size: 1.25rem !important;
    margin-bottom: 2rem !important;
    opacity: 0.9 !important;
    line-height: 1.6 !important;
    color: white !important;
}

.hero-buttons {
    display: flex !important;
    gap: 1rem !important;
    flex-wrap: wrap !important;
}

.hero-icon {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
}

.cube-3d {
    width: 200px !important;
    height: 200px !important;
    position: relative !important;
    transform-style: preserve-3d !important;
    animation: rotateCube 20s infinite linear !important;
}

.cube-face {
    position: absolute !important;
    width: 200px !important;
    height: 200px !important;
    background: rgba(255, 255, 255, 0.1) !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    border-radius: 20px !important;
    backdrop-filter: blur(10px) !important;
}

.cube-front {
    transform: translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.15) !important;
}

.cube-back {
    transform: rotateY(180deg) translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.1) !important;
}

.cube-left {
    transform: rotateY(-90deg) translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.12) !important;
}

.cube-right {
    transform: rotateY(90deg) translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.12) !important;
}

.cube-top {
    transform: rotateX(90deg) translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.18) !important;
}

.cube-bottom {
    transform: rotateX(-90deg) translateZ(100px) !important;
    background: rgba(255, 255, 255, 0.08) !important;
}

@keyframes rotateCube {
    0% {
        transform: rotateX(0deg) rotateY(0deg);
    }
    100% {
        transform: rotateX(360deg) rotateY(360deg);
    }
}

.statistics {
    background: white !important;
    padding: 4rem 0 !important;
    border-bottom: 1px solid #e5e7eb !important;
}

.stats-grid {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 2rem !important;
    text-align: center !important;
}

.stat-item {
    padding: 2rem !important;
}

.stat-number {
    font-size: 3rem !important;
    font-weight: 700 !important;
    color: #8b5cf6 !important;
    margin-bottom: 0.5rem !important;
}

.stat-label {
    font-size: 1.125rem !important;
    color: #6b7280 !important;
    font-weight: 500 !important;
}

.filter-section {
    background: white !important;
    border-radius: 12px !important;
    padding: 2rem !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    margin-bottom: 3rem !important;
    border: 1px solid #e5e7eb !important;
}

.filter-btn {
    padding: 0.5rem 1.5rem !important;
    border-radius: 25px !important;
    border: 2px solid #e9ecef !important;
    background: white !important;
    color: #6c757d !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    margin: 0.25rem !important;
    cursor: pointer !important;
    font-size: 0.9rem !important;
}

.filter-btn:hover,
.filter-btn.active {
    background: linear-gradient(135deg, #8b5cf6, #034f61) !important;
    color: white !important;
    border-color: #8b5cf6 !important;
    transform: translateY(-1px) !important;
}

.form-select {
    border-radius: 25px !important;
    padding: 0.5rem 1rem !important;
    border: 2px solid #e9ecef !important;
    font-size: 0.9rem !important;
    transition: all 0.3s ease !important;
}

.form-select:focus {
    border-color: #8b5cf6 !important;
    box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25) !important;
}

.section-header {
    text-align: center !important;
    margin-bottom: 4rem !important;
}

.section-header h2 {
    font-size: 2.5rem !important;
    font-weight: 700 !important;
    color: #1f2937 !important;
    margin-bottom: 1rem !important;
}

.section-header p {
    font-size: 1.125rem !important;
    color: #6b7280 !important;
    max-width: 600px !important;
    margin: 0 auto !important;
}

.plugins-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)) !important;
    gap: 2rem !important;
    margin-bottom: 4rem !important;
}

.plugin-card {
    background: white !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 12px !important;
    padding: 2rem !important;
    text-align: center !important;
    transition: all 0.3s !important;
    position: relative !important;
    overflow: hidden !important;
}

.plugin-card::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    height: 4px !important;
    background: linear-gradient(90deg, #f59e0b, #d97706) !important;
}

.plugin-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important;
}

.plugin-card .plugin-icon {
    width: 80px !important;
    height: 80px !important;
    background: linear-gradient(135deg, #8b5cf6, #034f61) !important;
    border-radius: 20px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-size: 2rem !important;
    margin: 0 auto 1.5rem !important;
}

.plugin-card .plugin-name {
    font-size: 1.5rem !important;
    font-weight: 600 !important;
    margin-bottom: 1rem !important;
    color: #1f2937 !important;
}

.plugin-card .plugin-description {
    color: #6b7280 !important;
    margin-bottom: 1.5rem !important;
    line-height: 1.6 !important;
    font-size: 1rem !important;
}

.plugin-card .plugin-price {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #8b5cf6 !important;
    margin-bottom: 1.5rem !important;
}

.plugin-card .btn-primary {
    width: 100% !important;
    background: #034f61 !important;
    color: white !important;
    padding: 0.75rem 1.5rem !important;
    border-radius: 8px !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    transition: all 0.3s !important;
    border: none !important;
    cursor: pointer !important;
}

.plugin-card .btn-primary:hover {
    background: #034f61 !important;
    transform: translateY(-1px) !important;
}

.cta-section {
    background: linear-gradient(135deg, #8b5cf6, #034f61) !important;
    color: white !important;
    border-radius: 12px !important;
    padding: 3rem !important;
    text-align: center !important;
    margin-top: 3rem !important;
}

.btn-hero {
    padding: 0.75rem 2rem !important;
    font-size: 1.1rem !important;
    font-weight: 600 !important;
    border-radius: 50px !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
    display: inline-block !important;
}

.btn-hero:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
}

.btn-light-hero {
    background: white !important;
    color: #034f61 !important;
    border: none !important;
}

.btn-outline-hero {
    background: transparent !important;
    color: white !important;
    border: 2px solid white !important;
}

.btn-outline-hero:hover {
    background: white !important;
    color: #034f61 !important;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .hero-content {
        grid-template-columns: 1fr !important;
        gap: 2rem !important;
        text-align: center !important;
    }
    
    .hero-text h1 {
        font-size: 2.5rem !important;
    }
    
    .hero-text p {
        font-size: 1.125rem !important;
    }
    
    .cube-3d {
        width: 150px !important;
        height: 150px !important;
    }
    
    .cube-face {
        width: 150px !important;
        height: 150px !important;
    }
    
    .cube-front {
        transform: translateZ(75px) !important;
    }
    
    .cube-back {
        transform: rotateY(180deg) translateZ(75px) !important;
    }
    
    .cube-left {
        transform: rotateY(-90deg) translateZ(75px) !important;
    }
    
    .cube-right {
        transform: rotateY(90deg) translateZ(75px) !important;
    }
    
    .cube-top {
        transform: rotateX(90deg) translateZ(75px) !important;
    }
    
    .cube-bottom {
        transform: rotateX(-90deg) translateZ(75px) !important;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 1rem !important;
    }
    
    .stat-item {
        padding: 1rem !important;
    }
    
    .stat-number {
        font-size: 2rem !important;
    }
    
    .stat-label {
        font-size: 1rem !important;
    }
    
    .plugins-grid {
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
    }
    
    .section-header h2 {
        font-size: 2rem !important;
    }
    
    .filter-section {
        padding: 1.5rem !important;
    }
    
    .filter-btn {
        font-size: 0.8rem !important;
        padding: 0.4rem 1rem !important;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-modern">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Our WordPress Plugins</h1>
                <p>Premium WordPress solutions to secure, optimize, and grow your website with professional-grade tools trusted by millions.</p>
                <div class="hero-buttons">
                    <a href="#plugins" class="btn btn-primary">
                        <i class="fas fa-th-large"></i> Browse Plugins
                    </a>
                    <?php /*<a href="#" class="btn btn-outline">
                        <i class="fas fa-play-circle"></i> Watch Demo
                    </a>*/ ?>
                </div>
            </div>
            <div class="hero-icon">
                <div class="cube-3d">
                    <div class="cube-face cube-front"></div>
                    <div class="cube-face cube-back"></div>
                    <div class="cube-face cube-left"></div>
                    <div class="cube-face cube-right"></div>
                    <div class="cube-face cube-top"></div>
                    <div class="cube-face cube-bottom"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="statistics">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">5M+</div>
                <div class="stat-label">Active Installations</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">15+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Premium Support</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">30-Day</div>
                <div class="stat-label">Money Back Guarantee</div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="container">
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center">
                    <span class="me-3 fw-bold text-muted">Filter by:</span>
                    <div class="d-flex flex-wrap">
                        <button class="filter-btn active" data-filter="all">All Plugins</button>
                        <button class="filter-btn" data-filter="security">Security</button>
                        <button class="filter-btn" data-filter="seo">SEO</button>
                        <button class="filter-btn" data-filter="performance">Performance</button>
                        <button class="filter-btn" data-filter="backup">Backup</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-end">
                    <span class="me-2 fw-bold text-muted">Sort by:</span>
                    <select class="form-select" style="width: 180px;">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Name: A-Z</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="plugins" class="container pb-5">
    <div class="section-header">
        <h2>Beautifully coded WordPress plugins you can rely on</h2>
        <p>We've been building and fine tuning our craft for almost 15 years.</p>
    </div>

    <div class="plugins-grid">
        @if(isset($products))
            @foreach($products as $product)
            <!-- {{ $product->name }} -->
            <div class="plugin-card" data-category="{{ $product->category ?? 'other' }}">
                <div class="plugin-icon">
                    <i class="{{ $product->icon_image ?? 'fas fa-cube' }}"></i>
                </div>
                <h3 class="plugin-name">{{ $product->name }}</h3>
                <p class="plugin-description">{{ $product->short_description }}</p>
                <div class="plugin-price">
                    ${{ number_format($product->price_monthly, 2) }}/mo &bull; ${{ number_format($product->price_yearly, 2) }}/yr
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('checkout.create', $product->slug) }}" class="btn btn-primary flex-grow-1">Get Started</a>
                    <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-secondary">Learn More</a>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <h3 class="mb-3">Need Help Choosing the Right Plugin?</h3>
        <p class="mb-4">Our experts are here to help you find the perfect solution for your WordPress website.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('support.contact') }}" class="btn btn-hero btn-light-hero">
                <i class="fas fa-headset me-2"></i>Get Expert Help
            </a>
            <a href="{{ route('support.contact') }}" class="btn btn-hero btn-outline-hero">
                <i class="fas fa-comments me-2"></i>Live Chat
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const pluginCards = document.querySelectorAll('.plugin-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            // Show/hide plugin cards based on filter
            pluginCards.forEach(card => {
                if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Sort functionality
    const sortSelect = document.querySelector('.form-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            const grid = document.querySelector('.plugins-grid');
            const cards = Array.from(grid.querySelectorAll('.plugin-card'));
            
            cards.sort((a, b) => {
                if (sortValue.includes('Price: Low to High')) {
                    const priceA = parseFloat(a.querySelector('.plugin-price').textContent.replace(/[^0-9.]/g, ''));
                    const priceB = parseFloat(b.querySelector('.plugin-price').textContent.replace(/[^0-9.]/g, ''));
                    return priceA - priceB;
                } else if (sortValue.includes('Price: High to Low')) {
                    const priceA = parseFloat(a.querySelector('.plugin-price').textContent.replace(/[^0-9.]/g, ''));
                    const priceB = parseFloat(b.querySelector('.plugin-price').textContent.replace(/[^0-9.]/g, ''));
                    return priceB - priceA;
                } else if (sortValue.includes('Name: A-Z')) {
                    const nameA = a.querySelector('.plugin-name').textContent;
                    const nameB = b.querySelector('.plugin-name').textContent;
                    return nameA.localeCompare(nameB);
                }
                return 0;
            });
            
            // Re-append sorted cards
            cards.forEach(card => grid.appendChild(card));
        });
    }
});
</script>
@endsection
