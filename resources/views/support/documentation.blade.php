@extends('layouts.frontend')

@section('title', 'Documentation - Assertivlogix')

@section('content')
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm sticky-top" style="top: 2rem; z-index: 1;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Contents</h5>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active mb-2" href="#getting-started">Getting Started</a>
                            <a class="nav-link mb-2" href="#installation">Installation</a>
                            <a class="nav-link mb-2" href="#configuration">Configuration</a>
                            <a class="nav-link mb-2" href="#troubleshooting">Troubleshooting</a>
                            <a class="nav-link" href="#faqs">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">
                <h1 class="mb-4">Documentation</h1>
                
                <section id="getting-started" class="mb-5">
                    <h2>Getting Started</h2>
                    <p class="lead">Welcome to Assertivlogix Documentation. Here you'll find everything you need to get up and running with our plugins.</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Note: Make sure you have the latest version of WordPress installed before installing our plugins.
                    </div>
                </section>

                <section id="installation" class="mb-5">
                    <h2>Installation</h2>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Download the plugin ZIP file from your dashboard.</li>
                        <li class="list-group-item">Log in to your WordPress admin area.</li>
                        <li class="list-group-item">Go to Plugins > Add New.</li>
                        <li class="list-group-item">Click "Upload Plugin" and select the ZIP file.</li>
                        <li class="list-group-item">Click "Install Now" and then "Activate".</li>
                    </ol>
                </section>

                <section id="configuration" class="mb-5">
                    <h2>Configuration</h2>
                    <p>After activation, you will find a new menu item for the plugin in your WordPress dashboard side menu. Click on it to access the settings page.</p>
                    <p>Enter your license key found in your <a href="{{ route('licenses') }}">Assertivlogix Dashboard</a> to unlock all features.</p>
                </section>

                <section id="troubleshooting" class="mb-5">
                    <h2>Troubleshooting</h2>
                    <div class="accordion" id="troubleshootingAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Plugin not activating?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#troubleshootingAccordion">
                                <div class="accordion-body">
                                    Check your PHP version. Our plugins require PHP 7.4 or higher. Also ensure you have sufficient memory limit set in your php.ini.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section id="faqs">
                    <h2>Frequently Asked Questions</h2>
                     <p>Visit our <a href="{{ route('support.index') }}">Support Center</a> for more help topics.</p>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
