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
      <div class="row">
        <div>
          <img src="{{asset('AdminLTE')}}/dist/img/finger.png" alt=""><h4><b>Edit Asset</b></h4>
          <hr>
        </div>   
      </div>
    </div>
        <div class="card-body">
          <form action="{{ route('asset.update',$asset->id_asset) }}" method="POST"> 
          @csrf
                        @method('PUT')
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          Tanggal Beli
                          <input type="date" class="form-control" value="{{ $asset->tanggal_beli}}" name="tanggal_beli">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group xs-2">
                          Tanggal Pemusnahan
                          <input type="date" class="form-control" value="{{ $asset->tgl_musnah}}" name="tgl_musnah">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          Expired Date
                          <input type="date" class="form-control" value="{{ $asset->expire_date}}" name="expire_date">
                        </div>
                      </div>
                    </div>
                        <div class="form-group">
                            Nama Pegawai
                          <select name="pegawai" id="pegawai_select" class="pegawai_select form-control select2">
                            
                          </select>
                          <input type="text" value="{{ $asset->kode_pegawai}}" name="kode_pegawai" id="kode_pegawai" hidden>
                          <input type="text" value="{{ $asset->kode_divisi}}" name="kode_divisi" id="kode_divisi" hidden>
                          <input type="text" value="{{ $asset->kode_cabang}}" name="kode_cabang" id="kode_cabang" hidden>
                        </div>
                    </div>
                    
                  <div class="col-sm-12 col-md-6">

                        <div class="form-group">
                          Nama Aset
                          <input type="text" class="form-control" value="{{ $asset->nama_asset}}" name="nama_asset">
                        </div>
                
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                          Kategori
                            <select name="id_kategori" id="id_kategori" class="form-control">
                              <option value="{{ $asset->id_kategori}}" selected hidden>{{  $asset->id_kategori == '1' ? "FURNITURE" : ($asset->id_kategori == '2' ? "ELEKTRONIK" : "UMUM") }}</option>
                              <option value="1">FURNITURE</option>
                              <option value="2">ELEKTRONIK</option>
                              <option value="3">UMUM</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Merk
                            <input type="text" class="form-control" value="{{ $asset->merk}}" name="merk">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            Spesifikasi
                            <input type="text" class="form-control" value="{{ $asset->sfesifikasi}}" name="sfesifikasi">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Kelengkapan
                            <input type="text" class="form-control" value="{{ $asset->kelengkapan}}" name="kelengkapan">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            Lokasi
                            <input type="text" class="form-control" value="{{ $asset->lokasi}}" name="lokasi">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            Keterangan Kondisi
                            <input type="text" class="form-control" value="{{ $asset->keterangan_kondisi}}" name="keterangan_kondisi">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="">Kondisi</label>
                            <select name="kondisi" id="kondisi" class="form-control">
                              <option value="{{ $asset->kondisi}}" selected hidden>{{  $asset->kondisi == '1' ? "BAIK" : ($asset->kondisi == '2' ? "KURANG BAIK" : "RUSAK") }}</option>
                              <option value="1">BAIK</option>
                              <option value="2">KURANG BAIK</option>
                              <option value="3">RUSAK</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                              <option value="{{ $asset->status}}" selected hidden>{{  $asset->kondisi == '1' ? "AKTIF" :  "DIMUSNAHKAN" }}</option>
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
                <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('asset.cari') }}" class="btn btn-danger">Kembali</a>
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
