@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit WordPress Plugin: {{ $plugin->name }}</h4>
                        <a href="{{ route('admin.plugins.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Plugins
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.plugins.update', $plugin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Plugin Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Plugin Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                id="name" name="name" value="{{ old('name', $plugin->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="short_description" class="form-label">Short Description *</label>
                                            <input type="text" class="form-control @error('short_description') is-invalid @enderror" 
                                                id="short_description" name="short_description" 
                                                value="{{ old('short_description', $plugin->short_description) }}" required>
                                            <div class="form-text">A short description of your plugin, no more than 255 characters.</div>
                                            @error('short_description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Full Description *</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                id="description" name="description" rows="5" required>{{ old('description', $plugin->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="version" class="form-label">Version *</label>
                                                    <input type="text" class="form-control @error('version') is-invalid @enderror" 
                                                        id="version" name="version" value="{{ old('version', $plugin->version) }}" required>
                                                    @error('version')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="tested_up_to" class="form-label">Tested up to WordPress *</label>
                                                    <input type="text" class="form-control @error('tested_up_to') is-invalid @enderror" 
                                                        id="tested_up_to" name="tested_up_to" 
                                                        value="{{ old('tested_up_to', $plugin->tested_up_to) }}" required>
                                                    @error('tested_up_to')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="requires_php" class="form-label">Minimum PHP Version *</label>
                                                    <input type="text" class="form-control @error('requires_php') is-invalid @enderror" 
                                                        id="requires_php" name="requires_php" 
                                                        value="{{ old('requires_php', $plugin->requires_php) }}" required>
                                                    @error('requires_php')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="requires_wordpress" class="form-label">Minimum WordPress Version *</label>
                                                    <input type="text" class="form-control @error('requires_wordpress') is-invalid @enderror" 
                                                        id="requires_wordpress" name="requires_wordpress" 
                                                        value="{{ old('requires_wordpress', $plugin->requires_wordpress) }}" required>
                                                    @error('requires_wordpress')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="changelog" class="form-label">Changelog</label>
                                            <textarea class="form-control @error('changelog') is-invalid @enderror" 
                                                id="changelog" name="changelog" rows="4">{{ old('changelog', $plugin->changelog) }}</textarea>
                                            <div class="form-text">Use Markdown syntax for formatting.</div>
                                            @error('changelog')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Pricing</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="price_monthly" class="form-label">Monthly Price ($) *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" step="0.01" min="0" class="form-control @error('price_monthly') is-invalid @enderror" 
                                                            id="price_monthly" name="price_monthly" 
                                                            value="{{ old('price_monthly', $plugin->price_monthly) }}" required>
                                                    </div>
                                                    @error('price_monthly')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="price_yearly" class="form-label">Yearly Price ($) *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" step="0.01" min="0" class="form-control @error('price_yearly') is-invalid @enderror" 
                                                            id="price_yearly" name="price_yearly" 
                                                            value="{{ old('price_yearly', $plugin->price_yearly) }}" required>
                                                    </div>
                                                    @error('price_yearly')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="default_activation_limit" class="form-label">Default Activation Limit *</label>
                                                    <div class="input-group">
                                                        <input type="number" min="1" max="100" class="form-control @error('default_activation_limit') is-invalid @enderror" 
                                                            id="default_activation_limit" name="default_activation_limit" 
                                                            value="{{ old('default_activation_limit', $plugin->default_activation_limit ?? 1) }}" required>
                                                        <span class="input-group-text">sites</span>
                                                    </div>
                                                    <div class="form-text">Maximum sites per license</div>
                                                    @error('default_activation_limit')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Plugin Files</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="plugin_file" class="form-label">Plugin ZIP File</label>
                                            <input type="file" class="form-control @error('plugin_file') is-invalid @enderror" 
                                                id="plugin_file" name="plugin_file" accept=".zip">
                                            <div class="form-text">
                                                @if($plugin->file_path)
                                                    Current file: {{ basename($plugin->file_path) }}<br>
                                                @endif
                                                Upload a new ZIP file to update the plugin (max 10MB).
                                            </div>
                                            @error('plugin_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">URLs</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="documentation_url" class="form-label">Documentation URL</label>
                                            <input type="url" class="form-control @error('documentation_url') is-invalid @enderror" 
                                                id="documentation_url" name="documentation_url" 
                                                value="{{ old('documentation_url', $plugin->documentation_url) }}">
                                            @error('documentation_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="github_url" class="form-label">GitHub Repository URL</label>
                                            <input type="url" class="form-control @error('github_url') is-invalid @enderror" 
                                                id="github_url" name="github_url" 
                                                value="{{ old('github_url', $plugin->github_url) }}">
                                            @error('github_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-0">
                                            <label for="support_url" class="form-label">Support URL</label>
                                            <input type="url" class="form-control @error('support_url') is-invalid @enderror" 
                                                id="support_url" name="support_url" 
                                                value="{{ old('support_url', $plugin->support_url) }}">
                                            @error('support_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Publish</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="is_active" 
                                                    name="is_active" value="1" {{ old('is_active', $plugin->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">Active</label>
                                            </div>
                                            <div class="form-text">Set plugin status to active or inactive.</div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Update Plugin
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Plugin Images</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="banner_image" class="form-label">Banner Image</label>
                                            @if($plugin->banner_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $plugin->banner_image) }}" 
                                                        alt="{{ $plugin->name }} Banner" class="img-fluid rounded">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control @error('banner_image') is-invalid @enderror" 
                                                id="banner_image" name="banner_image" accept="image/*">
                                            <div class="form-text">Recommended size: 1200x600px</div>
                                            @error('banner_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-0">
                                            <label for="icon_image" class="form-label">Icon Image</label>
                                            @if($plugin->icon_image)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $plugin->icon_image) }}" 
                                                        alt="{{ $plugin->name }} Icon" class="img-thumbnail" style="width: 100px;">
                                                </div>
                                            @endif
                                            <input type="file" class="form-control @error('icon_image') is-invalid @enderror" 
                                                id="icon_image" name="icon_image" accept="image/*">
                                            <div class="form-text">Recommended size: 256x256px</div>
                                            @error('icon_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any client-side validation or interactions
    });
</script>
@endpush
@endsection
