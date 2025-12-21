@extends('layouts.frontend')

@section('title', $plugin['name'] . ' - Features')

@section('content')
<style>
    :root {
        --hero-color: #3b82f6; /* Blue for Security/Auth */
        --hero-color-dark: #2563eb;
        --hero-color-darker: #1d4ed8;
    }

    /* --- Hero Section (Premium Style) --- */
    .plugin-hero {
        background: linear-gradient(135deg, var(--hero-color) 0%, var(--hero-color-dark) 50%, var(--hero-color-darker) 100%);
        color: white;
        padding: 6rem 0;
        position: relative;
        overflow: hidden;
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        margin-bottom: 2rem;
    }

    .plugin-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.2;
    }

    .plugin-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .plugin-icon-wrapper {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .plugin-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        letter-spacing: -1px;
    }

    .plugin-tagline {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        opacity: 0.95;
        font-weight: 300;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
    }

    .btn-hero {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .btn-hero-primary {
        background: white;
        color: var(--hero-color-dark);
        border: none;
    }
    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        color: var(--hero-color-darker);
    }

    /* --- Overview Grid --- */
    .overview-section {
        padding: 4rem 0;
        background: #fff;
    }
    
    .section-heading {
        text-align: center;
        margin-bottom: 4rem;
    }
    .section-heading h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    .section-heading p {
        font-size: 1.2rem;
        color: #6b7280;
    }

    .modules-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .module-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }

    .module-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 2rem;
        height: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border-top: 4px solid var(--hero-color);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .module-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        border-color: var(--hero-color-dark);
    }

    .module-icon {
        width: 60px;
        height: 60px;
        background: rgba(59, 130, 246, 0.1); 
        color: var(--hero-color);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
    }

    .module-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #111827;
    }

    .module-card p {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* --- Detailed Content --- */
    .detail-wrapper {
        background: #f8fafc;
        padding: 4rem 0;
        position: relative;
    }

    .module-deep-dive {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        scroll-margin-top: 100px; /* For anchor scrolling */
        border: 1px solid #e5e7eb;
    }

    .module-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
        flex-wrap: wrap;
    }

    .module-title-large {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
    }

    .feature-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .feature-group h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .feature-group h4 i {
        color: var(--hero-color);
    }

    .feature-group ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-group li {
        margin-bottom: 0.5rem;
        color: #64748b;
        font-size: 0.95rem;
        position: relative;
        padding-left: 1.25rem;
    }

    .feature-group li::before {
        content: '•';
        color: var(--hero-color);
        font-weight: bold;
        position: absolute;
        left: 0;
    }
    
    /* --- Pricing (From Template) --- */
    .pricing-section {
        padding: 5rem 0;
        background: #fff;
    }
    
    .pricing-toggle {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
        background: #f3f4f6;
        padding: 0.5rem;
        border-radius: 50px;
        width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }
    
    .toggle-btn {
        padding: 0.75rem 2rem;
        border-radius: 40px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        background: transparent;
        color: #6b7280;
        transition: all 0.2s;
    }
    
    .toggle-btn.active {
        background: white;
        color: #1f2937;
        shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
</style>

<!-- Hero Section -->
<section class="plugin-hero">
    <div class="container">
        <div class="plugin-hero-content">
            <div class="plugin-icon-wrapper">
                <i class="{{ $plugin['icon'] }}"></i>
            </div>
            <h1 class="plugin-title">{{ $plugin['name'] }}</h1>
            <p class="plugin-tagline">{{ $plugin['tagline'] }}</p>
            
            <div class="hero-actions">
                <a href="#pricing" class="btn btn-hero btn-hero-primary">Get Started Now</a>
                <a href="#features-list" class="btn btn-hero" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: white; border: 1px solid rgba(255,255,255,0.4);">
                    See All Features
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Overview / Metrics -->
<section class="overview-section" id="features-list">
    <div class="container">
        <div class="section-heading">
            <h2>Complete Security & Authentication Suite</h2>
            <p>100+ Features to Protect Your WordPress Site</p>
        </div>
        
        <div class="modules-grid">
             <a href="#subscription-license" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-id-card"></i></div>
                    <h3>License Management</h3>
                    <p>Trial, activation, and subscription management made easy.</p>
                </div>
            </a>
            <a href="#2fa-methods" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-key"></i></div>
                    <h3>3 Auth Methods</h3>
                    <p>Email, Authenticator App (TOTP), and SMS verification.</p>
                </div>
            </a>
            <a href="#user-management" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-users-cog"></i></div>
                    <h3>User Enforcement</h3>
                    <p>Force 2FA for specific roles, new users, or everyone.</p>
                </div>
            </a>
            <a href="#plugin-updates" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-sync-alt"></i></div>
                    <h3>Automatic Updates</h3>
                    <p>One-click updates with license validation and notifications.</p>
                </div>
            </a>
            <a href="#admin-dashboard" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-chart-pie"></i></div>
                    <h3>Admin Dashboard</h3>
                    <p>Analytics, status indicators, and configuration center.</p>
                </div>
            </a>
            <a href="#profile-integration" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-user-shield"></i></div>
                    <h3>Profile Integration</h3>
                    <p>Seamless setup directly from the WordPress user profile.</p>
                </div>
            </a>
             <a href="#security-features" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Enterprise Security</h3>
                    <p>Secure code generation, encryption, and API safety.</p>
                </div>
            </a>
             <a href="#statistics-reporting" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>Stats & Reporting</h3>
                    <p>Real-time insights on user adoption and system status.</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Deep Dive Sections -->
<section class="detail-wrapper">
    <div class="container">

        <!-- 1. Subscription & License Management -->
        <div id="subscription-license" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-id-card"></i></div>
                <h2 class="module-title-large">Subscription & License Management</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-clock"></i> Free Trial System</h4>
                    <ul>
                         <li>Automatic 7-Day Free Trial</li>
                         <li>No license key required to start</li>
                         <li>Full access to premium features</li>
                         <li>Trial countdown timer</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-check-circle"></i> License Activation</h4>
                    <ul>
                         <li>Remote API validation</li>
                         <li>Product ID-based verification</li>
                         <li>Site URL validation</li>
                         <li>License expiration tracking</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-sync"></i> Subscription Management</h4>
                    <ul>
                         <li>Seamless trial to paid upgrade</li>
                         <li>One-click upgrade process</li>
                         <li>Real-time status tracking</li>
                         <li>Easy license deactivation</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 2. Two-Factor Authentication Methods -->
        <div id="2fa-methods" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-mobile-alt"></i></div>
                <h2 class="module-title-large">Two-Factor Authentication Methods</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-envelope"></i> Email-Based</h4>
                    <ul>
                         <li>6-digit random code generation</li>
                         <li>Codes sent to registered email</li>
                         <li>10-minute code expiration</li>
                         <li>Secure code storage & cleanup</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-qrcode"></i> Authenticator App (TOTP)</h4>
                    <ul>
                         <li>QR code generation for setup</li>
                         <li>Compatible with Google/Microsoft Authenticator</li>
                         <li>Support for Authy, 1Password, LastPass</li>
                         <li>Manual secret key entry option</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-sms"></i> SMS Authentication</h4>
                    <ul>
                         <li>Twilio integration for delivery</li>
                         <li>Phone number management</li>
                         <li>Country code support</li>
                         <li>10-minute code expiration</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 3. User Management & Enforcement -->
        <div id="user-management" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-users-cog"></i></div>
                <h2 class="module-title-large">User Management & Enforcement</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-globe"></i> Global Settings</h4>
                    <ul>
                         <li>Master switch to enable/disable 2FA</li>
                         <li>Instant activation/deactivation</li>
                         <li>Settings saved securely</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-gavel"></i> Enforcement Options</h4>
                    <ul>
                         <li>Force 2FA for All Users</li>
                         <li>Force 2FA for New Users (after X days)</li>
                         <li>Role-based exclusions</li>
                         <li>Opt-in mode available</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-user-check"></i> Individual Settings</h4>
                    <ul>
                         <li>Status display per user</li>
                         <li>TOTP setup from profile</li>
                         <li>Enable/disable per user</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 4. Plugin Updates -->
        <div id="plugin-updates" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-sync-alt"></i></div>
                <h2 class="module-title-large">Plugin Updates</h2>
            </div>
             <p class="mb-4 text-muted">Stay secure with our automated, license-aware update system.</p>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-magic"></i> Automatic System</h4>
                    <ul>
                         <li>Auto-check every 12 hours</li>
                         <li>One-click updates from admin</li>
                         <li>Native WordPress integration</li>
                         <li>Update notifications banner</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-shield-alt"></i> Security & License</h4>
                    <ul>
                         <li>License validation for updates</li>
                         <li>Secure package delivery</li>
                         <li>Product ID-based checks</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 5. Admin Dashboard -->
        <div id="admin-dashboard" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-tachometer-alt"></i></div>
                <h2 class="module-title-large">Admin Dashboard</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-info-circle"></i> Status Display</h4>
                    <ul>
                         <li>Active/Expired status indicators</li>
                         <li>License key & expiration display</li>
                         <li>Trial countdown banner</li>
                         <li>Update availability status</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-chart-pie"></i> Statistics Section</h4>
                    <ul>
                         <li>Total users count</li>
                         <li>2FA adoption (Enabled/Disabled)</li>
                         <li>Enforcement level display</li>
                         <li>Excluded roles activity</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 6. Profile Integration & Configuration -->
        <div id="profile-integration" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-sliders-h"></i></div>
                <h2 class="module-title-large">Integration & Configuration</h2>
            </div>
             <div class="feature-list-grid">
                 <div class="feature-group">
                    <h4><i class="fas fa-user-circle"></i> User Profile</h4>
                    <ul>
                         <li>Beautiful gradient header design</li>
                         <li>Step-by-step TOTP setup</li>
                         <li>QR code display</li>
                         <li>Phone number management</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-cogs"></i> Configuration</h4>
                    <ul>
                         <li>Method selection (Email, TOTP, SMS)</li>
                         <li>Twilio API setup</li>
                         <li>Enforcement rules</li>
                         <li>Role exclusions</li>
                    </ul>
                </div>
             </div>
        </div>
        
        <!-- 7. Security Features -->
        <div id="security-features" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-lock"></i></div>
                <h2 class="module-title-large">Security Features</h2>
            </div>
             <div class="feature-list-grid">
                 <div class="feature-group">
                    <h4><i class="fas fa-key"></i> Code Security</h4>
                    <ul>
                         <li>Cryptographically secure random codes</li>
                         <li>Unique codes per attempt</li>
                         <li>Encrypted expiration timestamps</li>
                         <li>Automatic code cleanup</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-network-wired"></i> System Security</h4>
                    <ul>
                         <li>Nonce verification</li>
                         <li>Data sanitization</li>
                         <li>Session management</li>
                         <li>License API security</li>
                    </ul>
                </div>
             </div>
        </div>

    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section" id="pricing">
    <div class="container">
        <div class="section-heading">
            <h2>Secure Your Site Today</h2>
            <p>Enterprise-grade authentication for WordPress</p>
        </div>

        <div class="pricing-toggle">
            <button class="toggle-btn active" onclick="switchPrice('monthly', this)">Monthly</button>
            <button class="toggle-btn" onclick="switchPrice('yearly', this)">Yearly (Save 20%)</button>
        </div>

        <div class="card" style="max-width: 600px; margin: 0 auto; border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); overflow: hidden;">
             <div class="card-header text-center" style="background: var(--hero-color); color: white; padding: 2rem;">
                 <h3 style="margin: 0; font-size: 1.5rem;">Pro License</h3>
                 <div class="price-display mt-3">
                     <span class="currency" style="font-size: 1.5rem; vertical-align: top;">$</span>
                     <span class="amount" id="price-amount" style="font-size: 3.5rem; font-weight: 800; line-height: 1;">{{ number_format($plugin['price_monthly'], 2) }}</span>
                     <span class="period" id="price-period" style="font-size: 1rem; opacity: 0.8; margin-left: 5px;">/month</span>
                 </div>
             </div>
             <div class="card-body" style="padding: 2rem;">
                 <ul class="list-unstyled" style="font-size: 1.1rem; line-height: 2;">
                     <li><i class="fas fa-check-circle text-success mr-2"></i> All 3 Authentication Methods</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Unlimited Users</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> SMS (Twilio) Integration</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Advanced User Enforcement</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Premium Support</li>
                 </ul>
                 <div class="text-center mt-4">
                     <a href="/checkout/{{ $plugin['slug'] }}?plan=monthly" id="checkout-btn" class="btn btn-lg btn-block" style="background: var(--hero-color); color: white; border-radius: 50px; padding: 0.75rem 2rem;">Buy Now</a>
                 </div>
             </div>
        </div>
    </div>
</section>

<script>
    function switchPrice(plan, btn) {
        // Toggle Buttons
        document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const amountEl = document.getElementById('price-amount');
        const periodEl = document.getElementById('price-period');
        const btnEl = document.getElementById('checkout-btn');
        
        // Define prices - passed from server
        const monthly = "{{ number_format($plugin['price_monthly'], 2) }}";
        const yearly = "{{ number_format($plugin['price_yearly'], 2) }}";
        
        if (plan === 'yearly') {
            amountEl.innerText = yearly;
            periodEl.innerText = '/year';
            btnEl.href = "/checkout/{{ $plugin['slug'] }}?plan=yearly";
        } else {
            amountEl.innerText = monthly;
            periodEl.innerText = '/month';
            btnEl.href = "/checkout/{{ $plugin['slug'] }}?plan=monthly";
        }
    }
</script>

@endsection
