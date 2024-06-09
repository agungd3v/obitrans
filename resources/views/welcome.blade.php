@extends("layouts.static-layout")
@section("home-active", true)

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endpush

@section("content")
<div class="position-relative">
	<div class="slick">
		@foreach ($baners as $baner)
			<div class="img-welcome">
				<img src="{{ asset($baner->banner_image) }}" class="img-fluid w-full" alt="jumbotron">
			</div>
		@endforeach
	</div>
	<div class="section-rent shadow">
		<p class="text-dark fw-semibold">Pilih Jenis Sewa:</p>
		<div class="d-flex align-items-center gap-3">
			<a href="/rent/corporate">
				Corporate
			</a>
			<a href="/rent/harian">
				Harian
			</a>
		</div>
	</div>
</div>
<div class="section-2">
	<div class="d-flex align-items-center justify-content-center">
		<h2 class="nunito-sans">Tentang</h2>
	</div>
	<div class="inter fs-5 text-dark text-center">
		<strong>PT. Obitrans Indonesia</strong> merupakan salah satu Perusahaan Rental Mobil di Indonesia yang saat ini berlokasi di Jakarta dan Bali. Kami menawarkan layanan sewa mobil, dengan paket perawatan opsional, untuk memenuhi kebutuhan kendaraan operasional perusahaan. Kami juga menyediakan layanan Car Ownership Program (COP) sesuai permintaan pelanggan.
	</div>
	<div class="d-flex align-items-center justify-content-center mt-5">
		<h2 class="nunito-sans">Visi Misi Kami</h2>
	</div>
	<div class="inter text-white visi-misi">
		<h3 class="nunito-sans">Visi</h3>
		<p class="nunito-sans fs-5">Menjadi perusahaan rental mobil terkemuka di Indonesia yang menyediakan servis terbaik bagi semua pelanggan.</p>
		<h3 class="nunito-sans mt-4">Misi</h3>
		<ul class="nunito-sans fs-5">
			<li>Menyediakan armada mobil terbaru dan terawat dengan harga yang kompetitif.</li>
			<li>Memberikan layanan pelanggan yang ramah, cepat, dan responsif.</li>
			<li>Menjalin kerjasama yang saling menguntungkan dengan mitra bisnis dari berbagai sektor.</li>
			<li>Melakukan inovasi dan pengembangan terus-menerus untuk meningkatkan kualitas servis dan pelayanan.</li>
			<li>Menjadi pilihan utama bagi masyarakat Indonesia dalam menyediakan transportasi sewa mobil.</li>
		</ul>
	</div>
	<div class="d-flex align-items-center justify-content-center mt-5">
		<h2 class="nunito-sans">Layanan Kami</h2>
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
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  $(".slick").slick({
    dots: false,
    infinite: true,
    autoplay: true,
    arrows: false,
    speed: 500,
    // fade: true,
    cssEase: 'linear'
  })
</script>
@endpush