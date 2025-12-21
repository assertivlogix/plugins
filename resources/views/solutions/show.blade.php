@extends('layouts.frontend')

@section('title', $solution['name'] . ' - Assertivlogix')

@section('content')
<style>
    .solution-hero {
        background: linear-gradient(135deg, {{ $solution['hero_color'] }} 0%, {{ $solution['hero_color_dark'] }} 100%);
        color: white;
        padding: 5rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .solution-hero::before {
        content: '';
        position: absolute;
        top: 0; 
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect fill="none" width="100" height="100"/><path d="M0 100 L100 0" stroke="rgba(255,255,255,0.1)" stroke-width="2"/></svg>');
        opacity: 0.1;
    }

    .solution-icon-wrapper {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        backdrop-filter: blur(5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .solution-icon {
        font-size: 3rem;
        color: white;
    }

    .solution-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .solution-tagline {
        font-size: 1.5rem;
        font-weight: 300;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .info-section {
        padding: 5rem 0;
        background: white;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 4rem;
        align-items: center;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 2rem 0;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1.1rem;
        color: #4b5563;
    }

    .feature-list li i {
        color: {{ $solution['hero_color'] }};
        margin-right: 1rem;
        font-size: 1.25rem;
    }

    .value-card {
        background: #f9fafb;
        padding: 2rem;
        border-radius: 16px;
        border-left: 5px solid {{ $solution['hero_color'] }};
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s;
    }

    .value-card:hover {
        transform: translateY(-5px);
    }

    .cta-section {
        background: #f3f4f6;
        padding: 5rem 0;
        text-align: center;
    }

    .cta-button {
        display: inline-block;
        background: {{ $solution['hero_color'] }};
        color: white;
        padding: 1rem 3rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s;
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .cta-button:hover {
        background: {{ $solution['hero_color_dark'] }};
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        color: white;
    }
</style>

<div class="solution-hero">
    <div class="container">
        <div class="solution-icon-wrapper">
            <i class="{{ $solution['icon'] }} solution-icon"></i>
        </div>
        <h1 class="solution-title">{{ $solution['name'] }}</h1>
        <p class="solution-tagline">{{ $solution['tagline'] }}</p>
    </div>
</div>

<section class="info-section">
    <div class="container">
        <div class="info-grid">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1.5rem;">Why Choose Our {{ $solution['name'] }}?</h2>
                <p style="font-size: 1.125rem; color: #6b7280; line-height: 1.8;">
                    {{ $solution['description'] }}
                </p>
                
                <ul class="feature-list">
                    @foreach($solution['features'] as $feature)
                    <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
            
            <div class="value-prop">
                <h3 style="font-size: 1.5rem; font-weight: 700; color: #374151; margin-bottom: 1.5rem;">Key Benefits</h3>
                <div style="display: grid; gap: 1.5rem;">
                    @foreach($solution['benefits'] as $benefit)
                    <div class="value-card">
                        <h4 style="margin: 0; font-size: 1.1rem; color: #1f2937;">{{ $benefit }}</h4>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 800; color: #1f2937; margin-bottom: 1rem;">Ready to Get Started?</h2>
        <p style="font-size: 1.25rem; color: #6b7280; margin-bottom: 3rem;">Explore our premium plugins designed designed for {{ strtolower($solution['name']) }}.</p>
        
        @if(isset($solution['products']) && count($solution['products']) > 0)
            <a href="{{ route('products.show', $solution['products'][0]) }}" class="cta-button">View Solutions</a>
        @else
            <a href="{{ route('products.index') }}" class="cta-button">Browse All Products</a>
        @endif
    </div>
</section>

@endsection
