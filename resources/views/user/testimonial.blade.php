@extends("layouts.user-layout")
@section("testimonial", "active")

@push("style")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/data-tables/datatables.min.css") }}">
<style>
  .dataTable {
    width: 100% !important;
  }
  .dataTables_empty {
    padding-top: 40px;
  }
  .dataTable tr td {
    padding: 10px;
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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Testimoni</button>
        <div class="w-full mt-3">
          <table id="table">
            <thead>
              <tr>
                <th class="">Author</th>
                <th class="">Testimonial</th>
                <th class=""></th>
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
        <h5 class="modal-title">Tambah Testimonial</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route("testimonial.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="flex-column gap-1 mb-3">
            <label for="author_image">Foto Author (optional)</label>
            <input type="file" name="author_image" id="author_image" class="form-control" autocomplete="off">
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="author_name">Nama Author</label>
            <input type="text" name="author_name" id="author_name" class="form-control" autocomplete="off">
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="content">Testimoni</label>
            <textarea type="text" name="content" rows="5" id="content" class="form-control" autocomplete="off"></textarea>
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
      <form action="{{ route("testimonial.delete") }}" method="POST">
        @method("DELETE")
        @csrf
        <input type="hidden" id="delete_testimoni_id" name="id" value="">
        <div class="modal-body pt-2">
          <div>
            Apakah kamu yakin ingin menghapus testimonial ini?
          </div>
          <div class="mt-3">
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
      url: "{{ route('testimonial.data') }}",
      type: "GET",
      beforeSend: function() {},
      data: function(d) {},
      error: function(e) {},
      complete: function(response) {},
    },
    columns: [
      {data: "author_name", render: function(data, type, row, meta) {
        return `
          <div class="d-flex align-items-center gap-2">
            <img src="/${row.author_image ?? "photo_empty.png"}" style="width: 40px; height: 40px; border-radius: 999px; object-fit: cover" />
            <span style="text-wrap: nowrap">${row.author_name}</span>
          </div>
        `;
      }},
      {data: "content", render: function(data, type, row, meta) {
        return row.content;
      }},
      {data: "action", render: function (data, type, row, meta) {
        return `
          <div class="text-nowrap">
            <button class="btn btn-sm btn-danger" style="padding: 6px 12px; border-radius: 8px" onclick="deleteData('${row.id}')" data-bs-toggle="modal" data-bs-target="#delete">
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

  function deleteData(id) {
    $("#delete_testimoni_id").val(id);
  }
</script>
@endpush