@extends('layouts.frontend')

@section('title', 'My Profile')

@section('content')
<style>
.profile-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
    min-height: 100vh;
}

.page-header {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.page-header h1 {
    color: #2c3e50;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.page-header p {
    color: #6c757d;
    font-size: 16px;
    margin: 0;
}

.content-layout {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 30px;
}

.main-content {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.profile-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header-custom {
    background: #f8f9fa;
    padding: 20px 25px;
    border-bottom: 1px solid #dee2e6;
}

.card-header-custom h5 {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.card-body-custom {
    padding: 30px;
}

.alert-success-custom {
    background: #d4edda;
    color: #155724;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    display: flex;
    align-items: center;
    gap: 8px;
}

.alert-success-custom i {
    color: #155724;
    font-size: 18px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    color: #2c3e50;
    font-weight: 500;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control-custom {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    background: white;
}

.form-control-custom:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-select-custom {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    background: white;
    cursor: pointer;
}

.form-select-custom:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f1f3f4;
}

.btn-primary-custom {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s ease;
}

.btn-primary-custom:hover {
    background: #0056b3;
    color: white;
}

.btn-danger-custom {
    background: transparent;
    color: #dc3545;
    border: 1px solid #dc3545;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.btn-danger-custom:hover {
    background: #dc3545;
    color: white;
}

.sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.sidebar-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.sidebar-card-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
}

.sidebar-card-title {
    color: #2c3e50;
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.sidebar-card-body {
    padding: 20px;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    color: #6c757d;
    font-size: 14px;
}

.stat-value {
    color: #2c3e50;
    font-weight: 600;
    font-size: 14px;
}

.badge-success {
    background: #28a745;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.preference-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.preference-item:last-child {
    border-bottom: none;
}

.communication-preferences {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
}

.communication-preferences .preference-item {
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}

.communication-preferences .preference-item:last-child {
    border-bottom: none;
}

.preference-label {
    color: #2c3e50;
    font-size: 14px;
    font-weight: 500;
}

.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #007bff;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.quick-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    text-decoration: none;
    color: #495057;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s ease;
}

.quick-link:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

.quick-link i {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

.section-title {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 600;
    margin: 25px 0 15px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #007bff;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title:first-of-type {
    margin-top: 20px;
}

@media (max-width: 968px) {
    .content-layout {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .profile-container {
        padding: 15px;
    }
    
    .page-header h1 {
        font-size: 24px;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .btn-primary-custom,
    .btn-danger-custom {
        justify-content: center;
    }
}
</style>

<div class="profile-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>My Profile</h1>
        <p>Manage your account information and preferences.</p>
    </div>

    <!-- Content Layout -->
    <div class="content-layout">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Account Information -->
            <div class="profile-card">
                <div class="card-header-custom">
                    <h5>Account Information</h5>
                </div>
                <div class="card-body-custom">
                    @if(session('success'))
                        <div class="alert-success-custom">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert-danger-custom">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert-danger-custom">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                @foreach($errors->all() as $error)
                                    <span>{{ $error }}</span>
                                    @if(!$loop->last)<br>@endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control-custom" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control-custom" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control-custom" id="bio" name="bio" rows="4" placeholder="Tell us about yourself">{{ $user->bio ?? '' }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control-custom" id="website" name="website" value="{{ $user->website ?? '' }}" placeholder="https://yourwebsite.com">
                        </div>
                        
                        <h6 class="section-title">Address Information</h6>
                        
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control-custom" id="address" name="address" value="{{ $user->address ?? '' }}" placeholder="Street address">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control-custom" id="city" name="city" value="{{ $user->city ?? '' }}" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="state" class="form-label">State/Province</label>
                                <input type="text" class="form-control-custom" id="state" name="state" value="{{ $user->state ?? '' }}" placeholder="State or province">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select-custom" id="country" name="country">
                                    <option value="">Select Country</option>
                                    <option value="US" {{ $user->country === 'US' ? 'selected' : '' }}>United States</option>
                                    <option value="CA" {{ $user->country === 'CA' ? 'selected' : '' }}>Canada</option>
                                    <option value="UK" {{ $user->country === 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="AU" {{ $user->country === 'AU' ? 'selected' : '' }}>Australia</option>
                                    <option value="DE" {{ $user->country === 'DE' ? 'selected' : '' }}>Germany</option>
                                    <option value="FR" {{ $user->country === 'FR' ? 'selected' : '' }}>France</option>
                                    <option value="IN" {{ $user->country === 'IN' ? 'selected' : '' }}>India</option>
                                    <option value="JP" {{ $user->country === 'JP' ? 'selected' : '' }}>Japan</option>
                                    <option value="CN" {{ $user->country === 'CN' ? 'selected' : '' }}>China</option>
                                    <option value="BR" {{ $user->country === 'BR' ? 'selected' : '' }}>Brazil</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control-custom" id="postal_code" name="postal_code" value="{{ $user->postal_code ?? '' }}" placeholder="ZIP/Postal code">
                            </div>
                        </div>
                        
                        <h6 class="section-title">Social Media</h6>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control-custom" id="linkedin" name="linkedin" value="{{ $user->linkedin ?? '' }}" placeholder="LinkedIn profile URL">
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control-custom" id="twitter" name="twitter" value="{{ $user->twitter ?? '' }}" placeholder="Twitter handle">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control-custom" id="facebook" name="facebook" value="{{ $user->facebook ?? '' }}" placeholder="Facebook profile URL">
                            </div>
                            <div class="form-group">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control-custom" id="instagram" name="instagram" value="{{ $user->instagram ?? '' }}" placeholder="Instagram handle">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company" class="form-label">Company (Optional)</label>
                            <input type="text" class="form-control-custom" id="company" name="company" value="{{ $user->company ?? '' }}" placeholder="Your company name">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone (Optional)</label>
                                <input type="tel" class="form-control-custom" id="phone" name="phone" value="{{ $user->phone ?? '' }}" placeholder="Your phone number">
                            </div>
                            <div class="form-group">
                                <label for="timezone" class="form-label">Timezone</label>
                                <select class="form-select-custom" id="timezone" name="timezone">
                                    <option value="UTC" {{ $user->timezone === 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York" {{ $user->timezone === 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                    <option value="America/Chicago" {{ $user->timezone === 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                    <option value="America/Denver" {{ $user->timezone === 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                    <option value="America/Los_Angeles" {{ $user->timezone === 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                    <option value="Europe/London" {{ $user->timezone === 'Europe/London' ? 'selected' : '' }}>London</option>
                                    <option value="Europe/Paris" {{ $user->timezone === 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                    <option value="Asia/Tokyo" {{ $user->timezone === 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Communication Preferences -->
                        <h6 class="section-title">Communication Preferences</h6>
                        <div class="communication-preferences">
                            <div class="preference-item">
                                <span class="preference-label">Email Notifications</span>
                                <label class="switch">
                                    <input type="hidden" name="email_notifications" value="0">
                                    <input type="checkbox" id="email_notifications" name="email_notifications" value="1" {{ $user->email_notifications ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <span class="preference-label">Security Alerts</span>
                                <label class="switch">
                                    <input type="hidden" name="security_alerts" value="0">
                                    <input type="checkbox" id="security_alerts" name="security_alerts" value="1" {{ $user->security_alerts ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <span class="preference-label">Marketing Emails</span>
                                <label class="switch">
                                    <input type="hidden" name="marketing_emails" value="0">
                                    <input type="checkbox" id="marketing_emails" name="marketing_emails" value="1" {{ $user->marketing_emails ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <span class="preference-label">Product Updates</span>
                                <label class="switch">
                                    <input type="hidden" name="product_updates" value="0">
                                    <input type="checkbox" id="product_updates" name="product_updates" value="1" {{ $user->product_updates ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                            <a href="#" class="btn-danger-custom">
                                <i class="fas fa-trash"></i> Delete Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="profile-card">
                <div class="card-header-custom">
                    <h5>Change Password</h5>
                </div>
                <div class="card-body-custom">
                    <form>
                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control-custom" id="current_password" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control-custom" id="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control-custom" id="confirm_password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-lock"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Account Stats -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h5 class="sidebar-card-title">Account Stats</h5>
                </div>
                <div class="sidebar-card-body">
                    <div class="stat-item">
                        <span class="stat-label">Member Since</span>
                        <span class="stat-value">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total Purchases</span>
                        <span class="stat-value">{{ \App\Models\PluginSubscription::where('user_id', $user->id)->count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Account Status</span>
                        <span class="badge-success">Active</span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h5 class="sidebar-card-title">Quick Links</h5>
                </div>
                <div class="sidebar-card-body">
                    <div class="quick-links">
                        <a href="{{ route('user.dashboard') }}" class="quick-link">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('user.licenses') }}" class="quick-link">
                            <i class="fas fa-key"></i>
                            My Licenses
                        </a>
                        <a href="#" class="quick-link">
                            <i class="fas fa-download"></i>
                            Downloads
                        </a>
                        <a href="#" class="quick-link">
                            <i class="fas fa-file-invoice"></i>
                            Billing History
                        </a>
                        <a href="#" class="quick-link">
                            <i class="fas fa-headset"></i>
                            Support Tickets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
