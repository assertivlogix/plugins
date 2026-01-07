<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://www.assertivlogix.com/wp-content/uploads/2023/09/Fevicon-11.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = config('app.name', 'Assertivlogix');
        $defaultImage = asset('images/og-default.jpg');
    @endphp

    <!-- Primary Meta Tags -->
    @if(view()->hasSection('meta_title'))
    <title>@yield('meta_title')</title>
    <meta name="title" content="@yield('meta_title')">
    @else
    <title>{{ $siteName }} - @yield('title', 'Trusted WordPress Solutions')</title>
    <meta name="title" content="{{ $siteName }} - @yield('title', 'Trusted WordPress Solutions')">
    @endif
    <meta name="description" content="@yield('meta_description', 'Premium WordPress plugins for security, SEO, backup, performance, and more. Trusted by millions of website owners worldwide.')">
    <meta name="keywords" content="@yield('meta_keywords', 'WordPress plugins, security, SEO, backup, performance, WordPress tools')">
    <meta name="author" content="@yield('author', $siteName)">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    @if(view()->hasSection('og_title'))
    <meta property="og:title" content="@yield('og_title')">
    @elseif(view()->hasSection('meta_title'))
    <meta property="og:title" content="@yield('meta_title')">
    @else
    <meta property="og:title" content="{{ $siteName }} - @yield('title', 'Trusted WordPress Solutions')">
    @endif
    @if(view()->hasSection('og_description'))
    <meta property="og:description" content="@yield('og_description')">
    @else
    <meta property="og:description" content="@yield('meta_description', 'Premium WordPress plugins for security, SEO, backup, performance, and more. Trusted by millions of website owners worldwide.')">
    @endif
    <meta property="og:image" content="@yield('og_image', $defaultImage)">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:url" content="@yield('canonical_url', url()->current())">
    @if(view()->hasSection('twitter_title'))
    <meta name="twitter:title" content="@yield('twitter_title')">
    @elseif(view()->hasSection('meta_title'))
    <meta name="twitter:title" content="@yield('meta_title')">
    @else
    <meta name="twitter:title" content="{{ $siteName }} - @yield('title', 'Trusted WordPress Solutions')">
    @endif
    @if(view()->hasSection('twitter_description'))
    <meta name="twitter:description" content="@yield('twitter_description')">
    @else
    <meta name="twitter:description" content="@yield('meta_description', 'Premium WordPress plugins for security, SEO, backup, performance, and more. Trusted by millions of website owners worldwide.')">
    @endif
    @if(view()->hasSection('twitter_image'))
    <meta name="twitter:image" content="@yield('twitter_image')">
    @else
    <meta name="twitter:image" content="@yield('og_image', $defaultImage)">
    @endif
    @if(view()->hasSection('twitter_site'))
    <meta name="twitter:site" content="@yield('twitter_site')">
    @endif
    @if(view()->hasSection('twitter_creator'))
    <meta name="twitter:creator" content="@yield('twitter_creator')">
    @endif
    
    <!-- Additional SEO -->
    <meta name="theme-color" content="#2563eb">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Schema.org Structured Data -->
    @if(view()->hasSection('schema_json'))
    <script type="application/ld+json">
    @yield('schema_json')
    </script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS with Fallback -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <noscript>
        <link href="https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </noscript>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7H03Q03LSZ"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-7H03Q03LSZ');
    </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M9RB9R9T');</script>
    <!-- End Google Tag Manager -->
    <!-- Styles -->
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --bg-white: #ffffff;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-white);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: var(--bg-white);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            font-size: 1.8rem;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-toggle::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            border-top: none !important;
            margin-left: 0.5rem;
            font-size: 0.8rem;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--bg-white);
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border: none !important;
            border-top: none !important;
            border-radius: 8px;
            padding: 0.5rem 0;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1.5rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s;
            border: none !important;
            border-top: none !important;
            background: transparent;
            font-size: 0.95rem;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background: var(--bg-light);
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 0.5rem 0;
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: white;
            color: #7c3aed;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        .btn-primary:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-outline:hover {
            background: white;
            color: #7c3aed;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6rem 0;
            text-align: center;
        }

        /* Modern Hero Section */
        .hero-modern {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%);
            color: white;
            padding: 6rem 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .hero-icon {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* 3D Cube */
        .cube-3d {
            width: 200px;
            height: 200px;
            position: relative;
            transform-style: preserve-3d;
            animation: rotateCube 20s infinite linear;
        }

        .cube-face {
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .cube-front {
            transform: translateZ(100px);
            background: rgba(255, 255, 255, 0.15);
        }

        .cube-back {
            transform: rotateY(180deg) translateZ(100px);
            background: rgba(255, 255, 255, 0.1);
        }

        .cube-left {
            transform: rotateY(-90deg) translateZ(100px);
            background: rgba(255, 255, 255, 0.12);
        }

        .cube-right {
            transform: rotateY(90deg) translateZ(100px);
            background: rgba(255, 255, 255, 0.12);
        }

        .cube-top {
            transform: rotateX(90deg) translateZ(100px);
            background: rgba(255, 255, 255, 0.18);
        }

        .cube-bottom {
            transform: rotateX(-90deg) translateZ(100px);
            background: rgba(255, 255, 255, 0.08);
        }

        @keyframes rotateCube {
            0% {
                transform: rotateX(0deg) rotateY(0deg);
            }
            100% {
                transform: rotateX(360deg) rotateY(360deg);
            }
        }

        /* Statistics Section */
        .statistics {
            background: white;
            padding: 4rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #8b5cf6;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1.125rem;
            color: #6b7280;
            font-weight: 500;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: var(--bg-light);
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section-header p {
            font-size: 1.125rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: var(--bg-white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.07);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Plugins Section */
        .plugins {
            padding: 5rem 0;
        }

        .plugins-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .plugin-card {
            background: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .plugin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .plugin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }

        .plugin-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
        }

        .plugin-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .plugin-card p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .plugin-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Footer */
        footer {
            background: var(--text-dark);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h4 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section a {
            color: #94a3b8;
            text-decoration: none;
            display: block;
            padding: 0.25rem 0;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #334155;
            padding-top: 1rem;
            text-align: center;
            color: #94a3b8;
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-wrap: wrap;
            }

            nav ul {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--bg-white);
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }

            nav ul.active {
                display: flex;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.125rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .nav-actions {
                display: none;
                flex-direction: column;
                gap: 0.5rem;
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                padding: 1rem;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                z-index: 1000;
            }

            .nav-actions .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
                text-align: center;
                min-width: 120px;
            }

            .nav-actions .btn-outline {
                border: 2px solid #7c3aed;
                color: #7c3aed;
                background: transparent;
            }

            .nav-actions .btn-outline:hover {
                background: #7c3aed;
                color: white;
            }

            .nav-actions .btn-primary {
                background: #7c3aed;
                color: white;
                border: 2px solid #7c3aed;
            }

            .nav-actions .btn-primary:hover {
                background: #6d28d9;
                border-color: #6d28d9;
            }

            .nav-actions.active {
                display: flex;
            }

            /* Mobile Hero Layout */
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .hero-text p {
                font-size: 1.125rem;
            }

            .cube-3d {
                width: 150px;
                height: 150px;
            }

            .cube-face {
                width: 150px;
                height: 150px;
            }

            .cube-front {
                transform: translateZ(75px);
            }

            .cube-back {
                transform: rotateY(180deg) translateZ(75px);
            }

            .cube-left {
                transform: rotateY(-90deg) translateZ(75px);
            }

            .cube-right {
                transform: rotateY(90deg) translateZ(75px);
            }

            .cube-top {
                transform: rotateX(90deg) translateZ(75px);
            }

            .cube-bottom {
                transform: rotateX(-90deg) translateZ(75px);
            }

            /* Mobile Statistics */
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }

            .stat-item {
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-label {
                font-size: 1rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <?php /* <i class="fas fa-rocket"></i>
                    Assertivlogix */ ?>
                    <img src="https://www.assertivlogix.com/wp-content/uploads/2023/09/For-website-08-08.svg" alt="Assertivlogix" style="width: 200px; height: 68px;">
                </a>
                
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <nav>
                    <ul id="navMenu">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Plugins</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.index') }}">All Plugins</a></li>
                                @if(isset($menuPlugins))
                                    @foreach($menuPlugins as $plugin)
                                        <li><a class="dropdown-item" href="{{ route('products.show', $plugin->slug) }}">{{ $plugin->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li><a href="{{ route('pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('support.index') }}">Support</a></li>
                        <li><a href="{{ env('MAIN_WEBSITE')}}/blog/">Blog</a></li>
                    </ul>
                </nav>

                <div class="nav-actions">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('licenses') }}">
                                    <i class="fas fa-key me-2"></i> My Licenses
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user-cog me-2"></i> Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Products</h4>
                    <ul>
                        @if(isset($menuPlugins))
                            @foreach($menuPlugins as $plugin)
                                <li><a href="{{ route('products.show', $plugin->slug) }}">{{ $plugin->name }}</a></li>
                            @endforeach
                        @endif
                        <li><a href="{{ route('products.index') }}">All Plugins</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="{{ route('support.documentation') }}">Documentation</a></li>
                        <li><a href="{{ route('support.index') }}">Support Center</a></li>
                        <li><a href="{{ route('support.contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('support.forum') }}">Community Forum</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="{{ env('MAIN_WEBSITE')}}/about-us/">About Us</a></li>
                        <li><a href="{{ env('MAIN_WEBSITE')}}/blog/">Blog</a></li>
                        <?php /*<li><a href="#">Careers</a></li>
                        <li><a href="#">Privacy Policy</a></li> */ ?>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Assertivlogix. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            const navMenu = document.getElementById('navMenu');
            const navActions = document.querySelector('.nav-actions');
            
            navMenu.classList.toggle('active');
            navActions.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('navMenu');
            const navActions = document.querySelector('.nav-actions');
            const toggle = document.getElementById('mobileMenuToggle');
            
            if (!nav.contains(event.target) && !toggle.contains(event.target) && !navActions.contains(event.target)) {
                nav.classList.remove('active');
                navActions.classList.remove('active');
            }
        });
    </script>
    
    <!-- Bootstrap JS with Fallback and Error Handling -->
    <script>
        // Bootstrap loading with fallback
        (function() {
            // Try primary CDN first
            var script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
            // Integrity check removed to prevent blocking
            // script.integrity = 'sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4BQz';
            // script.crossOrigin = 'anonymous';
            script.async = true;
            
            script.onload = function() {
                console.log('Bootstrap loaded successfully from primary CDN');
                window.bootstrapLoaded = true;
            };
            
            script.onerror = function() {
                console.log('Primary Bootstrap CDN failed, trying fallback...');
                // Try fallback CDN
                var fallbackScript = document.createElement('script');
                fallbackScript.src = 'https://unpkg.com/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
                fallbackScript.async = true;
                
                fallbackScript.onload = function() {
                    console.log('Bootstrap loaded successfully from fallback CDN');
                    window.bootstrapLoaded = true;
                };
                
                fallbackScript.onerror = function() {
                    console.error('Both Bootstrap CDNs failed');
                    window.bootstrapLoaded = false;
                };
                
                document.head.appendChild(fallbackScript);
            };
            
            document.head.appendChild(script);
        })();
    </script>

    @stack('scripts')
</body>
</html>
