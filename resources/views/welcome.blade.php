@extends("layouts.static-layout")
@section("home-active", true)

@section("content")
<div class="position-relative">
	<img src="{{ asset("jumbotron.png") }}" class="img-fluid w-full" alt="jumbotron">
	{{-- <div class="inter tagline">
		“Sewa mobil untuk kemudahan, kebebasan dan kenyamanan”
	</div> --}}
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
		<div class="col-md-3">
			<div class="service-box shadow">
				<div class="text-center">
					<img src="{{ asset("service-1.png") }}" class="img-fluid" width="150" height="150" alt="service 1">
				</div>
				<p class="text-center text-dark nunito-sans fw-semibold mb-0 position-relative" style="top: -10px">Lorem ipsum</p>
				<p class="mb-0 text-dark nunito-sans">
					viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.
				</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="service-box shadow">
				<div class="text-center">
					<img src="{{ asset("service-2.png") }}" class="img-fluid" width="150" height="150" alt="service 2">
				</div>
				<p class="text-center text-dark nunito-sans fw-semibold mb-0 position-relative" style="top: -10px">Lorem ipsum</p>
				<p class="mb-0 text-dark nunito-sans">
					viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.
				</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="service-box shadow">
				<div class="text-center">
					<img src="{{ asset("service-3.png") }}" class="img-fluid" width="150" height="150" alt="service 3">
				</div>
				<p class="text-center text-dark nunito-sans fw-semibold mb-0 position-relative" style="top: -10px">Lorem ipsum</p>
				<p class="mb-0 text-dark nunito-sans">
					viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.
				</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="service-box shadow">
				<div class="text-center">
					<img src="{{ asset("service-4.png") }}" class="img-fluid" width="150" height="150" alt="service 4">
				</div>
				<p class="text-center text-dark nunito-sans fw-semibold mb-0 position-relative" style="top: -10px">Lorem ipsum</p>
				<p class="mb-0 text-dark nunito-sans">
					viverra dolor nulla, odio sed orci nisi quis sapien odio nisi ultrices sit felis, gravida facilisis sit Vestibulum sed Vestibulum Sed facilisis tortor. sapien ipsum venenatis ex eu adipiscing porta volutpat faucibus urna. libero, quam volutpat lacus, tortor. placerat lorem.
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
