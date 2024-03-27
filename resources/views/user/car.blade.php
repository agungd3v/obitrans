@extends("layouts.user-layout")
@section("car", "active")

@push("style")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/data-tables/datatables.min.css") }}">
<style>
  .dataTable {
    width: 100% !important;
  }
  .dataTables_empty {
    padding-top: 40px;
  }
</style>
@endpush

@section("content")
@if (session()->has("error"))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <span>{{ session()->get("error") }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has("success"))
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <span>{{ session()->get("success") }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Unit Baru</button>
        <div class="w-full mt-3">
          <table id="table">
            <thead>
              <tr>
                <th class=""></th>
                <th class="">Nama Mobil</th>
                <th class="">Bahan Bakar</th>
                <th class="">Persneling</th>
                <th class="">Kapasitas</th>
                <th class="">Jenis Sewa</th>
                <th class="">Biaya Sewa</th>
                <th class="">Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="add" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Unit Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route("car.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="rent">Sewa Untuk</label>
            <select name="rent" id="rent" class="form-control">
              <option value="" selected>Pilih Sewa</option>
              @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->label }}</option>
              @endforeach
            </select>
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="label">Nama Unit</label>
            <input type="text" name="label" id="label" class="form-control" autocomplete="off">
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="fuel">Bahan Bakar</label>
                <select name="fuel" id="fuel" class="form-control">
                  <option value="" selected>Pilih Bahan Bakar</option>
                  <option value="Bensin">Bensin</option>
                  <option value="Listrik">Listrik</option>
                  <option value="Solar">Solar</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="capacity">Kapasitas</label>
                <input type="text" class="form-control" name="capacity" id="capacity" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="gear">Persneling</label>
                <select name="gear" id="gear" class="form-control">
                  <option value="" selected>Pilih Persneling</option>
                  <option value="Manual">Manual</option>
                  <option value="Matic">Matic</option>
                </select>
              </div>
            </div>
          </div>
          <div class="d-none flex-column gap-1 mb-3" id="car_image">
            <label for="image">Gambar Unit</label>
            <input type="file" name="image" id="image" class="form-control" autocomplete="off">
          </div>
          <div class="d-none flex-column gap-1" id="rent_price">
            <label for="price">Harga per hari</label>
            <input type="text" name="price" id="price" class="form-control" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="change-photo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="show-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route("car.change.image") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="id-car" name="id" value="">
        <div class="modal-body">
          <img id="show-image" class="img-cover" src="" alt="">
          <div class="d-flex flex-column gap-1">
            <label for="new-photo">Foto Baru</label>
            <input type="file" class="form-control" id="new-photo" name="new-photo" autocomplete="off">
          </div>
          <div class="mt-3">
            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="update" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Unit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route("car.update") }}" method="POST">
        @method("PUT")
        @csrf
        <input type="hidden" name="rent_id" id="rent-id" value="">
        <div class="modal-body">
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="rent-update">Sewa Untuk</label>
            <select name="rent_update" id="rent-update" class="form-control">
              @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->label }}</option>
              @endforeach
            </select>
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="label-update">Nama Unit</label>
            <input type="text" name="label_update" id="label-update" class="form-control" autocomplete="off">
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="fuel-update">Bahan Bakar</label>
                <select name="fuel_update" id="fuel-update" class="form-control">
                  <option value="" selected>Pilih Bahan Bakar</option>
                  <option value="Bensin">Bensin</option>
                  <option value="Listrik">Listrik</option>
                  <option value="Solar">Solar</option>
                </select>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="capacity-update">Kapasitas</label>
                <input type="text" class="form-control" name="capacity_update" id="capacity-update" autocomplete="off">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="d-flex flex-column gap-1 mb-3">
                <label for="gear-update">Persneling</label>
                <select name="gear_update" id="gear-update" class="form-control">
                  <option value="" selected>Pilih Persneling</option>
                  <option value="Manual">Manual</option>
                  <option value="Matic">Matic</option>
                </select>
              </div>
            </div>
          </div>
          <div class="d-flex flex-column gap-1" id="rent_price-update">
            <label for="price-update">Harga per hari</label>
            <input type="text" name="price_update" id="price-update" class="form-control" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route("car.delete") }}" method="POST">
        @method("DELETE")
        @csrf
        <input type="hidden" id="id-car-delete" name="id" value="">
        <div class="modal-body pt-2">
          <div>
            Apakah kamu yakin ingin menghapus data <strong id="data-delete-label"></strong>
          </div>
          <div class="mt-3">
            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push("script")
<script src="{{ asset("assets/vendor/libs/data-tables/datatables.min.js") }}"></script>
<script>
  $("#rent").change(function() {
    if ($(this).val() === "2") {
      $("#rent_price").removeClass("d-none");
      $("#rent_price").addClass("d-flex");
    } else {
      $("#rent_price").removeClass("d-flex");
      $("#rent_price").addClass("d-none");
      $("#price").val("");
    }
    if ($(this).val() !== "") {
      $("#car_image").removeClass("d-none");
      $("#car_image").addClass("d-flex");
    } else {
      $("#car_image").removeClass("d-flex");
      $("#car_image").addClass("d-none");
    }
  });

  $("#table").DataTable({
    serverSide: true,
    processing: true,
    lengthChange: true,
    searching: true,
    info: true,
    order: [],
    pageLength: 10,
    lengthMenu: [10, 20, 50, 100],
    bSort: false,
    oLanguage: {
      sSearch: '<i class="fa fa-search" aria-hidden="true"></i>',
      oPaginate: {
        sPrevious: "Prev"
      }
    },
    dom: `
      <'row'<'col-sm-6'<'flex items-center action_btn gap-2'>><'col-sm-6'f>>
      <'row'<'col-sm-12 my-3'tr>>
      <'row'<'col-sm-6'<'flex items-center gap-2'li>><'col-sm-6'p>>
    `,
    ajax: {
      url: "{{ route('car.data') }}",
      type: "GET",
      beforeSend: function() {},
      data: function(d) {},
      error: function(e) {},
      complete: function(response) {},
    },
    columns: [
      {data: "image", render: function(data, type, row, meta) {
        return `
          <div class="p-1 rounded position-relative overflow-hidden car-image" style="z-index: 9; top: -14px; left: 24px; width: 150px; height: 100px; background: #D8E3FF">
            <img src="/${data}" class="w-100 h-100 object-cover" />
            <div class="position-absolute w-100 h-100 d-none d-flex justify-content-center align-items-center" style="z-index: 10; top: 0; left: 0; background: rgba(0, 0, 0, 0.3)">
              <button class="btn btn-sm btn-primary" data-bs-toggle="modal" onclick="changePhoto('${row.id}', '${row.image}', '${row.label}')" data-bs-target="#change-photo">Ubah Foto</button>
            </div>
          </div>
        `;
      }},
      {data: "label"},
      {data: "fuel"},
      {data: "gear"},
      {data: "capacity", render: function(data, type, row, meta) {
        return data + " Orang"
      }},
      {data: "type_id", render: function(data, type, row, meta) {
        return row.type.label;
      }},
      {data: "price_per_day", render: function(data, type, row, meta) {
        return data == "0" ? "-" : Intl.NumberFormat('id-ID',
          { style: 'currency', currency: 'IDR' }
        ).format(data).split(",")[0];
      }},
      {data: "action", render: function (data, type, row, meta) {
        return `
          <div class="text-nowrap">
            <button class="btn btn-sm btn-success" style="padding: 6px 12px; border-radius: 8px" onclick="showData('${row.id}')" data-bs-toggle="modal" data-bs-target="#update">
              <div class="flex items-center gap-1">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <mask id="mask0_1797_10419" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="1" y="1" width="14" height="14">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M13.8058 3.75417C14.0658 4.01417 14.0658 4.43417 13.8058 4.69417L12.5858 5.91417L10.0858 3.41417L11.3058 2.19417C11.4304 2.06933 11.5995 1.99918 11.7758 1.99918C11.9522 1.99918 12.1213 2.06933 12.2458 2.19417L13.8058 3.75417ZM1.99915 13.6675V11.6408C1.99915 11.5475 2.03248 11.4675 2.09915 11.4008L9.37248 4.1275L11.8725 6.6275L4.59248 13.9008C4.53248 13.9675 4.44581 14.0008 4.35915 14.0008H2.33248C2.14581 14.0008 1.99915 13.8542 1.99915 13.6675Z" fill="black"/>
                  </mask>
                  <g mask="url(#mask0_1797_10419)">
                  <rect width="16" height="16" fill="#FFF"/>
                  </g>
                </svg>
                <span class="text-white" style="font-size: 14px !important">Ubah</span>
              </div>
            </button>
            <button class="btn btn-sm btn-danger" style="padding: 6px 12px; border-radius: 8px" onclick="deleteData('${row.id}', '${row.label}')" data-bs-toggle="modal" data-bs-target="#delete">
              <div class="flex items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <mask id="mask0_1900_17101" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="3" y="2" width="10" height="12">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.3334 2.66667H12C12.3667 2.66667 12.6667 2.96667 12.6667 3.33333C12.6667 3.7 12.3667 4 12 4H4.00004C3.63337 4 3.33337 3.7 3.33337 3.33333C3.33337 2.96667 3.63337 2.66667 4.00004 2.66667H5.66671L6.14004 2.19333C6.26004 2.07333 6.43337 2 6.60671 2H9.39337C9.56671 2 9.74004 2.07333 9.86004 2.19333L10.3334 2.66667ZM5.33337 14C4.60004 14 4.00004 13.4 4.00004 12.6667V6C4.00004 5.26667 4.60004 4.66667 5.33337 4.66667H10.6667C11.4 4.66667 12 5.26667 12 6V12.6667C12 13.4 11.4 14 10.6667 14H5.33337Z" fill="black"/>
                  </mask>
                  <g mask="url(#mask0_1900_17101)">
                  <rect width="16" height="16" fill="#FFF"/>
                  </g>
                </svg>
                <span class="text-white" style="font-size: 14px !important">Hapus</span>
              </div>
            </button>
          </div>
        `
      }}
    ],
    fnInfoCallback: function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
      $(".car-image").on("mouseenter", function() {
        $(this).children()[1].classList.remove("d-none");
      });
      $(".car-image").on("mouseleave", function() {
        $(this).children()[1].classList.add("d-none");
      });

      if (iTotal != 0) {
        return `Menampilkan ${iStart} - ${iEnd} dari total ${iTotal} entries`;
      }
      return `Tidak ada data tersedia di tabel`;
    }
  });

  $(".dataTables_filter input[type='search']").attr("placeholder", "Cari");
  $(".dataTables_filter input[type='search']").on("keyup", function() {
    if ($(this).val() !== "") {
      $(".dataTables_filter label i").attr("style", "display: none")
    } else {
      $(".dataTables_filter label i").attr("style", "")
    }
  });

  function changePhoto(id, imageUrl, title) {
    $("#show-image").attr("src", "/" + imageUrl);
    $("#show-title").text(title);
    $("#id-car").val(id);
  }

  function showData(id) {
    $.get(`/user/car/show/${id}`, function(response, status) {
      console.log(response);
      if (status == "success") {
        $("#rent-id").val(response.data.id);
        $("#rent-update").val(response.data.type_id);
        $("#label-update").val(response.data.label);
        $("#fuel-update").val(response.data.fuel);
        $("#capacity-update").val(response.data.capacity);
        $("#gear-update").val(response.data.gear);
        $("#price-update").val(response.data.price_per_day);
      }
    });
  }

  function deleteData(id, title) {
    $("#id-car-delete").val(id);
    $("#data-delete-label").text(title + "!");
  }
</script>
@endpush