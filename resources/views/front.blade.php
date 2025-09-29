@extends('layouts.app')

@section('content')
<style>
  /* ---- HERO ---- */
  .hero {
    height: 72vh;
    min-height: 420px;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
  }

  .hero-overlay {
    width: 100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.45));
    padding: 6rem 0;
  }

  .hero-title {
    letter-spacing: 2px;
    text-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
    opacity: 0;
    transform: translateY(18px);
    transition: all 0.6s ease;
  }

  .reveal.in .hero-title {
    opacity: 1;
    transform: translateY(0);
  }

  /* ---- NAVBAR transition on scroll ---- */
  header {
    transition: background-color 0.28s ease, box-shadow 0.28s ease, padding 0.28s ease;
  }

  header.scrolled {
    background-color: #fff;
    box-shadow: 0 6px 18px rgba(15, 15, 15, 0.07);
  }

  .nav .nav-link {
    position: relative;
    padding-bottom: 8px;
  }

  .nav .nav-link::after {
    content: "";
    position: absolute;
    height: 2px;
    left: 0;
    bottom: 0;
    width: 0;
    background: #000;
    transition: width .28s ease;
  }

  .nav .nav-link:hover::after {
    width: 100%;
  }

  /* ---- PRODUCT CARDS ---- */
  .product-card {
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    position: relative;
    transition: transform .28s ease, box-shadow .28s ease;
  }

  .product-card img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    display: block;
  }

  .product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(20, 20, 20, 0.08);
  }
.product-image-wrapper {
  position: relative;
  overflow: hidden;
}

.product-image-wrapper img {
  width: 100%;
  height: 320px;
  object-fit: cover;
  display: block;
}
.product-overlay-glass {
  position: absolute;
  bottom: 12px;
  left: 50%;
  transform: translateX(-50%) translateY(0);
  opacity: 1;
  pointer-events: auto;
  z-index: 2;
  transition: none;
}
.product-card:hover .product-overlay-glass {
  opacity: 1;
  transform: translateX(-50%) translateY(0);
  pointer-events: auto;
}

/* Glass effect background */
.glass-bg-icons {
  background: rgba(255, 255, 255, 0.18);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 12px;
  padding: 40px 120px;
  display: flex;
  gap: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

/* Icon button styles */
.icon-btn {
  background-color: rgba(255, 0, 0, 0.85);
  border: none;
  color: white;
  padding: 8px;
  font-size: 14px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.icon-btn:hover {
  background-color: darkred;
}

/* Responsive image height */
@media (max-width: 576px) {
  .product-image-wrapper img {
    height: 260px;
  }
}

  .product-info {
    background: #fff;
  }

  /* ---- CATEGORY CARDS ---- */
  .category-card {
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    background: #f9f9f9;
    transition: transform .25s ease, box-shadow .25s ease;
  }

.category-card img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: transform 0.3s ease, filter 0.3s ease;
}

.category-card:hover img {
  transform: scale(1.05);
  filter: brightness(0.85);
}


  .category-text {
    position: absolute;
    left: 12px;
    bottom: 12px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #fff;
    text-shadow: 0 3px 8px rgba(0, 0, 0, 0.45);
  }

  /* ---- REVEAL ANIMATIONS ---- */
  .reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity .6s ease, transform .6s ease;
  }

  .reveal.in {
    opacity: 1;
    transform: translateY(0);
  }

  /* small responsive tweaks */
  @media (max-width: 576px) {
    .product-card img {
      height: 260px;
    }

    .hero-overlay {
      padding: 4rem 0;
    }
  }

</style>

<!-- HERO -->
<section class="hero reveal" style="background-image: url('{{ asset('images/hero.jpg') }}');">
  <div class="hero-overlay">
    <div class="container text-center text-white">
      <h1 class="display-4 fw-bold hero-title">AUTUMN COLLECTION 2025</h1>
      <p class="lead mb-4">Aura Luxe — Everyday Detail</p>
      <a href="#" class="btn btn-light rounded-0 px-4 py-2">Shop New Arrivals</a>
    </div>
  </div>
</section>

<!-- NEW ARRIVALS -->
<section class="py-5">
  <div class="container">
    <h3 class="text-center fw-bold mb-4">NEW ARRIVALS</h3>
    <div class="row g-3">
      @forelse($products as $product)
        <div class="col-6 col-md-3">
          <div class="product-card reveal position-relative">

            <!-- Image Wrapper -->
            <div class="product-image-wrapper">
              <img src="{{ asset($product->first_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">

              <!-- Icon Buttons in Image (Bottom with Glass Background) -->
              <div class="product-overlay-glass">
                <div class="glass-bg-icons">
                  <button class="icon-btn" aria-label="Add to Wishlist">
                    <i class="fa fa-heart"></i>
                  </button>
                  <a href="{{ route('products.show', $product->id) }}" class="icon-btn" aria-label="View Product">
                    <i class="fa fa-eye"></i>
                  </a>
                </div>
              </div>
            </div>

            <!-- Product Info -->
            <div class="product-info text-center p-2">
              <div class="small text-muted">{{ $product->name }}</div>
              <div class="fw-bold">LKR {{ number_format($product->price, 2) }}</div>
            </div>

          </div>
        </div>
      @empty
        <p class="text-center">No products found.</p>
      @endforelse
    </div>
  </div>
</section>


<!-- SHOP BY CATEGORY -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center fw-bold mb-4">SHOP BY CATEGORY</h3>
    <div class="row g-3 justify-content-center">
      @foreach($collections as $collection)
      <div class="col-6 col-md-3 col-lg-2">
        <a href="{{ route($collection['route']) }}" class="text-decoration-none">
          <div class="category-card reveal shadow-sm">
            <img src="{{ $collection['image'] }}" alt="{{ $collection['name'] }}">
            <div class="category-text">{{ $collection['name'] }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Spacer -->
<div class="py-5"></div>

<script>
  // NAV scrolled class
  (function() {
    const header = document.querySelector('header');

    function onScroll() {
      if (window.scrollY > 40) header.classList.add('scrolled');
      else header.classList.remove('scrolled');
    }
    window.addEventListener('scroll', onScroll);
    onScroll();

    // Reveal animations
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('in');
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
  })();
</script>
@endsection
