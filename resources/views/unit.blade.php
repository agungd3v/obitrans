@extends("layouts.static-layout")

@section('content')
<div class="rent-image">
  <div class="position-relative rent-image-label">
    {{-- <div class="text-dark">Sewa untuk</div> --}}
    <h1 style="color: #FFB800">Unit List</h1>
  </div>
  <img src="{{ asset("rent_corporate.png") }}" class="img-fluid" alt="sewa corporate">
</div>
<div class="text-center text-dark fs-5 rent-info mb-4">
  Kami memberikan pelayanan terbaik untuk setiap pelanggan. Harga yang kompetitif dengan kualitas dan performa layanan yang memuaskan. Kondisi unit kendaraan prima dan terawat agar pelanggan mendapatkan kenyamanan selama perjalanan untuk berbagai keperluan Anda baik dinas, pribadi dan keluarga
</div>
<div class="section-rent shadow mb-5">
  <p class="text-dark fw-semibold">Pilih Jenis Sewa:</p>
  <div class="d-flex align-items-center gap-3">
    <a href="/rent/corporate">
      Corporate
    </a>
    <a href="/rent/harian">
      Harian Bali
    </a>
  </div>
</div>
<div style="padding: 0 40px; margin-bottom: 200px">
  <div class="row">
    @foreach ($cars as $car)
      <div class="col-12 col-md-4 col-lg-3 mb-4">
        <div class="bg-white shadow" style="padding: 24px; border-radius: 12px">
          <div
            class="overflow-hidden d-flex justify-content-center align-items-center"
            style="width: 100%; height: 200px; background: #FFFFFF; border-radius: 8px"
          >
            <div class="">
              <img src="{{ $car->image }}" class="img-fluid" alt="cars image">
            </div>
          </div>
          <h3 class="text-dark mt-3 fs-4">{{ $car->label }}</h3>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="d-flex align-items-center text-dark gap-1">
              <img src="{{ asset("fuel_icon.png") }}" style="width: 20px; height: 20px" alt="fuel_icon">
              <span>{{ $car->fuel }}</span>
            </div>
            <div class="d-flex align-items-center text-dark gap-1">
              <img src="{{ asset("capacity_icon.png") }}" style="width: 20px; height: 20px" alt="capacity_icon">
              <span>{{ $car->capacity }} Orang</span>
            </div>
            <div class="d-flex align-items-center text-dark gap-1">
              <img src="{{ asset("transmission_icon.png") }}" style="width: 20px; height: 20px" alt="capacity_icon">
              <span>{{ $car->gear }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
