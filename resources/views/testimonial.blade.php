@extends("layouts.static-layout")
@section("testi-active", true)

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@section("content")
<div class="bg-white mt-5 testimonial-section-1 rounded-3 shadow">
  <div class="d-flex justify-content-center">
    <h2 class="nunito-sans text-center fs-4">Apa yang mereka katakan tentang kita</h2>
  </div>
  <div class="position-relative">
    <div class="slick-testi mt-4">
      @foreach ($testimonials as $testimonial)
        <div class="slide-testi">
          <div class="rounded d-flex flex-column" style="width: 100%; height: 320px; border: 1px solid #322DD2; padding: 18px">
            <img src="{{ asset("quote.png") }}" style="width: 27px; height: 20px" alt="quote">
            <div class="my-3 flex-1">
              {{ $testimonial->content }}
            </div>
            <div class="d-flex align-items-center">
              <div class="me-2">
                <img src="{{ asset($testimonial->author_image ?? "photo_empty.png") }}" style="width: 45px; height: 45px" alt="user empty">
              </div>
              <div class="flex-1">
                {{ $testimonial->author_name }}
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<div class="testimonial-section-2">
  <div class="d-flex justify-content-center">
    <h2 class="nunito-sans text-center fs-4">Galeri Pengiriman</h2>
  </div>
  <div class="row">
    @foreach ($galleries as $gallery)
      <div class="col-6 col-md-4 col-lg-3 mt-4">
        <img src="{{ asset($gallery->path) }}" class="img-fluid" alt="testimoni">
      </div>
    @endforeach
  </div>
  <div class="d-flex justify-content-center mt-5">
    {{-- <button class="btn bg-white fw-bold text-sm py-2 px-3" style="border: 1px solid #322DD2; color: #322DD2">
      See More
    </button> --}}
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  $(".slick-testi").slick({
    dots: false,
    infinite: true,
    arrows: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    nextArrow: `
      <div class="position-absolute bg-white" style="top: 50%; transform: translateY(-50%); right: -30px; z-index: 2">
        <button class="testi-next btn bg-white d-flex justify-content-center align-items-center" style="border: 1px solid #322DD2; width: 42px; height: 42px; border-radius: 99999px">
          <img src="{{ asset("slide_arrow_right.png") }}" style="width: 9px; height: 14px" alt="">
        </button>
      </div>
    `,
    prevArrow: `
      <div class="position-absolute bg-white" style="top: 50%; transform: translateY(-50%); left: -30px; z-index: 2">
        <button class="testi-prev btn bg-white d-flex justify-content-center align-items-center" style="border: 1px solid #322DD2; width: 42px; height: 42px; border-radius: 99999px">
          <img src="{{ asset("slide_arrow_left.png") }}" style="width: 9px; height: 14px" alt="">
        </button>
      </div>
    `,
    responsive: [
      {
        breakpoint: 512,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  })
</script>
@endpush