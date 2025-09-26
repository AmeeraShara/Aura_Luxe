@extends('layouts.app')

@section('content')

<!-- Register Floating Box -->
<div id="registerBox" class="position-fixed top-50 end-0 translate-middle-y me-5 bg-white shadow-lg rounded p-4"
     style="width: 350px; display: none; z-index:1050;">
    
    <!-- Close Icon -->
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" id="closeRegister"></button>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="d-flex gap-2 mb-3">
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">Sign Up</button>

        <p class="text-center mt-3 mb-0">
            Already have an account? 
            <a href="#" id="showLogin">Log in</a>
        </p>
    </form>
</div>

<!-- Login Floating Box -->
<div id="loginBox" class="position-fixed top-50 end-0 translate-middle-y me-5 bg-white shadow-lg rounded p-4"
     style="width: 350px; display: none; z-index:1050;">

    <!-- Close Icon -->
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" id="closeLogin"></button>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-dark w-100">Log In</button>

        <p class="text-center mt-3 mb-0">
            Don’t have an account? 
            <a href="#" id="showRegister">Sign Up</a>
        </p>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const userIcon = document.querySelector(".fa-user").parentElement;
        const registerBox = document.getElementById("registerBox");
        const loginBox = document.getElementById("loginBox");
        const showLogin = document.getElementById("showLogin");
        const showRegister = document.getElementById("showRegister");
        const closeRegister = document.getElementById("closeRegister");
        const closeLogin = document.getElementById("closeLogin");

        // Open Register on user icon click
        userIcon.addEventListener("click", (e) => {
            e.preventDefault();
            loginBox.style.display = "none";
            registerBox.style.display = "block";
        });

        // Switch to login
        showLogin.addEventListener("click", (e) => {
            e.preventDefault();
            registerBox.style.display = "none";
            loginBox.style.display = "block";
        });

        // Switch to register
        showRegister.addEventListener("click", (e) => {
            e.preventDefault();
            loginBox.style.display = "none";
            registerBox.style.display = "block";
        });

        // Close Register Box
        closeRegister.addEventListener("click", () => {
            registerBox.style.display = "none";
        });

        // Close Login Box
        closeLogin.addEventListener("click", () => {
            loginBox.style.display = "none";
        });
    });
</script>

@endsection
