@extends('..layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
<style>
  .select2-container .select2-selection--single {
    height: calc(2.25rem + 2px);
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
    line-height: 1.5;
}

.select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
    height: calc(2.25rem + 2px);
}

</style>
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-sm-8">
          <div class="d-flex align-items-center">
            <h1><i class="bi bi-clipboard2-plus me-3"></i></h1>
            <h3><b>Add New Asset</b></h3>
          </div>   
        </div>
      </div><hr>
    </div>
    
        <div class="card-body">
          <form action="{{ route('asset.store') }}" method="POST"> @csrf
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          Tanggal Beli
                          <input type="date" class="form-control" name="tanggal_beli">
                          <input type="text" class="form-control" value="{{ $year }}" name="tahun" hidden>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group xs-2">
                          Tanggal Pemusnahan
                          <input type="date" class="form-control" name="tgl_musnah">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          Expired Date
                          <input type="date" class="form-control" name="expire_date">
                        </div>
                      </div>
                    </div>
                        <div class="form-group">
                            Nama Pegawai
                          <select name="pegawai_select" id="pegawai_select" class="form-control select2">
                           
                          </select>
                          <input type="text" id="kode_pegawai" name="kode_pegawai" value="" hidden>
                          <input type="text" id="kode_divisi" name="kode_divisi" value="" hidden>
                          <input type="text" id="kode_cabang" name="kode_cabang" hidden>
                          <input type="text" id="dibuat" value="{{ auth()->user()->nama }}" name="dibuat" hidden>
                          <input type="text" id="tgl_buat" value="{{ $date }}" name="tgl_buat" hidden>
                        </div>
                    </div>
                    
                  <div class="col-sm-12 col-md-6">

                        <div class="form-group">
                          Nama Aset
                          <input type="text" class="form-control" name="nama_asset">
                        </div>
                
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                          Kategori
                            <select name="id_kategori" id="id_kategori" class="form-control">
                              <option value="" selected hidden>-- Pilih Kategori --</option>
                              <option value="1">FURNITURE</option>
                              <option value="2">ELEKTRONIK</option>
                              <option value="3">UMUM</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Merk
                            <input type="text" class="form-control" name="merk">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            Spesifikasi
                            <input type="text" class="form-control" name="sfesifikasi">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Kelengkapan
                            <input type="text" class="form-control" name="kelengkapan">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            Lokasi
                            <input type="text" class="form-control" name="lokasi">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Keterangan Kondisi
                            <input type="text" class="form-control" name="keterangan_kondisi">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <select name="kondisi" id="kondisi" class="form-control">
                              <option value="" selected hidden>-- Pilih Kondisi --</option>
                              <option value="1">Baik</option>
                              <option value="2">Kurang Baik</option>
                              <option value="3">Rusak</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <select name="status" id="status" class="form-control">
                              <option value="1" selected hidden>AKTIF</option>
                              <option value="1">AKTIF</option>
                              <option value="2">DIMUSNAHKAN</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
            <div class="row">
              <div class="col">
                <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('asset.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                </div>
            </div>
          </form>
        </div>
        
@endsection
@push('script')
<script>
  $(document).ready(function(){
        $('#pegawai_select').select2({
            minimumInputLength:2,
            placeholder:'-- Pilih Pegawai --',
            theme: 'bootstrap5',
            ajax:{
                url: "{{ route('select-pegawai') }}",
                dataType:'json',
                processResults:data=>{
                    
                    return {
                        results:data.map(res=>{
                            return {text:res.nama,id:res.kode_pegawai}
                        })
                    }
                }
            }
        })

    })
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#pegawai_select').change(function() {
            var kode_pegawai = $(this).val();
            if (kode_pegawai) {
                $.ajax({
                    url: "{{ route('search-pegawai') }}",
                    type: "GET",
                    data: { kode_pegawai: kode_pegawai },
                    success: function(data) {
                        $('#kode_pegawai').val(data.kode_pegawai);
                        $('#kode_divisi').val(data.kode_divisi);
                        $('#kode_cabang').val(data.kode_cabang);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + error); 
                    }
                });
            } else {
              $('#kode_pegawai').val('kosong');
              $('#kode_divisi').val('kosong');
              $('#kode_cabang').val('kosong');
            }
        });
    });
</script>
@endpush
