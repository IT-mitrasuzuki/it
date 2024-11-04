@extends('..layouts.master')
@section('content')
 <style>
        #image {
            display: none;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            margin-top : 8px;
            margin-left:10px;
        }
    </style>
    <div class="container-fluid">
      <div class="row">
      <div class="col-sm">
          <h3>Detail Asset</h3>
        </div>
        <div class="col">
        <a href="{{ route('asset.index') }}" class="btn btn-primary">Daftar Asset</a>
        <a href="{{ route('asset.cari') }}" class="btn btn-primary">Cari Asset</a>
        <a href="{{ route('asset.create') }}" class="btn btn-success">Add New</a>
        <a href="{{ route('asset.edit',$asset->id_asset) }}" class="btn btn-warning">Update</a>
        <a href="{{ route('pindah.asset', $asset->id_asset) }}" class="btn btn-warning">Pindah Aset</a>
          <a href="{{ route('asset.index') }}" class="btn btn-danger">Back</a>
        </div>  
      </div>
      </div>
    </div>
        <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-md-2">
                    <div class="row">
                      <img src="{{asset('public/storage/asset/images/foto/'. $asset->foto) }}" alt="">
                      <div class="col">
                          <form id="upload-form" enctype="multipart/form-data">
                            <input type="hidden" name="id_asset" id="id_asset" value="{{ $asset->id_asset }}" required>
                            <input type="hidden" name="image_foto" id="image_foto" value="{{ $asset->id_asset }}">
                            <div>
                              <label class="custom-file-upload btn btn-primary">
                                  <input type="file" id="image" name="image">
                                  Upload
                              </label>
                              <button type="button" class="btn btn-danger" id="resetImageBtn">Reset </button>
                            </div>
                          </form>
                        </div>  
                      </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                  <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Aset</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">History</a>
  </li>
</ul>

<div class="tab-content pt-3" id="tab-content">
<div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                        <h2><b>{{ $asset->kode_asset}}</b></h2>
                       
                        <table class="table table-bordered table-striped">
                          <tr>
                            <td><b>Tanggal Pembelian</td>
                            <td>{{ $asset->tanggal_beli}}</td>
                          </tr>
                          <tr>
                            <td><b>Kategori</td>
                            <td>{{  $asset->id_kategori == '1' ? "FURNITURE" : ($asset->id_kategori == '2' ? "ELEKTRONIK" : "UMUM") }}</td>
                          </tr>
                          <tr>
                            <td><b>Nama Asset</td>
                            <td>{{ $asset->nama_asset}}</td>
                          </tr>
                          <tr>
                            <td><b>Merk atau Tipe</td>
                            <td>{{ $asset->merk}}</td>
                          </tr>
                          <tr>
                            <td><b>Spesifikasi</td>
                            <td>{{ $asset->sfesifikasi}}</td>
                          </tr>
                          <tr>
                            <td><b>Kelengkapan</td>
                            <td>{{ $asset->kelengkapan}}</td>
                          </tr>
                          <tr>
                            <td><b>Pengguna</td>
                            <td>{{ $asset->nama_pegawai}}</td>
                          </tr>
                          <tr>
                            <td><b>Divisi</td>
                            <td>{{ $asset->nama_divisi}}</td>
                          </tr>
                          <tr>
                            <td><b>Cabang</td>
                            <td>{{ $asset->nama_cabang}}</td>
                          </tr>
                          <tr>
                            <td><b>Lokasi</td>
                            <td>{{ $asset->lokasi}}</td>
                          </tr>
                          <tr>
                            <td><b>Kondisi</td>
                            <td>{{  $asset->kondisi == '1' ? "BAIK" : ($asset->kondisi == '2' ? "KURANG BAIK" : "RUSAK") }}</td>
                          </tr>
                          <tr>
                            <td><b>Keterangan Kondisi</td>
                            <td>{{ $asset->keterangan_kondisi}}</td>
                          </tr>
                          <tr>
                            <td><b>Status</td>
                            <td>{{  $asset->kondisi == '1' ? "AKTIF" : "DIMUSNAHKAN" }}</td>
                          </tr>
                          <tr>
                            <td><b>Tanggal Pemusnahan</td>
                            <td>{{ $asset->tgl_musnah}}</td>
                          </tr>
                          <tr>
                            <td><b>Expire Date</td>
                            <td>{{ $asset->expire_date}}</td>
                          </tr>

                        </table>
                        </div>
  <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
  <table class="table table-bordered table-striped">
    <thead>
                          <tr>
                            <td>Dari</td>
                            <td>Ke</td>
                            <td>Tanggal</td>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                          @foreach ($history as $history) 
                            <td>{{ $history->dari_pegawai }}</td>
                            <td>{{ $history->ke_pegawai }}</td>
                            <td>{{ $history->tanggal }}</td>
                          </tr>
                          @endforeach
                          </tbody>
                        </table>


  </div>  
              </div>
            </div>
        </div>
@endsection
@push('script')
<script>

  $(document).ready(function (e) {
    // Set CSRF token in AJAX request headers
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image').on('change', function () {
        var formData = new FormData($('#upload-form')[0]);

        $.ajax({
            type: 'POST',
            url: "{{ route('upload.image') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                        if (response.success) {
                            toastr.success('Foto berhasil di upload!');
                        } else {
                            toastr.error('Foto gagal di upload!');
                         }
                     },
                    error: function (response) {
                        toastr.error('Ada kesalahan!');
                    }
        });
    });

    $('#resetImageBtn').on('click', function () {
      var formData = new FormData($('#upload-form')[0]);

        $.ajax({
            type: 'POST',
            url: "{{ route('reset.image') }}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response) {
              if (response.success) {
                            toastr.success('Foto berhasil di Reset!');
                        } else {
                            toastr.error('Foto gagal di Reset!');
                         }
                     },
            error: function (response) {
              toastr.error('Ada kesalahan!');
            }
        });
    });
});
    </script>

@endpush

