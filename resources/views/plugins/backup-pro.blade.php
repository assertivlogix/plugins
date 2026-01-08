@extends('layouts.frontend')

@section('title', $plugin['name'] . ' - Features')

@section('content')
<style>
    :root {
        --hero-color: #8b5cf6;
        --hero-color-dark: #034f61;
        --hero-color-darker: #6d28d9;
        --feature-color: #8b5cf6;
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
        background: rgba(139, 92, 246, 0.1); 
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
        scroll-margin-top: 100px;
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
    
    .badge-features {
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-weight: 600;
        margin-left: auto;
    }
    
    .badge-core { background: #dbeafe; color: #1e40af; }
    .badge-premium { background: #fef3c7; color: #92400e; }
    .badge-security { background: #fee2e2; color: #991b1b; }

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

    /* Code block for file structure */
    .file-structure-block {
        background: #1e293b;
        color: #e2e8f0;
        padding: 2rem;
        border-radius: 12px;
        overflow-x: auto;
        font-family: 'Fira Code', monospace;
        font-size: 0.9rem;
        line-height: 1.6;
    }
    
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
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
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
            <p class="plugin-tagline">
                {{ $plugin['tagline'] }}
                <br>
                <span style="font-size: 0.9rem; opacity: 0.95; margin-top: 0.8rem; display: inline-block; font-weight: 500;">
                    <i class="fas fa-check-circle"></i> Free version available with essential features
                </span>
            </p>
            
            <div class="hero-actions">
                <a href="#pricing" class="btn btn-hero btn-hero-primary">Get Pro Version</a>

                @if(!empty($plugin['file_path']))
                <a href="{{ route('products.download', $plugin['slug']) }}" class="btn btn-hero" style="background: rgba(255,255,255,0.15); backdrop-filter: blur(5px); color: white; border: 1px solid rgba(255,255,255,0.6);">
                    <i class="fas fa-download me-2"></i> Download Free
                </a>
                @endif

                <a href="#features" class="btn btn-hero" style="background: transparent; color: rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);">
                    Explore Features
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Overview Grid -->
<section class="overview-section" id="features">
    <div class="container">
        <div class="section-heading">
            <h2>Professional Backup & Migration Solution</h2>
            <p>Comprehensive protection for your WordPress websites</p>
        </div>
        
        <div class="modules-grid">
            <a href="#core-features" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-cube"></i></div>
                    <h3>Core Features</h3>
                    <p>Manual and automated backups, restore functionality, and migration tools included for free.</p>
                </div>
            </a>
            <a href="#premium-features" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-crown"></i></div>
                    <h3>Premium Features</h3>
                    <p>Site-to-site migration, cloud storage integration (Google Drive, Dropbox, S3), and advanced scheduling.</p>
                </div>
            </a>
            <a href="#security-features" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Security Features</h3>
                    <p>Nonce verification, file path validation, and encrypted credentials to keep your data safe.</p>
                </div>
            </a>
            <a href="#technical-specs" class="module-card-link">
                <div class="module-card">
                    <div class="module-icon"><i class="fas fa-cogs"></i></div>
                    <h3>Technical Specs</h3>
                    <p>Built with modern PHP standards, WP-CLI support, and optimized for performance.</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Detailed Content -->
<section class="detail-wrapper">
    <div class="container">
        
        <!-- Core Features -->
        <div id="core-features" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-cube"></i></div>
                <h2 class="module-title-large">Core Features</h2>
                <span class="badge-features badge-core">FREE</span>
            </div>
            
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-save"></i> Backup & Restore</h4>
                    <ul>
                        <li><strong>Manual Backups:</strong> Create full site backups (files + database) with one click</li>
                        <li><strong>Full Site Backup:</strong> Includes wp-content directory and complete database dump</li>
                        <li><strong>Backup Management:</strong> View, download, restore, and delete backups</li>
                        <li><strong>Backup List:</strong> Comprehensive list with file size and creation date</li>
                        <li><strong>Backup Protection:</strong> .htaccess and index.php prevent direct access</li>
                        <li><strong>Auto Directory:</strong> Backups stored securely in uploads directory</li>
                    </ul>
                </div>
                
                <div class="feature-group">
                    <h4><i class="fas fa-clock"></i> Scheduled Backups</h4>
                    <ul>
                        <li><strong>Automated Backups:</strong> Set up automated backups with customizable intervals</li>
                        <li><strong>Schedule Options:</strong> Hourly, Daily, Weekly, Monthly schedules</li>
                        <li><strong>WP-Cron:</strong> Uses WordPress cron system for reliability</li>
                        <li><strong>Management:</strong> Enable/disable and modify schedules easily</li>
                    </ul>
                </div>
                
                <div class="feature-group">
                    <h4><i class="fas fa-exchange-alt"></i> Migration Tools</h4>
                    <ul>
                        <li><strong>Basic Migration:</strong> Upload and restore backup files to migrate sites</li>
                        <li><strong>Search & Replace:</strong> Built-in search and replace for URLs and content</li>
                        <li><strong>Migration Cleanup:</strong> Clean up temporary files after migration</li>
                        <li><strong>Database Migration:</strong> Complete database export and import</li>
                    </ul>
                </div>
                
                <div class="feature-group">
                    <h4><i class="fas fa-laptop"></i> User Interface</h4>
                    <ul>
                        <li><strong>Premium Design:</strong> Modern, card-based UI with Inter font</li>
                        <li><strong>Notifications:</strong> Non-intrusive success/error toast messages</li>
                        <li><strong>Responsive:</strong> Works on desktop and mobile devices</li>
                        <li><strong>Dashboard Stats:</strong> Overview cards showing backup statistics</li>
                    </ul>
                </div>

                <div class="feature-group">
                    <h4><i class="fas fa-sliders-h"></i> Settings</h4>
                    <ul>
                        <li><strong>Auto-backup:</strong> Option to backup automatically before WP updates</li>
                        <li><strong>GDPR:</strong> Data anonymization option included</li>
                        <li><strong>Encryption:</strong> Option to encrypt database backups</li>
                        <li><strong>Persistent:</strong> All settings saved to WordPress options</li>
                    </ul>
                </div>
                
                 <div class="feature-group">
                    <h4><i class="fas fa-terminal"></i> Technical</h4>
                    <ul>
                        <li><strong>WP-CLI:</strong> Command-line interface for backups, list, and restore</li>
                        <li><strong>AJAX-Powered:</strong> Smooth user experience without page reloads</li>
                        <li><strong>Windows Compatible:</strong> Path normalization for Windows environments</li>
                        <li><strong>Namespace Autoloading:</strong> Modern PHP structure</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Premium Features -->
        <div id="premium-features" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-crown"></i></div>
                <h2 class="module-title-large">Premium Features</h2>
                 <span class="badge-features badge-premium">PRO</span>
            </div>
            
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-network-wired"></i> Direct Site-to-Site Migration</h4>
                    <ul>
                        <li><strong>Link Sites:</strong> Connect two WordPress sites securely via API keys</li>
                        <li><strong>Instant Migration:</strong> Migrate backups directly between linked sites</li>
                        <li><strong>Bi-directional:</strong> Migrate from source to destination site</li>
                        <li><strong>REST API:</strong> Custom endpoints for remote access</li>
                    </ul>
                </div>
                
                <div class="feature-group">
                    <h4><i class="fas fa-cloud-upload-alt"></i> Cloud Storage Integration</h4>
                    <ul>
                        <li><strong>Providers:</strong> Google Drive, Dropbox, Amazon S3, OneDrive</li>
                        <li><strong>Multiple Providers:</strong> Connect to multiple simultaneously</li>
                        <li><strong>Auto-Upload:</strong> Upload immediately after backup creation</li>
                        <li><strong>Selective Upload:</strong> Choose which providers receive backups</li>
                    </ul>
                </div>
                
                 <div class="feature-group">
                    <h4><i class="fas fa-cog"></i> Cloud Settings</h4>
                    <ul>
                        <li><strong>Retention Policy:</strong> Configure how long to keep backups in cloud (1-365 days)</li>
                        <li><strong>Delete Local:</strong> Save disk space by removing local backups after upload</li>
                        <li><strong>Compress:</strong> Compress backups before uploading</li>
                        <li><strong>Failure Alerts:</strong> Email notifications on upload failure</li>
                    </ul>
                </div>
                
                <div class="feature-group">
                    <h4><i class="fas fa-calendar-alt"></i> Advanced Scheduling</h4>
                    <ul>
                        <li><strong>Custom Retention:</strong> Define specific policies for Daily, Weekly, Monthly backups</li>
                        <li><strong>Fine-tuning:</strong> Advanced options for scheduling behavior</li>
                        <li><strong>Flexible:</strong> Configure how many backups to keep</li>
                    </ul>
                </div>
                
                 <div class="feature-group">
                    <h4><i class="fas fa-filter"></i> Selective Backup & Migration</h4>
                    <ul>
                        <li><strong>Components:</strong> Choose specific components (Plugins, Themes, DB) to backup</li>
                        <li><strong>Plugin/Theme Select:</strong> Include/exclude specific plugins or themes</li>
                        <li><strong>Uploads:</strong> Option to include/exclude uploads folder</li>
                        <li><strong>Flexible:</strong> Mix and match components for custom backups</li>
                    </ul>
                </div>

                <div class="feature-group">
                    <h4><i class="fas fa-sitemap"></i> Multisite Support</h4>
                    <ul>
                         <li><strong>Network Migration:</strong> Migrate single sites into multisite networks</li>
                         <li><strong>Domain Management:</strong> Configure new site domains during migration</li>
                         <li><strong>Seamless Integration:</strong> Works natively with WP Multisite</li>
                    </ul>
                </div>

                <div class="feature-group">
                    <h4><i class="fas fa-key"></i> API Management</h4>
                    <ul>
                        <li><strong>Secure Keys:</strong> Automatic generation of secure API keys</li>
                        <li><strong>Key Management:</strong> View, regenerate, and copy keys easily</li>
                        <li><strong>Authentication:</strong> API key-based authentication for site linking</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Security Features -->
        <div id="security-features" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-shield-alt"></i></div>
                <h2 class="module-title-large">Security Architecture</h2>
                 <span class="badge-features badge-security">CORE</span>
            </div>
            
            <div class="feature-list-grid">
                <div class="feature-group">
                    <h4><i class="fas fa-check-double"></i> Verification</h4>
                    <ul>
                        <li><strong>Nonce Security:</strong> All AJAX requests verified with WordPress nonces</li>
                        <li><strong>Capability Checks:</strong> Only administrators can perform sensitive operations</li>
                         <li><strong>Sanitization:</strong> All user inputs sanitized and validated</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-file-shield"></i> Data Protection</h4>
                    <ul>
                         <li><strong>Path Validation:</strong> Secure validation prevents directory traversal</li>
                         <li><strong>Encryption:</strong> Cloud credentials encrypted before storage</li>
                         <li><strong>File Protection:</strong> .htaccess protection for backup directories</li>
                    </ul>
                </div>
            </div>
        </div>

         <!-- Technical Specs & File Structure -->
        <div id="technical-specs" class="module-deep-dive">
            <div class="module-header">
                <div class="module-icon" style="margin-bottom: 0; width: 50px; height: 50px;"><i class="fas fa-code"></i></div>
                <h2 class="module-title-large">Technical Specifications & Integration</h2>
            </div>
            
            <div class="feature-list-grid" style="margin-bottom: 2rem;">
                <div class="feature-group">
                    <h4><i class="fas fa-server"></i> System Requirements</h4>
                    <ul>
                        <li><strong>PHP Version:</strong> PHP 7.4+ Compatible</li>
                        <li><strong>WordPress:</strong> WordPress 5.0+ Compatible</li>
                        <li><strong>Database:</strong> Uses WordPress Options API</li>
                        <li><strong>FileSystem:</strong> Uses WordPress File System API</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-plug"></i> Integrations</h4>
                    <ul>
                        <li><strong>Hooks:</strong> Plugin hooks for extensibility</li>
                        <li><strong>REST API:</strong> Custom endpoints provided</li>
                        <li><strong>WP-CLI:</strong> Full command-line support</li>
                        <li><strong>Actions:</strong> `assertivlogix_backup_completed` hook available</li>
                    </ul>
                </div>
                <div class="feature-group">
                    <h4><i class="fas fa-user-circle"></i> User Experience</h4>
                    <ul>
                        <li><strong>Loading States:</strong> Visual feedback during operations</li>
                        <li><strong>Progress:</strong> Clear indication of operation progress</li>
                        <li><strong>Modals:</strong> Intuitive modal dialogs for complex tasks</li>
                        <li><strong>Accessibility:</strong> Keyboard shortcuts support</li>
                    </ul>
                </div>

                <div class="feature-group">
                    <h4><i class="fas fa-id-card"></i> License & Activation</h4>
                    <ul>
                        <li><strong>Management:</strong> Secure license key validation and management</li>
                         <li><strong>Remote Check:</strong> Validate licenses with remote server</li>
                         <li><strong>Status:</strong> Clear indication of license status and expiration</li>
                         <li><strong>Feature Gating:</strong> Premium features locked behind validation</li>
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
            <h2>Simple Pricing for Peace of Mind</h2>
            <p>Secure your WordPress sites with professional backup tools.</p>
        </div>

        <div class="pricing-toggle">
            <button class="toggle-btn active" onclick="switchPrice('monthly', this)">Monthly</button>
            <button class="toggle-btn" onclick="switchPrice('yearly', this)">Yearly (Save 20%)</button>
        </div>

        <div class="card" style="max-width: 600px; margin: 0 auto; border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="h2 mb-3">{{ $plugin['name'] }}</h3>
                    <div class="price-display">
                        <span class="currency h3">$</span>
                        <span class="amount h1 fw-bold">{{ $plugin['price_monthly'] }}</span>
                        <span class="period text-muted">/month</span>
                    </div>
                    <div class="price-yearly d-none">
                        <span class="currency h3">$</span>
                        <span class="amount h1 fw-bold">{{ $plugin['price_yearly'] }}</span>
                        <span class="period text-muted">/year</span>
                    </div>
                </div>
                
                <div class="d-grid gap-3 mb-5">
                    <a href="{{ route('checkout.create', $plugin['slug']) }}" class="btn btn-primary btn-lg" style="background: var(--hero-color); border-color: var(--hero-color);">
                        Subscribe Now
                    </a>
                </div>
                
                <div class="features-list">
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check text-success me-3"></i> Unlimited Backups
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check text-success me-3"></i> Cloud Storage Integration
                        </li>
                         <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check text-success me-3"></i> Site-to-Site Migration
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check text-success me-3"></i> Premium Support
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function switchPrice(period, btn) {
        document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        if (period === 'monthly') {
            document.querySelector('.price-display').classList.remove('d-none');
            document.querySelector('.price-yearly').classList.add('d-none');
        } else {
            document.querySelector('.price-display').classList.add('d-none');
            document.querySelector('.price-yearly').classList.remove('d-none');
        }
    }
</script>
@endsection
