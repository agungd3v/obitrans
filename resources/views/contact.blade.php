@extends("layouts.static-layout")
@section("contact-active", true)

@section("content")
<div class="jumbo-contact">
  <div style="filter: blur(6px)">
    <img src="{{ asset("jumbo_contact.png") }}" class="w-100 h-100" alt="jumbotron contact">
  </div>
  <div class="contact-hub">
    <h1 class="nunito-sans">Hubungi Kami</h1>
    <div></div>
  </div>
</div>
<div class="contact-section nunito-sans">
  <div class="wrapper-contact">
    <div class="d-flex flex-column left">
      <img src="{{ asset("logo.png") }}" class="img-fluid" width="180" height="62" alt="logo">
      <span class="text-white fw-bold fs-5 mt-1">PT. Obitrans Indonesia</span>
      <div class="bg-white mt-1 mb-3" style="height: 1px"></div>
      <div class="row">
        <div class="col-sm-12 col-md-6 mb-2 text-white">
          <p class="fw-bold">Marketing & Operational Office</p>
          <div class="d-flex align-items-center text-white gap-2">
            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="2" cy="2" r="2" fill="white"/>
            </svg>
            <span>Jakarta:</span>
          </div>
          <div class="text-white mb-1">
            Jl. Letjen Suprapto No. L 20 D RT 001 RW 003 Harapan Mulya, Kecamatan Kemayoran, Kota Jakarta Pusat
          </div>
          <div class="d-flex align-items-center text-white gap-2">
            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="2" cy="2" r="2" fill="white"/>
            </svg>
            <span>Bali:</span>
          </div>
          <div class="text-white mb-2">
            Perum Taman Mutiara Blok A No. 21 A Pemecutan Klod Denpasar Barat Kota Denpasar
          </div>
          <div class="d-flex align-items-center text-white gap-2 fw-bold">
            <span>Office</span>
          </div>
          <div class="text-white">
            Jl. Bandengan Selatan No. 43, Komplek Puri Delta Mas Blok C No. 36, Pejagalan, Penjaringan, Jakarta Utara
          </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-2 text-white position-relative" style="z-index: 2">
          <p class="fw-bold">Contact</p>
          @foreach ($contacts as $contact)
            <div class="mb-1">{{ $contact->label }}: {{ $contact->value }}</div>
          @endforeach
          <div class="fw-bold my-3">Social Media</div>
          <div class="d-flex align-items-center gap-1">
            @foreach ($socials as $social)
              <img src="{{ asset("instagram.png") }}" class="img-fluid" width="30" height="30" alt="instagram obitrans indonesia">
              {{ $social->value }}
            @endforeach
          </div>
        </div>
      </div>
      <div class="box-group-contact">
        <img src="{{ asset("box-group-bottom.png") }}" alt="box">
      </div>
    </div>
    <div class="right">
      <p class="text-dark fw-bold fs-5">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan.</p>
      <div class="d-flex flex-column gap-1 mt-3 mb-3">
        <label for="rent" style="color: #3A3A3A">Pilih Jenis Sewa</label>
        <select name="rent" id="rent" class="form-control">
          <option value="Corporate" selected>Corporate</option>
          <option value="Hariaan Bali">Harian Bali</option>
        </select>
      </div>
      <div class="d-flex flex-column gap-1 mt-3 mb-3">
        <label for="name" style="color: #3A3A3A">Nama / Nama Perusahaan</label>
        <input type="text" autocomplete="off" class="form-control" name="name" id="name" placeholder="Masukkan nama Anda / Perusahaan Anda" style="border-radius: 12px; height: 44px">
      </div>
      <div class="d-flex flex-column gap-1 mb-3">
        <label for="phone" style="color: #3A3A3A">Hubungi Saya di nomor</label>
        <input type="text" autocomplete="off" class="form-control" name="phone" id="phone" placeholder="Masukkan nomor telepon Anda" style="border-radius: 12px; height: 44px">
      </div>
      <div class="d-flex flex-column gap-1 mb-3">
        <label for="email" style="color: #3A3A3A">Hubungi saya di email</label>
        <input type="text" autocomplete="off" class="form-control" name="email" id="email" placeholder="Masukan email Anda" style="border-radius: 12px; height: 44px">
      </div>
      <div class="d-flex flex-column gap-1 mb-3">
        <textarea name="message" id="message" rows="5" class="form-control overflow-hidden" style="border-radius: 12px" autocomplete="off"></textarea>
      </div>
      <div class="d-flex justify-content-end">
        <button class="button-send-message" onclick="sendEmail(this)">Kirim</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
  function sendEmail(element) {
    $(element).attr("disabled", true);
    $.ajax({
      url: "/contactme",
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        companyName: $("#name").val(),
        phone: $("#phone").val(),
        email: $("#email").val(),
        message: $("#message").val()
      },
      success: function(res) {
        alert(res.message);
        $(element).attr("disabled", false);
      },
      error: function(error) {
        $(element).attr("disabled", false);
      }
    });
  }
</script>
@endpush