@extends('..layouts.master')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <img src="{{asset('AdminLTE')}}/dist/img/finger.png" alt=""><h3><b>Detail Asset</b></h3>
      <hr>
    </div>   
  </div>
</div>

<div class="card-body">
  <div class="table-responsive">
    <div class="row mb-3">
      <div class="col-md-3">
        <select id="filter-cabang" class="form-control">
          <option value="">Select Cabang</option>
          @foreach ($cabang as $cabang)
            <option value="{{ $cabang->nama }}">{{ $cabang->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select id="filter-divisi" class="form-control">
          <option value="">Select Divisi</option>
          @foreach ($divisi as $divisi)
            <option value="{{ $divisi->divisi }}">{{ $divisi->divisi }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <table id="data-asset" class="table table-bordered table-striped" style="text-align: center">
      <thead>
        <tr>
          <th>Kode Aset</th>
          <th>Tanggal Beli</th>
          <th>Nama Aset</th>
          <th>Spesifikasi</th>
          <th>Pegawai</th>
          <th>Divisi</th>
          <th>Cabang</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($asset as $asset)
          <tr>
            <td>{{ $asset->kode_asset}}</td>
            <td>{{ $asset->tanggal_beli }}</td>
            <td>{{ $asset->nama_asset}}</td>
            <td>{{ $asset->sfesifikasi}}</td>
            <td>{{ $asset->nama_pegawai}}</td>
            <td>{{ $asset->divisi}}</td>
            <td>{{ $asset->cabang}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</section>

@endsection

@push('script')
<script>
  $(document).ready(function(){
    var table = $('#data-asset').DataTable({
      lengthChange: false,
      lengthMenu: [6],
      "ordering": false,
    });

    $('#filter-cabang').on('change', function() {
      table.column(6).search(this.value).draw();
    });

    $('#filter-divisi').on('change', function() {
      table.column(5).search(this.value).draw();
    });
  });
</script>
@endpush
