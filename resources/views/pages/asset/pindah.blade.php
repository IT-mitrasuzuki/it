@extends('..layouts.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
 
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-11">
          <h4>Pindah Aset</h4>
        </div>
        <div class="col">
          <a href="{{ route('asset.index') }}" class="btn btn-primary">Back</a>
        </div>  
      </div>
    </div>
    <hr>
        <div class="card-body">
          <form action="{{ route('asset.update',$asset->id_asset) }}" method="POST"> 
            
              <div class="container">
                  <div>

                        <h4><b>PINDAH ASET :{{ $asset->kode_asset}}</b></h4>
                       
                        <table class="table table-bordered table-striped">
                          <tr>
                            <td><b>Tanggal Pembelian</td>
                            <td>{{ $asset->tanggal_beli}}</td>
                            <td><b>Kategori</td>
                            <td>{{  $asset->id_kategori == '1' ? "FURNITURE" : ($asset->id_kategori == '2' ? "ELEKTRONIK" : "UMUM") }}</td>
                            <td><b>Nama Asset</td>
                            <td>{{ $asset->nama_asset}}</td>
                          </tr>
                          <tr>
                            <td><b>Spesifikasi</td>
                            <td>{{ $asset->sfesifikasi}}</td>
                            <td><b>Pengguna</td>
                            <td>{{ $asset->nama_pegawai}}</td>
                            <td><b>Divisi</td>
                            <td>{{ $asset->nama_divisi}}</td>
                          </tr>
                          <tr>
                            <td><b>Cabang</td>
                            <td>{{ $asset->nama_cabang}}</td>
                            <td><b>Lokasi</td>
                            <td>{{ $asset->lokasi}}</td>
                            <td><b>Kondisi</td>
                            <td>{{  $asset->kondisi == '1' ? "AKTIF" :  "DIMUSNAHKAN" }}</td>
                          </tr>
                        </table>
                        </form>
               

                <h4>Pindah Ke</h4>
                <form action="{{ route('pindah.asset.update', $asset->id_asset) }}" method="POST">
                @csrf  @method('PUT')
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                            Nama Pegawai
                          <select name="pegawai" id="pegawai_select" class="form-control">
                            
                          </select>
                          <input type="text" value="{{ $asset->kode_pegawai }}" name="kode_pegawai" id="kode_pegawai" hidden>
                          <input type="text" value="{{ $asset->kode_divisi}}" name="kode_divisi" id="kode_divisi" hidden>
                          <input type="text" value="{{ $asset->kode_cabang}}" name="kode_cabang" id="kode_cabang" hidden>
                          <input type="text" value="{{ $asset->id_asset}}" name="id_asset" hidden>
                          <input type="text" value="{{ $asset->kode_pegawai}}" name="dari" hidden>
                          <input type="text" value="{{ auth()->user()->nama }}" name="dibuat" hidden>
                          <input type="date" value="{{ $Date_now }}" name="tgl_buat"  hidden>
                        </div>
                      </div>
                    </div>
                        <div class="form-group">
                        Tanggal Pindah
                          <input type="date" class="form-control" name="tanggal_pindah">
                        </div>
                    </div>
                    
                  <div class="col-sm-12 col-md-6">

                        <div class="form-group">
                          Lokasi
                          <input type="text" class="form-control" value="{{ $asset->lokasi}}" name="lokasi">
                        </div>
                          <div class="form-group">
                            Kondisi
                            <select name="kondisi" id="kondisi" class="form-control">
                              <option value="{{ $asset->kondisi }}" selected hidden>{{  $asset->kondisi == '0' ? "BAIK" : ($asset->kondisi == '1' ? "RUSAK" : "BATERAI DROP") }}</option>
                              <option value="0">BAIK</option>
                              <option value="1">RUSAK</option>
                              <option value="2">BATERAI DROP</option>
                            </select>
                          </div>
                      </div>
              </div>
            </div>
                
            <div class="row">
              <div class="col">
                <div class="form-group">
                        <button type="submit" class="btn btn-primary">Pindah</button>
                        </div>
                </div>
            </div>
          </form> 

                     
                        
              </div>
            </div>
         
        </div>
    
@endsection
@push('script')
<script>

$(document).ready(function(){
        $('#pegawai_select').select2({
            minimumInputLength:2,
            placeholder:'-- Pilih Pegawai --',
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