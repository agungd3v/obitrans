@extends("layouts.user-layout")
@section("service", "active")

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

@section('content')
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
        <div class="w-full mt-3">
          <table id="table" class="table">
            <thead>
              <tr>
                <th class="">Icon</th>
                <th class="">Service Title</th>
                <th class="">Service</th>
                <th class=""></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route("service.update") }}" method="POST" enctype="multipart/form-data">
        @method("PUT")
        @csrf
        <input type="hidden" name="id" id="service_id">
        <div class="modal-body">
          <div class="flex-column gap-1 mb-3">
            <label for="image_icon">Icon Layanan (optional)</label>
            <input type="file" name="image_icon" id="image_icon" class="form-control" autocomplete="off">
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="title">Title Layanan</label>
            <input type="text" name="title" id="title" class="form-control" autocomplete="off">
          </div>
          <div class="d-flex flex-column gap-1 mb-3">
            <label for="content">Layanan</label>
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
      url: "{{ route('service.data') }}",
      type: "GET",
      beforeSend: function() {},
      data: function(d) {},
      error: function(e) {},
      complete: function(response) {},
    },
    columns: [
      {data: "image_icon", render: function(data, type, row, meta) {
        return `
          <div class="d-flex align-items-center gap-2" style="width: 60px">
            <img src="/${data ?? "photo_empty.png"}" style="width: 50px; height: 50px; object-fit: cover" />
          </div>
        `;
      }},
      {data: "title", render: function(data, type, row, meta) {
        return data;
      }},
      {data: "content", render: function(data, type, row, meta) {
        return data;
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
    $.get(`/user/service/data/${id}`, function(response, status) {
      console.log(response);
      if (status == "success") {
        $("#title").val(response.data.title);
        $("#content").val(response.data.content);
        $("#service_id").val(response.data.id);
      }
    });
  }

  function deleteData(id, title) {
    $("#id-car-delete").val(id);
    $("#data-delete-label").text(title + "!");
  }
</script>
@endpush