@extends('..layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <div class="d-flex align-items-center">
                <h1><i class="bi bi-file-bar-graph me-2"></i></h1>
                <h3>Laporan Asset</h3>
            </div>
        </div>
    </div><hr>
</div>

    <div class="card-body">
        <form action="{{ route('export-asset') }}" method="GET">
            @csrf
            <div class="form-group row">
                <label for="cabang" class="col-sm-2 col-form-label">Cabang</label>
                <div class="col-sm-3">
                    <select name="cabang" id="cabang" class="form-control">
                        <option value="0">ALL</option>
                        @foreach ($cabang as $cabangOption)
                            <option value="{{ $cabangOption->kode }}">{{ $cabangOption->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="divisi" class="col-sm-2 col-form-label">Divisi</label>
                <div class="col-sm-3">
                    <select name="divisi" id="divisi" class="form-control">
                        <option value="0">ALL</option>
                        @foreach ($divisi as $divisiOption)
                            <option value="{{ $divisiOption->kode }}">{{ $divisiOption->divisi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-success">Excel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
