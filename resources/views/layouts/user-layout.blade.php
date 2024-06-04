<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Dashboard</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset("favicon.ico") }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/boxicons.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/core.css") }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/theme-default.css") }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/apex-charts/apex-charts.css") }}" />
    @stack("style")
    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand main">
            <a href="{{ route("dashboard") }}" class="app-brand-link">
              <img src="{{ asset("favicon.ico") }}" width="50" height="50" alt="">
              <span class="app-brand-text main menu-text fw-bolder ms-2">Obitrans</span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <ul class="menu-inner py-1">
            <li class="menu-item @yield("dashboard")">
              <a href="{{ route("dashboard") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
              </a>
            </li>
            <li class="menu-item @yield("company")">
              <a href="{{ route("company") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-buildings"></i>
                <div>Company Profile</div>
              </a>
            </li>
            <li class="menu-item @yield("banner")">
              <a href="{{ route("banner") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-image"></i>
                <div>Banner</div>
              </a>
            </li>
            <li class="menu-item @yield("car")">
              <a href="{{ route("car") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-car"></i>
                <div>Mobil</div>
              </a>
            </li>
            <li class="menu-item @yield("service")">
              <a href="{{ route("service") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buoy"></i>
                <div>Layanan</div>
              </a>
            </li>
            <li class="menu-item @yield("gallery")">
              <a href="{{ route("gallery") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-photo-album"></i>
                <div>Galeri</div>
              </a>
            </li>
            <li class="menu-item @yield("testimonial")">
              <a href="{{ route("testimonial") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-square-dots"></i>
                <div>Testimonial</div>
              </a>
            </li>
            <li class="menu-item @yield("contact")">
              <a href="{{ route("contact") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-contact"></i>
                <div>Kontak</div>
              </a>
            </li>
            <li class="menu-item @yield("social")">
              <a href="{{ route("social") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxl-instagram-alt"></i>
                <div>Sosial Media</div>
              </a>
            </li>
            <li class="menu-item @yield("qna")">
              <a href="{{ route("qna") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div>QnA</div>
              </a>
            </li>
          </ul>
        </aside>
        <div class="layout-page">
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div class="navbar-nav align-items-center">
                {{--  --}}
              </div>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item lh-1 me-3">
                  {{--  --}}
                </li>
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">Admin Obitrans</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route("logout") }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              @yield("content")
            </div>
            <footer class="content-footer footer bg-footer-theme p-0">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://obitrans.co.id" target="_blank" class="footer-link fw-bolder">Obitrans</a>
                </div>
              </div>
            </footer>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/menu.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/apex-charts/apexcharts.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>
    <script src="{{ asset("assets/js/dashboards-analytics.js") }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @stack("script")
  </body>
</html>
