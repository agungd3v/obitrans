@extends("layouts.user-layout")
@section("gallery", "active")

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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Tambah Gambar Baru</button>
        <div class="row">
          @forelse ($galleries as $gallery)
            <div class="col-sm-12 col-md-3 mt-3">
              <img src="/{{ $gallery->path }}" class="img-fluid" alt="">
              <div class="mt-2">
                <button class="w-100 btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="deleteImage({{ $gallery->id }})">Hapus Gambar</button>
              </div>
            </div>
          @empty
            <div class="text-center mt-3">Belum ada gambar yang di tambahkan</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="add" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Gambar Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route("gallery.store") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="file" class="form-control" name="image">
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
      <form action="{{ route("gallery.delete") }}" method="POST">
        @method("DELETE")
        @csrf
        <input type="hidden" id="gallery_id" name="id" value="">
        <div class="modal-body pt-2">
          <div>
            Apakah kamu yakin ingin menghapus gambar ini?
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

@push('script')
<script>
  function deleteImage(id) {
    $("#gallery_id").val(id);
  }
</script>
@endpush
