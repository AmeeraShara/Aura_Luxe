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
        <a href="#" class="text-dark"><i class="fa fa-user"></i></a>
        <a href="#" class="text-dark"><i class="fa fa-shopping-cart"></i></a>
      </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="border-top">
      <div class="container">
        <div class="collapse d-md-block" id="mainMenu">
          <ul class="nav flex-column flex-md-row justify-content-center fw-medium py-2 text-center">
            <li class="nav-item">
              <a class="nav-link text-dark" href="{{ route('newarrival.index') }}">NEW ARRIVALS</a>
            </li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('men.index') }}">MEN</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('women.index') }}">WOMEN</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('kids.index') }}">KID'S</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('sale.index') }}">SALE</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('accessories.index') }}">ACCESSORIES</a></li>
            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('collections.index') }}">COLLECTIONS</a></li>
          </ul>
        </div>
      </div>
    </nav>

  </header>

  <!-- Main Content -->
  <main class="flex-grow-1">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="mt-5">

    <!-- Top Black Section -->
    <div class="bg-black text-white pt-5 pb-4">
      <div class="container">
        <div class="row g-4 text-center text-md-start">

          <!-- Follow Us -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">FOLLOW US ON</h5>
            <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-5 mb-4">
              <a href="#" class="text-white"><i class="fab fa-facebook"></i></a>
              <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
              <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
              <a href="#" class="text-white"><i class="fab fa-tiktok"></i></a>
            </div>

            <h5 class="fw-bold mb-2">ACCEPT TO PAY</h5>
            <div class="d-flex justify-content-center justify-content-md-start gap-2">
              <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" class="img-fluid" style="max-width:50px;" alt="Visa">
              <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" class="img-fluid" style="max-width:50px;" alt="Mastercard">
            </div>
          </div>

          <!-- About -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">ABOUT US</h5>
            <p class="text-secondary small mb-0">
              Aura Luxe is a luxury <br> fashion brand offering <br> sophisticated and timeless <br> pieces for the modern <br> woman.
            </p>
          </div>

          <!-- Customer Service -->
          <div class="col-md-4">
            <h5 class="fw-bold mb-3">CUSTOMER SERVICE</h5>
            <ul class="list-unstyled small">
              <li><a href="{{ route('contact.index') }}" class="text-secondary text-decoration-none">Contact Us</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Shipping & Returns</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">Size Guide</a></li>
              <li><a href="#" class="text-secondary text-decoration-none">FAQ</a></li>
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
        <form class="row justify-content-center g-2">
          <div class="col-12 col-md-4">
            <input type="email" class="form-control rounded-0" placeholder="Enter your email">
          </div>
          <div class="col-12 col-md-auto">
            <button type="submit" class="btn btn-dark rounded-0 w-100">SUBSCRIBE</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Bottom -->
    <div class="bg-white border-top text-center text-muted small py-5">
      <p class="mb-4">
        <span class="d-block d-md-inline px-md-5">No 20 Kandy Road, Kandy</span>
        <span class="d-block d-md-inline px-md-5">Hotline: +94 711355535</span>
        <span class="d-block d-md-inline px-md-5">hello@auraluxe.com</span>
      </p>
      <p class="mb-0">
        © 2024 Aura Luxe. All rights reserved.
      </p>
    </div>

  </footer>

  <!-- Message Icon -->
  <div class="chat-icon">
    <i class="fas fa-comment"></i>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')

</body>

</html>