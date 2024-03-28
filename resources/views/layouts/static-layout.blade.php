<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />
  <title>Obitrans</title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/boxicons.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/css/core.css") }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset("font.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}" />
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />
  @stack("style")
</head>
<body>
  <div class="wrapper vh-100 overflow-hidden d-none">
    <div class="navbar-content">
      <div class="d-flex align-items-center justify-content-between">
        <a href="/">
          <img src="{{ asset("logo.png") }}" alt="logo" width="148" height="51">
        </a>
        <div class="d-flex align-items-center gap-5">
          <div class="position-relative">
            <a href="/" class="text-white nunito-sans fw-bold">Home</a>
            <div class="position-absolute w-100 left-0" style="background: #322DD2; height: 4px; bottom: -20px"></div>
          </div>
          <div class="position-relative">
            <a href="/" class="text-white nunito-sans fw-bold">Company</a>
          </div>
          <div class="position-relative">
            <a href="/" class="text-white nunito-sans fw-bold">Testimonial</a>
          </div>
          <div class="position-relative">
            <a href="/" class="text-white nunito-sans fw-bold">Kontak</a>
          </div>
        </div>
      </div>
    </div>
    @yield("content")
    <div class="section-3">
      <div class="cs-img">
        <img src="{{ asset("customer-support.png") }}" alt="customer support">
      </div>
      <div class="nunito-sans text-white">
        <p class="mb-1 fw-bold" style="font-size: 16px">Layanan Sewa Obitrans</p>
        <p class="mb-0">Silahkan hubungi kami untuk informasi lebih lanjut.</p>
      </div>
      <a href="#" class="nunito-sans text-dark fw-bold">Hubungi Kami</a>
    </div>
    <footer>
      <div class="footer-1">
        <img src="{{ asset("logo.png") }}" class="img-fluid" width="180" height="61" alt="logo">
        <h1 class="nunito-sans">PT. Obitrans Indonesia</h1>
        <span>Marketing & Operational Office</span>
      </div>
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="d-flex align-items-center text-white nunito-sans gap-2">
            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="2" cy="2" r="2" fill="white"/>
            </svg>
            <span>Jakarta:</span>
          </div>
          <div class="text-white nunito-sans">
            Jl. Letjen Suprapto No. L 20 D RT 001 RW 003 Harapan Mulya, Kecamatan Kemayoran, Kota Jakarta Pusat
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center text-white nunito-sans gap-2">
            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="2" cy="2" r="2" fill="white"/>
            </svg>
            <span>Bali:</span>
          </div>
          <div class="text-white nunito-sans">
            Perum Taman Mutiara Blok A No. 21 A Pemecutan Klod Denpasar Barat Kota Denpasar
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center text-white nunito-sans gap-2 fw-bold">
            <span>Office</span>
          </div>
          <div class="text-white nunito-sans">
            Jl. Bandengan Selatan No. 43, Komplek Puri Delta Mas Blok C No. 36, Pejagalan, Penjaringan, Jakarta Utara
          </div>
        </div>
      </div>
      <div class="footer-2"></div>
      <div class="footer-3 nunito-sans text-center text-white">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        PT Obitrans Indonesia. All Rights Reserved
      </div>
    </footer>
  </div>
  <div class="welcome-splash" style="z-index: 20">
    <img src="{{ asset("favicon.ico") }}" width="80" height="80" alt="logo">
    <span class="loader-splash"></span>
  </div>
  <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>
  <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
  <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
  <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
  {{-- <script src="{{ asset("assets/js/main.js") }}"></script> --}}
  <script>
    $(document).ready(function() {
      $(".wrapper").removeClass("d-none");
      setTimeout(() => $(".welcome-splash").addClass("animate-hidden"), 1000);
      setTimeout(() => {
        $(".wrapper").removeClass("vh-100");
        $(".wrapper").removeClass("overflow-hidden");
        $(".welcome-splash").remove();
      }, 2000);
    });
  </script>
  @stack("script")
</body>
</html>