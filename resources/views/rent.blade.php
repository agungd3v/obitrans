@extends("layouts.static-layout")

@section('content')
@if ($type->slug == "harian")
  <div class="rent-image">
    <div class="position-relative rent-image-label">
      <div class="text-dark">Sewa untuk</div>
      <h1 style="color: #322DD2">Harian - Bali</h1>
    </div>
    <img src="{{ asset("rent_harian.png") }}" class="img-fluid" alt="sewa harian">
  </div>
  <div class="text-center text-dark fs-5 rent-info">
    Kami memberikan pelayanan terbaik untuk setiap pelanggan. Harga yang kompetitif dengan kualitas dan performa layanan yang memuaskan. Kondisi unit kendaraan prima dan terawat agar pelanggan mendapatkan kenyamanan selama perjalanan untuk berbagai keperluan Anda baik dinas, pribadi dan keluarga
  </div>
  <div class="rent-title">
    <div class="d-flex align-items-center justify-content-center">
      <h2 class="nunito-sans">Unit List</h2>
    </div>
  </div>
  <div style="padding: 0 40px; margin-bottom: 200px">
    <div class="row" id="data-rent"></div>
  </div>
@endif
@if ($type->slug == "corporate")
  <div class="rent-image">
    <div class="position-relative rent-image-label">
      <div class="text-dark">Sewa untuk</div>
      <h1 style="color: #FFB800">Comrporate - Jakarta</h1>
    </div>
    <img src="{{ asset("rent_corporate.png") }}" class="img-fluid" alt="sewa corporate">
  </div>
  <div class="text-center text-dark fs-5 rent-info">
    Kami memberikan pelayanan terbaik untuk setiap pelanggan. Harga yang kompetitif dengan kualitas dan performa layanan yang memuaskan. Kondisi unit kendaraan prima dan terawat agar pelanggan mendapatkan kenyamanan selama perjalanan untuk berbagai keperluan Anda baik dinas, pribadi dan keluarga
  </div>
  <div class="rent-title">
    <div class="d-flex align-items-center justify-content-center">
      <h2 class="nunito-sans">Unit List</h2>
    </div>
  </div>
  <div style="padding: 0 40px; margin-bottom: 200px">
    <div class="row" id="data-rent"></div>
  </div>
@endif
@endsection

@push('script')
<script>
  const type = "{{ $type->id }}";

  const data = $.ajax({
    url: "/rent/data",
    type: "POST",
    data: {
      _token: "{{ csrf_token() }}",
      type: type
    },
    success: function(data) {
      for (let index = 0; index < data.data.length; index++) {
        $("#data-rent").append(`
          <div class="col-12 col-md-4 col-lg-3 mb-4">
            <div class="bg-white shadow" style="padding: 24px; border-radius: 12px">
              <div class="overflow-hidden" style="width: 100%; height: 200px; background: #D8E3FF; border-radius: 8px">
                <img src="/${data.data[index].image}" class="img-fluid" alt="cars image">
              </div>
              <h3 class="text-dark mt-3 fs-4">${data.data[index].label}</h3>
              <div class="d-flex align-items-center justify-content-between ${type == 2 ? "mb-2" : "mb-5"}">
                <div class="d-flex align-items-center text-dark gap-1">
                  <img src="{{ asset("fuel_icon.png") }}" style="width: 20px; height: 20px" alt="fuel_icon">
                  <span>${data.data[index].fuel}</span>
                </div>
                <div class="d-flex align-items-center text-dark gap-1">
                  <img src="{{ asset("capacity_icon.png") }}" style="width: 20px; height: 20px" alt="capacity_icon">
                  <span>${data.data[index].capacity} Orang</span>
                </div>
                <div class="d-flex align-items-center text-dark gap-1">
                  <img src="{{ asset("transmission_icon.png") }}" style="width: 20px; height: 20px" alt="capacity_icon">
                  <span>${data.data[index].gear}</span>
                </div>
              </div>
              ${type == 2 ? `<span class="text-dark" style="font-size: 12px">Harga per hari :</span>` : ""}
              ${type == 2 ? `<div class="text-dark fs-4 fw-bold mb-3">Rp. 1.000.000</div>` : ""}
              <a href="#" class="d-block text-dark text-center fw-bold rounded-3 fs-5" style="background: #FFC700; padding: 10px 0">
                Pesan Sekarang
              </a>
            </div>
          </div>
        `);
      }
    },
    error: function(error) {
      console.log(error, "error");
    }
  })
</script>
@endpush