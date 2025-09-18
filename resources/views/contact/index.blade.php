@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">

        <!-- Success Message -->
        @if(session('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <!-- Contact Info -->
        <div class="col-lg-5">
            <h2 class="fw-bold mb-4">Get in Touch</h2>
            <p class="text-muted mb-4">
                Have questions, feedback, or need support? We’d love to hear from you.
            </p>

            <ul class="list-unstyled text-muted">
                <li class="mb-3">
                    <i class="fa fa-map-marker-alt me-2 text-dark"></i>
                    No 20 Kandy Road, Kandy
                </li>
                <li class="mb-3">
                    <i class="fa fa-phone me-2 text-dark"></i>
                    +94 711355535
                </li>
                <li>
                    <i class="fa fa-envelope me-2 text-dark"></i>
                    hello@auraluxe.com
                </li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Send Us a Message</h4>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Write your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
