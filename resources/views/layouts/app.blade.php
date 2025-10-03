<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aura Luxe</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Chat icon styles */
    .chat-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background-color: #000;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .chat-icon:hover {
      transform: scale(1.05);
      background-color: #333;
    }

    .chat-icon i {
      font-size: 24px;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Top Bar -->
  <div class="bg-light text-center small py-2">
    FREE SHIPPING ON ORDERS OVER LKR.10000
  </div>

  <!-- Header -->
  <header class="border-bottom">
    <div class="container py-3 d-flex align-items-center justify-content-between">

      <!-- Mobile menu toggle (Left) -->
      <button class="btn d-md-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
        <i class="fa fa-bars fs-4"></i>
      </button>

      <!-- Logo Center (Always Centered) -->
      <div class="flex-grow-1 d-flex justify-content-center">
        <a class="fw-bold fs-2 text-dark text-decoration-none" href="/">Aura Luxe</a>
      </div>

      <!-- Icons Right -->
      <div class="d-flex gap-3 fs-5">
        <a href="#" class="text-dark"><i class="fa fa-search"></i></a>

        @guest
        <!-- Show login/register trigger when guest -->
        <a href="#" class="text-dark" id="authTrigger"><i class="fa fa-user"></i></a>
        @else
        <!-- Dropdown when authenticated -->
        <div class="dropdown">
          <a class="text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fa fa-user"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </div>
        @endguest

        <a href="{{ route('cart.index', ['user_id' => Auth::id()]) }}" class="text-dark">
          <i class="fa fa-shopping-cart"></i>
        </a>
      </div>
    </div>


       <!-- Navigation Menu -->
    <nav class="border-top">
      <div class="container">
        <div class="collapse d-md-block" id="mainMenu">
          <ul class="nav flex-column flex-md-row justify-content-center fw-medium py-2 text-center">

            <!-- New Arrivals -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="{{ route('newarrival.index') }}">NEW ARRIVALS</a>
            </li>

            <!-- Men Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link text-dark dropdown-toggle" href="#" id="menDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                MEN
              </a>
              <ul class="dropdown-menu" aria-labelledby="menDropdown">
                <li><a class="dropdown-item" href="{{ route('men.index') }}">All Men</a></li>
                @if(isset($subcategories) && count($subcategories))
                @foreach($subcategories['Men'] as $sub)
                <li>
                  <a class="dropdown-item" href="{{ route('men.index', ['subcategory' => $sub]) }}">
                    {{ $sub }}
                  </a>
                </li>
                @endforeach
                @endif
              </ul>
            </li>

            <!-- Women Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link text-dark dropdown-toggle" href="#" id="womenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                WOMEN
              </a>
              <ul class="dropdown-menu" aria-labelledby="womenDropdown">
                <li><a class="dropdown-item" href="{{ route('women.index') }}">All Women</a></li>
                @if(isset($subcategories) && count($subcategories))

                @foreach($subcategories['Women'] as $sub)
                <li>
                  <a class="dropdown-item" href="{{ route('women.index', ['subcategory' => $sub]) }}">
                    {{ $sub }}
                  </a>
                </li>
                @endforeach
                @endif

              </ul>
            </li>

            <!-- Kids Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link text-dark dropdown-toggle" href="#" id="kidsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                KID'S
              </a>
              <ul class="dropdown-menu" aria-labelledby="kidsDropdown">
                <li><a class="dropdown-item" href="{{ route('kids.index') }}">All Kids</a></li>
                @if(isset($subcategories) && count($subcategories))

                @foreach($subcategories['Kids'] as $sub)
                <li>
                  <a class="dropdown-item" href="{{ route('kids.index', ['subcategory' => $sub]) }}">
                    {{ $sub }}
                  </a>
                </li>
                @endforeach
                @endif

              </ul>
            </li>

            <!-- Sale -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="{{ route('sale.index') }}">SALE</a>
            </li>

            <!-- Accessories Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link text-dark dropdown-toggle" href="#" id="accessoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ACCESSORIES
              </a>
              <ul class="dropdown-menu" aria-labelledby="accessoriesDropdown">
                <li><a class="dropdown-item" href="{{ route('accessories.index') }}">All Accessories</a></li>
                @if(isset($subcategories) && count($subcategories))
                @foreach($subcategories['Accessories'] as $sub)
                <li>
                  <a class="dropdown-item" href="{{ route('accessories.index', ['subcategory' => $sub]) }}">
                    {{ $sub }}
                  </a>
                </li>
                @endforeach
                @endif

              </ul>
            </li>

            <!-- Collections -->
            <li class="nav-item">
              <a class="nav-link text-dark" href="{{ route('collections.index') }}">COLLECTIONS</a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

  </header>

  <!-- Main Content -->
  <main class="flex-grow-1">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert" id="successAlert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="mt-5"> <!-- Top Black Section -->
    <div class="bg-black text-white pt-5 pb-4">
      <div class="container">
        <div class="row g-4 text-center text-md-start"> <!-- Follow Us -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">FOLLOW US ON</h5>
            <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-5 mb-4"> <a href="#" class="text-white"><i class="fab fa-facebook"></i></a> <a href="#" class="text-white"><i class="fab fa-instagram"></i></a> <a href="#" class="text-white"><i class="fab fa-youtube"></i></a> <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a> </div>
            <h5 class="fw-bold mb-2">ACCEPT TO PAY</h5>
            <div class="d-flex justify-content-center justify-content-md-start gap-2"> <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" class="img-fluid" style="max-width:50px;" alt="Visa"> <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" class="img-fluid" style="max-width:50px;" alt="Mastercard"> </div>
          </div> <!-- About -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">ABOUT US</h5>
            <p class="text-secondary small mb-0"> Aura Luxe is a luxury <br> fashion brand offering <br> sophisticated and timeless <br> pieces for the modern <br> woman. </p>
          </div> <!-- Customer Service -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">CUSTOMER SERVICE</h5>
            <ul class="list-unstyled small">
              <li><a href="{{ route('contact.index') }}" class="text-secondary text-decoration-none">Contact Us</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Shipping & Returns</a></li>
              <li><a href="{{ route('size-guide.index') }}" class="text-secondary text-decoration-none">Size Guide</a></li>
              <li><a href="{{ route('faq.index') }}" class="text-secondary text-decoration-none">FAQ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div> 
    <!-- Newsletter -->
    <div class="bg-white text-dark border-top py-5">
      <div class="container text-center">
        <h5 class="fw-bold mb-3">JOIN OUR NEWSLETTER</h5>
        <p class="text-muted small mb-4">Subscribe to receive updates, access to exclusive deals, and more.</p>
       <form id="newsletterForm" class="row justify-content-center g-2">
  <div class="col-12 col-md-4">
    <label for="emailInput" class="visually-hidden">Email address</label>
    <input type="email" id="emailInput" class="form-control rounded-0" placeholder="Enter your email" required>
  </div>
  <div class="col-12 col-md-auto">
    <button type="submit" class="btn btn-dark rounded-0 w-100">SUBSCRIBE</button>
  </div>
</form>

<div id="newsletterMessage" class="mt-3 text-success" style="display: none;"></div>

      </div>
    </div>
     <!-- Bottom -->
    <div class="bg-white border-top text-center text-muted small py-5">
      <p class="mb-4"> <span class="d-block d-md-inline px-md-5">No 20 Kandy Road, Kandy</span> <span class="d-block d-md-inline px-md-5">Hotline: +94 711355535</span> <span class="d-block d-md-inline px-md-5">hello@auraluxe.com</span> </p>
      <p class="mb-0"> © 2024 Aura Luxe. All rights reserved. </p>
    </div>
  </footer>

  <!-- Chat Icon -->
  <div class="chat-icon">
    <a href="{{ route('contact.index') }}" class="text-secondary text-decoration-none">
      <i class="fas fa-comment"></i>
    </a>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')

  <!-- Register Floating Box -->
  <div id="registerBox" class="position-fixed top-20 end-0 translate-middle-y me-5 bg-white shadow-lg rounded p-4"
    style="width: 350px; display: none; z-index:1050; margin-top: 270px">
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" id="closeRegister"></button>

    <form method="POST" action="{{ route('register.submit') }}">
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
        <a href="#" id="showLogin">Login</a> <br>
       <!--   <a href="{{ route('login') }}">Go to Login Page</a>-->
      </p>
    </form>
  </div>

  <!-- Login Floating Box -->
  <div id="loginBox" class="position-fixed top-20 end-0 translate-middle-y me-5 bg-white shadow-lg rounded p-4"
    style="width: 350px; display: none; z-index:1050; margin-top: 250px">
    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" id="closeLogin"></button>

    <form method="POST" action="{{ route('login.submit') }}">
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
        <a href="#" id="showRegister">Register</a> <br>
        <!--  <a href="{{ route('register.form') }}">Go to Register Page</a>-->
      </p>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const authTrigger = document.getElementById("authTrigger");
      const registerBox = document.getElementById("registerBox");
      const loginBox = document.getElementById("loginBox");
      const showLogin = document.getElementById("showLogin");
      const showRegister = document.getElementById("showRegister");
      const closeRegister = document.getElementById("closeRegister");
      const closeLogin = document.getElementById("closeLogin");

      if (authTrigger) {
        authTrigger.addEventListener("click", (e) => {
          e.preventDefault();
          loginBox.style.display = "none";
          registerBox.style.display = "block";
        });
      }

      if (showLogin) {
        showLogin.addEventListener("click", (e) => {
          e.preventDefault();
          registerBox.style.display = "none";
          loginBox.style.display = "block";
        });
      }

      if (showRegister) {
        showRegister.addEventListener("click", (e) => {
          e.preventDefault();
          loginBox.style.display = "none";
          registerBox.style.display = "block";
        });
      }

      if (closeRegister) {
        closeRegister.addEventListener("click", () => {
          registerBox.style.display = "none";
        });
      }

      if (closeLogin) {
        closeLogin.addEventListener("click", () => {
          loginBox.style.display = "none";
        });
      }
    });

    document.getElementById('newsletterForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const email = document.getElementById('emailInput').value;
  const messageDiv = document.getElementById('newsletterMessage');

  fetch("{{ route('newsletter.subscribe') }}", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({ email: email })
  })
  .then(res => res.json())
  .then(data => {
    messageDiv.style.display = 'block';
    messageDiv.textContent = data.message;
    document.getElementById('newsletterForm').reset();
  })
  .catch(err => {
    messageDiv.style.display = 'block';
    messageDiv.textContent = 'This email is already subscribed or invalid.';
    messageDiv.classList.remove('text-success');
    messageDiv.classList.add('text-danger');
  });
});
  </script>

</body>

</html>