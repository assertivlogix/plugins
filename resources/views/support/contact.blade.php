@extends('layouts.frontend')

@section('title', 'Contact Support - Assertivlogix')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <h1 class="text-center mb-4">Contact Support</h1>
                        <p class="text-center text-muted mb-5">Have a question or running into an issue? Fill out the form below and we'll get back to you as soon as possible.</p>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('support.contact.submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                        <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                        <option value="Billing Question" {{ old('subject') == 'Billing Question' ? 'selected' : '' }}>Billing Question</option>
                                        <option value="Feature Request" {{ old('subject') == 'Feature Request' ? 'selected' : '' }}>Feature Request</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row mt-5 text-center">
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5>Email Us</h5>
                            <p class="text-muted">sales@assertivlogix.com</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-comments fa-2x text-primary mb-3"></i>
                            <h5>Live Chat</h5>
                            <p class="text-muted">Available Mon-Fri, 9am-5pm EST</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5>Call Us</h5>
                            <p class="text-muted">+91 8128128981</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
