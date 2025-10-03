@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 fw-bold">Sign Up</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf
                        <div class="d-flex gap-2 mb-3">
                            <input type="text" name="first_name" class="form-control"
                                   placeholder="First Name" required>
                            <input type="text" name="last_name" class="form-control"
                                   placeholder="Last Name" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                   placeholder="Email" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirm Password" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Sign Up</button>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account? <a href="{{ route('login') }}">Log In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
