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
                        
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select class="form-select" id="subject">
                                        <option selected>General Inquiry</option>
                                        <option>Technical Support</option>
                                        <option>Billing Question</option>
                                        <option>Feature Request</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="5" required></textarea>
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
                            <p class="text-muted">support@assertivlogix.com</p>
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
                            <p class="text-muted">+1 (555) 123-4567</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
