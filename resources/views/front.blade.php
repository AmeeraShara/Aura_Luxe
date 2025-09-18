@extends('layouts.app')

@section('content')
<style>
/* ---- HERO ---- */
.hero{
  height: 72vh;
  min-height: 420px;
  background-size: cover;
  background-position: center;
  position: relative;
  display:flex;
  align-items:center;
}
.hero-overlay{
  width:100%;
  background: linear-gradient(180deg, rgba(0,0,0,0.25), rgba(0,0,0,0.45));
  padding: 6rem 0;
}
.hero-title{
  letter-spacing: 2px;
  text-shadow: 0 4px 18px rgba(0,0,0,0.35);
  opacity:0;
  transform: translateY(18px);
  transition: all 0.6s ease;
}
.reveal.in .hero-title{ opacity:1; transform: translateY(0); }

/* ---- NAVBAR transition on scroll ---- */
header {
  transition: background-color 0.28s ease, box-shadow 0.28s ease, padding 0.28s ease;
}
header.scrolled {
  background-color: #fff;
  box-shadow: 0 6px 18px rgba(15,15,15,0.07);
}
.nav .nav-link { position: relative; padding-bottom: 8px; }
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
.nav .nav-link:hover::after{ width: 100%; }

/* ---- PRODUCT CARDS ---- */
.product-card{
  background: #fff;
  border-radius: 4px;
  overflow: hidden;
  position: relative;
  transition: transform .28s ease, box-shadow .28s ease;
}
.product-card img{ width: 100%; height: 320px; object-fit: cover; display:block; }
.product-card:hover{ transform: translateY(-6px); box-shadow: 0 14px 30px rgba(20,20,20,0.08); }

.product-overlay{
  position: absolute;
  left: 12px;
  right: 12px;
  top: 12px;
  display:flex;
  gap:8px;
  justify-content:flex-end;
  pointer-events: none;
  opacity: 0;
  transform: translateY(-6px);
  transition: all .22s ease;
}
.product-card:hover .product-overlay{ opacity: 1; transform: translateY(0); pointer-events: auto; }

.icon-btn{
  border: none;
  background: rgba(255,255,255,0.95);
  width: 40px;
  height: 40px;
  border-radius: 6px;
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow: 0 4px 10px rgba(0,0,0,0.06);
  cursor:pointer;
  transition: transform .15s ease;
}
.icon-btn:hover{ transform: scale(1.06); }

/* ---- CATEGORY CARDS ---- */
.category-card{
  position: relative;
  overflow: hidden;
  display:block;
  border-radius: 6px;
}
.category-card img{ width:100%; height: 260px; object-fit: cover; transition: transform .5s ease; }
.category-card:hover img{ transform: scale(1.06); }
.category-text{
  position:absolute;
  left: 24px;
  top: 24px;
  color: #fff;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 6px 18px rgba(0,0,0,0.45);
}

/* ---- REVEAL ANIMATIONS ---- */
.reveal{
  opacity: 0;
  transform: translateY(18px);
  transition: opacity .6s ease, transform .6s ease;
}
.reveal.in{
  opacity: 1;
  transform: translateY(0);
}

/* small responsive tweaks */
@media (max-width: 576px){
  .product-card img{ height: 260px; }
  .hero-overlay{ padding: 4rem 0; }
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
      @foreach([
        ['image'=>'product1.jpg','title'=>'Elegant Evening Dress','price'=>'LKR 12,800'],
        ['image'=>'product2.jpg','title'=>'Elegant Evening Dress','price'=>'LKR 12,800'],
        ['image'=>'product3.jpg','title'=>'Elegant Evening Dress','price'=>'LKR 12,800'],
        ['image'=>'product4.jpg','title'=>'Elegant Evening Dress','price'=>'LKR 12,800'],
      ] as $p)
      <div class="col-6 col-md-3">
        <div class="product-card reveal">
          <img src="{{ asset('images/'.$p['image']) }}" alt="{{ $p['title'] }}" class="img-fluid">
          <div class="product-overlay">
            <button class="icon-btn"><i class="fa fa-heart"></i></button>
            <button class="icon-btn"><i class="fa fa-eye"></i></button>
          </div>
          <div class="product-info text-center p-2">
            <div class="small text-muted">{{ $p['title'] }}</div>
            <div class="fw-bold">{{ $p['price'] }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- SHOP BY CATEGORY -->
<section class="py-5 bg-light">
  <div class="container">
    <h3 class="text-center fw-bold mb-4">SHOP BY CATEGORY</h3>
    <div class="row g-3">
      <div class="col-md-6">
        <a class="category-card reveal" href="#">
          <img src="{{ asset('images/cat-dresses.jpg') }}" alt="Dresses" class="img-fluid">
          <div class="category-text">DRESSES</div>
        </a>
      </div>
      <div class="col-md-6">
        <a class="category-card reveal" href="#">
          <img src="{{ asset('images/cat-formal.jpg') }}" alt="Formal" class="img-fluid">
          <div class="category-text">FORMAL WEAR</div>
        </a>
      </div>
      <div class="col-md-6">
        <a class="category-card reveal" href="#">
          <img src="{{ asset('images/cat-casual.jpg') }}" alt="Casual" class="img-fluid">
          <div class="category-text">CASUAL COLLECTION</div>
        </a>
      </div>
      <div class="col-md-6">
        <a class="category-card reveal" href="#">
          <img src="{{ asset('images/cat-accessories.jpg') }}" alt="Accessories" class="img-fluid">
          <div class="category-text">ACCESSORIES</div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Spacer -->
<div class="py-5"></div>

<script>
// NAV scrolled class
(function () {
  const header = document.querySelector('header');
  function onScroll() {
    if (window.scrollY > 40) header.classList.add('scrolled');
    else header.classList.remove('scrolled');
  }
  window.addEventListener('scroll', onScroll);
  onScroll();

  // IntersectionObserver for reveal animations
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
