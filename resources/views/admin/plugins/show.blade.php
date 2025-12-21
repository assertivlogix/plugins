@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $plugin->name }}</h4>
                        <div>
                            <a href="{{ route('admin.plugins.edit', $plugin->id) }}" class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.plugins.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to Plugins
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if($plugin->banner_image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $plugin->banner_image) }}" 
                                         alt="{{ $plugin->name }} Banner" 
                                         class="img-fluid rounded">
                                </div>
                            @endif

                            <div class="d-flex align-items-center mb-4">
                                @if($plugin->icon_image)
                                    <img src="{{ asset('storage/' . $plugin->icon_image) }}" 
                                         alt="{{ $plugin->name }} Icon" 
                                         class="img-thumbnail me-3" 
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                                <div>
                                    <h2 class="mb-1">{{ $plugin->name }}</h2>
                                    <p class="text-muted mb-1">Version {{ $plugin->version }}</p>
                                    <span class="badge bg-{{ $plugin->is_active ? 'success' : 'secondary' }}">
                                        {{ $plugin->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Description</h5>
                                </div>
                                <div class="card-body">
                                    <p class="lead">{{ $plugin->short_description }}</p>
                                    <div class="plugin-description">
                                        {!! nl2br(e($plugin->description)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="mb-0">Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                <li class="mb-2">
                                                    <strong>Version:</strong> {{ $plugin->version }}
                                                </li>
                                                <li class="mb-2">
                                                    <strong>Last Updated:</strong> {{ $plugin->updated_at->format('M d, Y') }}
                                                </li>
                                                <li class="mb-2">
                                                    <strong>WordPress:</strong> {{ $plugin->requires_wordpress }}+ (Tested up to {{ $plugin->tested_up_to }})
                                                </li>
                                                <li class="mb-2">
                                                    <strong>PHP:</strong> {{ $plugin->requires_php }}+ required
                                                </li>
                                                @if($plugin->file_path)
                                                    <li class="mb-2">
                                                        <strong>File:</strong> {{ basename($plugin->file_path) }}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5 class="mb-0">Pricing</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="pricing-option mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="mb-0">Monthly</h5>
                                                        <small class="text-muted">Billed monthly</small>
                                                    </div>
                                                    <h4 class="mb-0">${{ number_format($plugin->price_monthly, 2) }}</h4>
                                                </div>
                                            </div>
                                            <div class="pricing-option">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h5 class="mb-0">Yearly</h5>
                                                        <small class="text-muted">Billed annually (Save {{ round((1 - ($plugin->price_yearly / ($plugin->price_monthly * 12))) * 100) }}%)</small>
                                                    </div>
                                                    <h4 class="mb-0">${{ number_format($plugin->price_yearly, 2) }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($plugin->changelog)
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Changelog</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="changelog">
                                            {!! nl2br(e($plugin->changelog)) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.plugins.edit', $plugin->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit me-1"></i> Edit Plugin
                                        </a>
                                        <a href="#" class="btn btn-outline-secondary">
                                            <i class="fas fa-download me-1"></i> Download Plugin
                                        </a>
                                        <form action="{{ route('admin.plugins.destroy', $plugin->id) }}" method="POST" class="d-grid">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this plugin?')">
                                                <i class="fas fa-trash me-1"></i> Delete Plugin
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Plugin Information</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <strong>Status:</strong>
                                            <span class="badge bg-{{ $plugin->is_active ? 'success' : 'secondary' }}">
                                                {{ $plugin->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </li>
                                        <li class="mb-2">
                                            <strong>Created:</strong> {{ $plugin->created_at->format('M d, Y') }}
                                        </li>
                                        <li class="mb-2">
                                            <strong>Last Updated:</strong> {{ $plugin->updated_at->format('M d, Y') }}
                                        </li>
                                        @if($plugin->file_path)
                                            <li class="mb-2">
                                                <strong>File Size:</strong> 
                                                {{ number_format(Storage::disk('public')->size($plugin->file_path) / 1024, 2) }} KB
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Links</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        @if($plugin->documentation_url)
                                            <li class="mb-2">
                                                <a href="{{ $plugin->documentation_url }}" target="_blank" class="text-decoration-none">
                                                    <i class="fas fa-book me-2"></i> Documentation
                                                </a>
                                            </li>
                                        @endif
                                        @if($plugin->github_url)
                                            <li class="mb-2">
                                                <a href="{{ $plugin->github_url }}" target="_blank" class="text-decoration-none">
                                                    <i class="fab fa-github me-2"></i> GitHub Repository
                                                </a>
                                            </li>
                                        @endif
                                        @if($plugin->support_url)
                                            <li>
                                                <a href="{{ $plugin->support_url }}" target="_blank" class="text-decoration-none">
                                                    <i class="fas fa-question-circle me-2"></i> Get Support
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .plugin-description {
        line-height: 1.6;
    }
    .plugin-description p:last-child {
        margin-bottom: 0;
    }
    .changelog {
        font-family: monospace;
        white-space: pre-line;
        line-height: 1.6;
    }
    .pricing-option {
        padding: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
    }
    .pricing-option:last-child {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any client-side interactions here
    });
</script>
@endpush
@endsection
