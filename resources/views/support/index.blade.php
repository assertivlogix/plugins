@extends('layouts.frontend')

@section('title', 'Support Center - Assertivlogix')

@section('content')
<div class="support-hero">
    <div class="container text-center">
        <h1 class="mb-4">How can we help you?</h1>
        <p class="lead mb-5 text-white-50">Search our knowledge base or browse help topics below</p>
        
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="form-control form-control-lg" placeholder="Search for answers...">
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <a href="{{ route('support.documentation') }}" class="card h-100 support-card text-decoration-none">
                <div class="card-body text-center p-5">
                    <div class="icon-wrapper mb-4">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="h4 text-dark mb-3">Documentation</h3>
                    <p class="text-muted">Detailed guides and API references for all our plugins.</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('support.forum') }}" class="card h-100 support-card text-decoration-none">
                <div class="card-body text-center p-5">
                    <div class="icon-wrapper mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="h4 text-dark mb-3">Community Forum</h3>
                    <p class="text-muted">Join the discussion, ask questions, and share tips.</p>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('support.contact') }}" class="card h-100 support-card text-decoration-none">
                <div class="card-body text-center p-5">
                    <div class="icon-wrapper mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="h4 text-dark mb-3">Contact Support</h3>
                    <p class="text-muted">Get help from our dedicated support team 24/7.</p>
                </div>
            </a>
        </div>
    </div>

    <h2 class="text-center mb-5">Popular Topics</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-primary mb-3"><i class="fas fa-shield-alt me-2"></i> Security Pro</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">How to configure the firewall?</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Setting up Two-Factor Authentication</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Scanning for malware</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title text-success mb-3"><i class="fas fa-search me-2"></i> SEO Pro</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Optimizing meta tags</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Generating XML Sitemaps</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Connecting to Google Search Console</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.support-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    padding: 5rem 0;
    color: white;
}

.search-box {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
}

.search-box input {
    padding-left: 3rem;
    border-radius: 50px;
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.search-icon {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.support-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}

.support-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: #eff6ff;
    color: #3b82f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto;
}
</style>
@endsection
