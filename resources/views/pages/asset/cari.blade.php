@extends('..layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <div class="d-flex align-items-center">
                <h1><i class="bi bi-search me-3"></i></h1>
                <h3><b>Cari Asset</b></h3>
            </div>
        </div>   
    </div>
    <hr>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table id="asset-table" class="table table-bordered table-striped rounded-3" style="text-align: center">
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Tanggal Beli</th>
                    <th>Nama Aset</th>
                    <th>Spesifikasi</th>
                    <th>Pegawai</th>
                    <th>Divisi</th>
                    <th>Cabang</th>
                    <th width="130px"></th>
                </tr>
                <tr class="filters">
                    <th><input type="text" class="form-control"  data-column="0"></th>
                    <th><input type="text" class="form-control"  data-column="1"></th>
                    <th><input type="text" class="form-control"  data-column="2"></th>
                    <th><input type="text" class="form-control"  data-column="3"></th>
                    <th><input type="text" class="form-control"  data-column="4"></th>
                    <th>
                        <div class="dropdown">
                            <select class="form-control select-filter custom-select" data-column="5">
                                <option value=""></option>
                                @foreach($divisi as $dvs)
                                <option value="{{$dvs->divisi}}">{{$dvs->divisi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown">
                            <select class="form-control select-filter custom-select" data-column="6">
                                <option value=""></option>
                                @foreach($cabang as $cbg)
                                <option value="{{$cbg->nama}}">{{$cbg->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        var table = $('#asset-table').DataTable({
            responsive: true,
            lengthChange: false,
            lengthMenu: [10, 25, 50, 100],
            ordering: false, // Disable ordering on columns
            dom: 'lrtp',
            ajax: {
                url: "{{ route('asset.getCari') }}",
                dataSrc: 'data' // Assuming the data is in 'data' key of JSON response
            },
            columns: [
                { data: 'kode_asset', name: 'kode_asset' },
                { data: 'tanggal_beli', name: 'tanggal_beli' },
                { data: 'nama_asset', name: 'nama_asset' },
                { data: 'sfesifikasi', name: 'sfesifikasi' },
                { data: 'nama_pegawai', name: 'nama_pegawai' },
                { data: 'divisi', name: 'divisi' },
                { data: 'cabang', name: 'cabang' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return `
                            <form action="{{ route('asset.destroy', ':id') }}" method="POST">
                                <a class="btn" href="{{ route('asset.show', ':id') }}" title="Detail"><i class="bi bi-eye-fill"></i></a>
                                <a class="btn" href="{{ route('asset.edit', ':id') }}" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" title="Delete"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `.replace(/:id/g, full.id_asset); // Replace :id with actual ID
                    }
                }
            ]
        });
        
        // Apply the search
        $('.filters input, .filters select').on('keyup change', function () {
            let colIdx = $(this).data('column');
            table.column(colIdx).search(this.value).draw();
        });
    });
</script>
@endpush
