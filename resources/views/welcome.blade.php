@extends('layouts.frontend')

@section('title', 'Trusted WordPress Solutions')
@section('meta_title', 'Assertivlogix - Premium WordPress Plugins for Security, SEO, Backup & Performance')
@section('meta_description', 'Discover premium WordPress plugins trusted by millions. Secure your site, boost SEO, automate backups, and optimize performance with Assertivlogix professional plugins.')
@section('meta_keywords', 'WordPress plugins, WordPress security, SEO plugins, backup plugins, performance optimization, WordPress tools, website security')
@section('canonical_url', url('/'))
@section('og_type', 'website')
@section('og_image', asset('images/og-home.jpg'))

@section('schema_json')
@php
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Assertivlogix',
    'url' => url('/'),
    'logo' => asset('images/logo.png'),
    'description' => 'Premium WordPress plugins for security, SEO, backup, and performance',
    'sameAs' => [
        'https://www.facebook.com/assertivlogix',
        'https://twitter.com/assertivlogix'
    ],
    'contactPoint' => [
        '@type' => 'ContactPoint',
        'contactType' => 'Customer Support',
        'url' => route('support.contact')
    ]
];
@endphp
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>We're Assertivlogix Plugins</h1>
        <p>If you own a WordPress website or create and maintain WordPress sites on behalf of clients, you've come to the right place. Our plugin suite helps you to improve your online presence and achieve your goals.</p>
        <div class="hero-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-primary" style="background: white; color: var(--primary-color);">
                <i class="fas fa-rocket"></i> Browse Plugins
            </a>
            <?php /*<a href="#" class="btn btn-outline" style="border-color: white; color: white;">
                <i class="fas fa-play-circle"></i> Watch Demo
            </a>*/ ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container">
        <div class="section-header">
            <h2>We're for WordPress Website Owners</h2>
            <p>Assertivlogix plugins are actively installed on more than 5 million WordPress websites worldwide. Our plugins are easy to use and many are 'set and forget' – set them up in minutes and they'll do the hard work for you.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Security First</h3>
                <p>Protect your WordPress site from malware, hackers, and security threats with our comprehensive security solutions.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <h3>Performance Optimization</h3>
                <p>Speed up your WordPress website with advanced caching, image optimization, and performance tuning tools.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <h3>Backup & Migration</h3>
                <p>Back up to top cloud providers like Google Drive, Dropbox, and OneDrive. Restore in just a couple of clicks.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>SEO Optimization</h3>
                <p>Improve your search engine rankings with our powerful SEO tools and optimization features.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Analytics & Insights</h3>
                <p>Get detailed insights into your website performance with privacy-friendly analytics and reporting.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Multi-Site Management</h3>
                <p>Manage multiple WordPress websites from a single dashboard with our centralized management tools.</p>
            </div>
        </div>
    </div>
</section>

<!-- Plugins Section -->
<section class="plugins">
    <div class="container">
        <div class="section-header">
            <h2>Our Plugin Suite</h2>
            <p>Beautifully coded WordPress plugins you can rely on. We've been building and fine tuning our craft for almost 15 years.</p>
        </div>

        <div class="plugins-grid">
            @if(isset($products))
                @foreach($products as $product)
                <div class="plugin-card">
                    <div class="plugin-icon">
                        <i class="{{ $product->icon_image ?? 'fas fa-cube' }}"></i>
                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p>{{ $product->short_description }}</p>
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
    </div>
</section>

<!-- Trust Section -->
<section class="features">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Assertivlogix Plugins?</h2>
            <p>We're experienced and we're the top 1%. Our WordPress software developers are the very best in their field.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>5 Million+ Active Installs</h3>
                <p>Trusted by over 5 million WordPress websites worldwide with excellent user satisfaction.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="fas fa-award"></i>
                </div>
                <h3>15 Years Experience</h3>
                <p>We've been building and fine tuning our craft for almost 15 years in the WordPress ecosystem.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Premium Support</h3>
                <p>Get help when you need it with our dedicated support team available around the clock.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero" style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Join millions of WordPress users who trust Assertivlogix Plugins for their website security, performance, and optimization needs.</p>
        <div class="hero-buttons">
            <a href="{{ route('products.index') }}" class="btn btn-primary" style="background: white; color: var(--primary-color);">
                <i class="fas fa-shopping-cart"></i> Browse All Plugins
            </a>
            <a href="#" class="btn btn-outline" style="border-color: white; color: white;">
                <i class="fas fa-phone"></i> Contact Sales
            </a>
        </div>
    </div>
</section>
@endsection
