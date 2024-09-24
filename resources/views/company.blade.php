@extends("layouts.static-layout")
@section("company-active", true)

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@section("content")
<div class="jumbo-company">
  <div class="d-flex w-100 justify-content-end">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/8NY8gYmKpys?si=Vef4ta0H9bQc5Mln" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  </div>
</div>
<div class="company-welcome">
  <div class="row d-flex align-items">
    <div class="col-md-6 col-sm-12 section-about-company pe-5">
      <div class="d-flex align-items-center justify-content-start mb-3">
        <h2 class="nunito-sans fs-4">Wecome to Our Company</h2>
      </div>
      <div class="inter text-dark text-left fs-5">
        <strong>PT. Obitrans Indonesia</strong> merupakan salah satu Perusahaan Rental Mobil di Indonesia yang saat ini berlokasi di Jakarta dan Bali. Kami menawarkan layanan sewa mobil, dengan paket perawatan opsional, untuk memenuhi kebutuhan kendaraan operasional perusahaan. Kami juga menyediakan layanan Car Ownership Program (COP) sesuai permintaan pelanggan.
      </div>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="slick-fade">
        @foreach ($slides as $key => $slide)
          <div>
            <img src="{{ asset($slide->slide_image) }}" class="img-fluid" alt="{{ $key + 1 }}">
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="company-visi-misi row">
  <div class="col-md-6 col-sm-12 mx-auto">
    <div class="d-flex align-items-center justify-content-center mt-5">
      <h2 class="nunito-sans text-white fs-4">Visi Misi Kami</h2>
    </div>
    <div class="inter text-white visi-misi mt-5">
      <h3 class="nunito-sans text-white">Visi</h3>
      <p class="nunito-sans fs-5">Menjadi perusahaan rental mobil terkemuka di Indonesia yang menyediakan servis terbaik bagi semua pelanggan.</p>
      <h3 class="nunito-sans mt-4 text-white">Misi</h3>
      <ul class="nunito-sans fs-5">
        <li>Menyediakan armada mobil terbaru dan terawat dengan harga yang kompetitif.</li>
        <li>Memberikan layanan pelanggan yang ramah, cepat, dan responsif.</li>
        <li>Menjalin kerjasama yang saling menguntungkan dengan mitra bisnis dari berbagai sektor.</li>
        <li>Melakukan inovasi dan pengembangan terus-menerus untuk meningkatkan kualitas servis dan pelayanan.</li>
        <li>Menjadi pilihan utama bagi masyarakat Indonesia dalam menyediakan transportasi sewa mobil.</li>
      </ul>
    </div>
  </div>
</div>
<div class="company-services">
  <div class="d-flex align-items-center justify-content-center mt-5">
    <h2 class="nunito-sans fs-4">Layanan Kami</h2>
  </div>
  <div class="row mt-4">
    @foreach ($services as $service)
			<div class="col-md-3">
				<div class="service-box shadow">
					<div class="text-center">
						<img src="{{ asset($service->image_icon) }}" width="150" height="150" alt="service 1">
					</div>
					<p class="text-center text-dark nunito-sans fw-semibold mb-0 position-relative">
						{{ $service->title }}
					</p>
					<p class="mb-0 text-dark nunito-sans mt-3" style="height: 200px">
						{{ $service->content }}
					</p>
				</div>
			</div>
		@endforeach
  </div>
</div>
<div class="company-qna row justify-content-center">
  @foreach ($qna as $item)
    <div class="col-md-3">
      <div class="service-box shadow px-4 py-5" style="height: 350px">
        <p class="text-center nunito-sans mb-4 position-relative fs-5" style="color: #322DD2; font-style: italic; font-weight: 800; line-height: 1">{{ $item->question }}</p>
        <p class="mb-0 text-dark nunito-sans text-center">
          {{ $item->answer }}
        </p>
      </div>
    </div>
  @endforeach
</div>
<div class="company-location">
  <div class="d-flex align-items-center justify-content-center mt-5">
    <h2 class="nunito-sans fs-4">Our Location</h2>
  </div>
  <div class="text-dark mt-5" style="font-weight: 800">
    Marketing & Operational Office
  </div>
  <div class="row mt-1 mb-5">
    <div class="col-md-3 text-dark">
      <div class="d-flex align-items-center text-dark nunito-sans gap-2">
        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="2" cy="2" r="2" fill="black"/>
        </svg>
        <span class="">Jakarta:</span>
      </div>
      <div class="nunito-sans text-dark">
        Jl. Letjen Suprapto No. L 20 D RT 001 RW 003 Harapan Mulya, Kecamatan Kemayoran, Kota Jakarta Pusat
      </div>
    </div>
    <div class="col-md-3">
      <div class="d-flex align-items-center text-dark nunito-sans gap-2">
        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="2" cy="2" r="2" fill="black"/>
        </svg>
        <span>Bali:</span>
      </div>
      <div class="nunito-sans text-dark">
        Perum Taman Mutiara Blok A No. 21 A Pemecutan Klod Denpasar Barat Kota Denpasar
      </div>
    </div><div class="col-md-3">
      <div class="d-flex align-items-center text-dark nunito-sans gap-2">
        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="2" cy="2" r="2" fill="black"/>
        </svg>
        <span>Ambon:</span>
      </div>
      <div class="nunito-sans text-dark">
      Jl. Jendral Sudirman RT 005 / RW 005, Kelurahan Hative Kecil, Kec. Sirimau, Kota Ambon
      </div>
    </div>
    <div class="col-md-3">
      <div class="d-flex align-items-center nunito-sans gap-2 fw-bold">
        <span class="text-dark">Office</span>
      </div>
      <div class="nunito-sans text-dark">
        Jl. Bandengan Selatan No. 43, Komplek Puri Delta Mas Blok C No. 36, Pejagalan, Penjaringan, Jakarta Utara
      </div>
    </div>
  </div>
  <div class="text-center my-5">
    <img src="{{ asset("map_image.png") }}" class="img-fluid" alt="maps">
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  $(".slick-fade").slick({
    dots: false,
    infinite: true,
    autoplay: true,
    arrows: false,
    speed: 500,
    fade: true,
    cssEase: 'linear'
  })
</script>
@endpush