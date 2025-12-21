@extends('layouts.frontend')

@section('title', $plugin['name'] . ' - Features')

@section('content')
<style>
    :root {
        --hero-color: {{ $hero_color }};
        --hero-color-dark: {{ $hero_color_dark }};
        --hero-color-darker: {{ $hero_color_darker }};
        --feature-color: {{ $hero_color }}; /* Reuse hero color for consistency unless defined */
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
        background: rgba(139, 92, 246, 0.1); /* Fallback to purple tint */
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

    /* Additional Utilities */
    .marker-icon { color: var(--hero-color); }
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
                <a href="#overview" class="btn btn-hero" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: white; border: 1px solid rgba(255,255,255,0.4);">
                    Explore Modules
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Module Overview Grid -->
<section class="overview-section" id="overview">
    <div class="container">
        <div class="section-heading">
            <h2>The Ultimate WordPress Management Platform</h2>
            <p>12 Powerful Modules Combined in One Solution</p>
        </div>
        
        <div class="modules-grid">
            <a href="#core-dashboard" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <h3>Core Dashboard</h3>
                    <p>Central command center for managing all sites and monitoring health.</p>
                </div>
            </a>
            <a href="#security-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Security</h3>
                    <p>Comprehensive protection against threats and vulnerabilities.</p>
                </div>
            </a>
            <a href="#performance-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-rocket"></i></div>
                    <h3>Performance</h3>
                    <p>Advanced caching and optimization tools for lightning speed.</p>
                </div>
            </a>
            <a href="#seo-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-search"></i></div>
                    <h3>SEO</h3>
                    <p>Complete toolkit to improve search rankings and visibility.</p>
                </div>
            </a>
            <a href="#forms-leads-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-envelope-open-text"></i></div>
                    <h3>Forms & Leads</h3>
                    <p>Build custom forms and manage lead submissions easily.</p>
                </div>
            </a>
            <a href="#crm-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-address-book"></i></div>
                    <h3>CRM</h3>
                    <p>Manage client relationships and projects effectively.</p>
                </div>
            </a>
            <a href="#woocommerce-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-shopping-cart"></i></div>
                    <h3>WooCommerce</h3>
                    <p>Enhance your store with advanced management tools.</p>
                </div>
            </a>
            <a href="#marketing-automation-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-bullhorn"></i></div>
                    <h3>Marketing</h3>
                    <p>Automate workflows, popups, and email campaigns.</p>
                </div>
            </a>
            <a href="#backup-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <h3>Backup</h3>
                    <p>Secure cloud backups and one-click restoration.</p>
                </div>
            </a>
            <a href="#white-label-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-certificate"></i></div>
                    <h3>White Label</h3>
                    <p>Rebrand the admin interface for your clients.</p>
                </div>
            </a>
            <a href="#ai-assistant-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-robot"></i></div>
                    <h3>AI Assistant</h3>
                    <p>Content generation and SEO optimization using AI.</p>
                </div>
            </a>
            <a href="#developer-tools-module" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-code"></i></div>
                    <h3>Developer Tools</h3>
                    <p>Advanced tools for debugging and code management.</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Deep Dive Sections -->
<section class="detail-wrapper">
    <div class="container">
        <!-- Core Dashboard -->
        <div id="core-dashboard" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-tachometer-alt"></i></div>
                <h2 class="module-title-large">Core Dashboard</h2>
            </div>
            <p class="mb-4 text-muted">Central command center for managing all plugin modules and monitoring site health.</p>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-check-circle"></i> Unified Dashboard</h4>
                    <ul>
                        <li>Single-page overview of all modules</li>
                        <li>Quick access to all features</li>
                        <li>System health indicators</li>
                        <li>Activity feed</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-check-circle"></i> Module Management</h4>
                    <ul>
                        <li>Enable/disable modules independently</li>
                        <li>Module status indicators</li>
                        <li>Dependency checking</li>
                        <li>License-based feature gating</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-check-circle"></i> System Monitoring</h4>
                    <ul>
                        <li>Server information display</li>
                        <li>PHP & WordPress version check</li>
                        <li>Database status</li>
                        <li>Active plugins count</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Security Module -->
        <div id="security-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-shield-alt"></i></div>
                <h2 class="module-title-large">Security Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-lock"></i> Login Protection</h4>
                    <ul>
                        <li>Login attempt limiting</li>
                        <li>Automatic IP blocking</li>
                        <li>Configurable lockout duration</li>
                        <li>Whitelist trusted IPs</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-globe"></i> IP Management</h4>
                    <ul>
                        <li>Block/Whitelist specific IPs</li>
                        <li>Temporary IP blocks</li>
                        <li>IP block history</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-shield-virus"></i> Firewall & Hardening</h4>
                    <ul>
                        <li>XML-RPC Protection</li>
                        <li>Disable file editing</li>
                        <li>Custom security rules</li>
                        <li>Block suspicious requests</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Performance Module -->
        <div id="performance-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-rocket"></i></div>
                <h2 class="module-title-large">Performance Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-bolt"></i> Caching & Speed</h4>
                    <ul>
                        <li>Page & Object caching</li>
                        <li>Cache preloading</li>
                        <li>GZIP & Brotli compression</li>
                        <li>Minify HTML/CSS/JS</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-database"></i> Database Optimization</h4>
                    <ul>
                        <li>Cleanup scheduler</li>
                        <li>Remove spam & trash</li>
                        <li>Optimize tables</li>
                        <li>Clean transients</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-cog"></i> WordPress Tweaks</h4>
                    <ul>
                        <li>Disable emojis/embeds</li>
                        <li>Heartbeat API control</li>
                        <li>Browser caching headers</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- SEO Module -->
        <div id="seo-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-search"></i></div>
                <h2 class="module-title-large">SEO Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-tags"></i> Meta Data</h4>
                    <ul>
                        <li>Custom meta titles & descriptions</li>
                        <li>OpenGraph & Twitter Cards</li>
                        <li>Social preview</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-sitemap"></i> Indexing</h4>
                    <ul>
                        <li>Automatic XML Sitemaps</li>
                        <li>Robots.txt editor</li>
                        <li>Schema Markup (Organization, Product, FAQ)</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-chart-line"></i> Analysis</h4>
                    <ul>
                        <li>Content analysis</li>
                        <li>Keyword density check</li>
                        <li>404 Error monitoring</li>
                        <li>Readability scores</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Forms & Leads Module -->
        <div id="forms-leads-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-envelope-open-text"></i></div>
                <h2 class="module-title-large">Forms & Leads</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-edit"></i> Form Builder</h4>
                    <ul>
                        <li>Drag-and-drop builder</li>
                        <li>Conditional logic</li>
                        <li>Multiple field types</li>
                        <li>Custom styling</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-users"></i> Lead Management</h4>
                    <ul>
                        <li>Centralized submission storage</li>
                        <li>Lead status tracking</li>
                        <li>Export to CSV/Excel</li>
                        <li>Email notifications</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CRM Module -->
        <div id="crm-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-address-book"></i></div>
                <h2 class="module-title-large">CRM Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-user-tie"></i> Client Management</h4>
                    <ul>
                        <li>Client profiles & companies</li>
                        <li>Project tracking (Active, Completed)</li>
                        <li>Activity timeline</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-clipboard-list"></i> Productivity</h4>
                    <ul>
                        <li>Notes & Follow-ups</li>
                        <li>Reminders</li>
                        <li>Client & Project reports</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- WooCommerce Module -->
        <div id="woocommerce-module" class="module-deep-dive">
             <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-shopping-cart"></i></div>
                <h2 class="module-title-large">WooCommerce Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-chart-bar"></i> Analytics</h4>
                    <ul>
                        <li>Revenue & Order statistics</li>
                        <li>Sales trends</li>
                        <li>Customer analytics</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-box-open"></i> Management</h4>
                    <ul>
                        <li>Order & Stock management</li>
                        <li>Custom order statuses</li>
                        <li>Checkout field editor</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-plug"></i> Integrations</h4>
                    <ul>
                        <li>WhatsApp order alerts</li>
                        <li>EMI Calculator</li>
                        <li>Custom Thank You pages</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Marketing Automation -->
        <div id="marketing-automation-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-bullhorn"></i></div>
                <h2 class="module-title-large">Marketing Automation</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-cogs"></i> Workflows</h4>
                    <ul>
                        <li>Trigger-based automation</li>
                        <li>Conditional logic sequences</li>
                        <li>Performance analytics</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-comment-alt"></i> Campaigns</h4>
                    <ul>
                        <li>Popup builder (Modal, Slide-in)</li>
                        <li>Email & SMS campaigns</li>
                        <li>Floating CTA buttons</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Backup Module -->
        <div id="backup-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-cloud-upload-alt"></i></div>
                <h2 class="module-title-large">Backup Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-save"></i> Backup Options</h4>
                    <ul>
                        <li>Full site, Database, or Files-only</li>
                        <li>Scheduled variations (Daily, Weekly)</li>
                        <li>One-click restore</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-cloud"></i> Cloud Storage</h4>
                    <ul>
                        <li>Google Drive, Dropbox, OneDrive, S3</li>
                        <li>FTP/SFTP support</li>
                        <li>Auto-delete old backups</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- White Label Module -->
        <div id="white-label-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-certificate"></i></div>
                <h2 class="module-title-large">White Label Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-paint-brush"></i> Branding</h4>
                    <ul>
                        <li>Custom Login Page (Logo, Colors)</li>
                        <li>Admin Dashboard re-branding</li>
                        <li>Remove WordPress logos</li>
                        <li>Custom Menu management</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-eye-slash"></i> Visibility</h4>
                    <ul>
                        <li>Hide specific plugins</li>
                        <li>Hide dashboard widgets</li>
                        <li>Custom email notifications</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- AI Assistant Module -->
        <div id="ai-assistant-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-robot"></i></div>
                <h2 class="module-title-large">AI Assistant Module</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-pen-nib"></i> Content & SEO</h4>
                    <ul>
                        <li>Generate Blog posts & Product descriptions</li>
                        <li>SEO meta tag generation</li>
                        <li>Tone and language selection</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-code"></i> Developer AI</h4>
                    <ul>
                        <li>Code generator (PHP, JS, CSS)</li>
                        <li>Chat assistant (Context-aware)</li>
                        <li>AI Image generation</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-network-wired"></i> Providers</h4>
                    <ul>
                        <li>OpenAI (GPT), Anthropic (Claude), Google (Gemini)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Developer Tools Module -->
        <div id="developer-tools-module" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-code"></i></div>
                <h2 class="module-title-large">Developer Tools</h2>
            </div>
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-laptop-code"></i> Code Management</h4>
                    <ul>
                        <li>Snippet Manager (PHP/JS/CSS)</li>
                        <li>Custom Hooks manager</li>
                        <li>Custom Post Type generator</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-bug"></i> Debugging</h4>
                    <ul>
                        <li>Advanced Debug Logger</li>
                        <li>Database Query Tool</li>
                        <li>PHP Console</li>
                        <li>Error Log viewer</li>
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
            <h2>Simple Pricing, Unlimited Potential</h2>
            <p>Get access to all 12 modules with one simple subscription.</p>
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
                     <li><i class="fas fa-check-circle text-success mr-2"></i> All 12 Premium Modules</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Unlimited Sites Support</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Automatic Updates</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Priority Support</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> Cloud Backups Included</li>
                     <li><i class="fas fa-check-circle text-success mr-2"></i> White Labeling Included</li>
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
        const yearly = "{{ number_format($plugin['price_yearly'], 2) }}"; // Yearly price usually shown as total 
        const yearlyPerMonth = "{{ number_format($plugin['price_yearly'] / 12, 0) }}"; // or breakdown

        // Current controller logic seems to pass total yearly price. 
        // Let's assume we want to show the full price.
        
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
