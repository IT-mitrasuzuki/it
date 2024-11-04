@extends('..layouts.master')

@section('content')
<div class="container">
    <!-- Content goes here if needed -->
</div>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <div class="d-flex align-items-center">
                <h1><i class="bi bi-card-list me-3"></i></h1>
                <h3><b>Detail Asset</b></h3>
            </div>
        </div>
        <div class="col-sm-4 d-flex justify-content-end">
            <div class="d-flex">
                <a href="{{ route('asset.create') }}" class="btn btn-primary mr-1">Add new</a>
                <a href="{{ route('asset.cari') }}" class="btn btn-secondary">Cari Asset</a>
                <!-- Add more buttons as needed -->
            </div>
        </div>
    </div><hr>
</div>
<div class="container-fluid">
    <div class="row">
       <!-- Sidebar -->
<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Search Filters</h5>
            <form>
                <div class="mb-3">
                    <input type="text" id="search-input" class="form-control" placeholder="Search">
                </div>
                <div class="mb-3">
                    <select id="search-divisi" class="form-control">
                        <option value="">Select Divisi</option>
                        <!-- Options will be dynamically generated -->
                    </select>
                </div>
                <div class="mb-3">
                    <select id="search-cabang" class="form-control">
                        <option value="">Select Cabang</option>
                        <!-- Options will be dynamically generated -->
                    </select>
                </div>
                <div class="mb-3">
                    <select id="search-kategori" class="form-control">
                        <option value="">Select Kategori</option>
                        <option value="1">FURNITURE</option>
                        <option value="2">ELEKTRONIK</option>
                        <option value="3">UMUM</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="col-sm-8">
            <!-- Card container for displaying asset details -->
            <div id="card-container">
                <div id="aset-cards">
                    <!-- Cards will be dynamically generated here -->
                </div>
            </div>
            <!-- Pagination controls -->
            <nav id="pagination-nav">
                <ul class="pagination justify-content-center">
                    <!-- Pagination links will be dynamically generated here -->
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function() {
    let currentPage = 1;

    function populateDropdowns(divisiOptions, cabangOptions) {
        const divisiSelect = $('#search-divisi');
        const cabangSelect = $('#search-cabang');

        // Store current selected values
        const selectedDivisi = divisiSelect.val();
        const selectedCabang = cabangSelect.val();

        // Clear and populate divisi dropdown
        divisiSelect.empty().append('<option value="">Select Divisi</option>');
        divisiOptions.forEach(function(divisi) {
            const option = `<option value="${divisi}">${divisi}</option>`;
            divisiSelect.append(option);
        });

        // Set selected value for divisi dropdown
        divisiSelect.val(selectedDivisi);

        // Clear and populate cabang dropdown
        cabangSelect.empty().append('<option value="">Select Cabang</option>');
        cabangOptions.forEach(function(cabang) {
            const option = `<option value="${cabang}">${cabang}</option>`;
            cabangSelect.append(option);
        });

        // Set selected value for cabang dropdown
        cabangSelect.val(selectedCabang);
    }

    function fetchAndRenderData(page = 1) {
        const searchText = $('#search-input').val().toLowerCase();
        const selectedDivisi = $('#search-divisi').val();
        const selectedCabang = $('#search-cabang').val();
        const selectedKategori = $('#search-kategori').val(); // Added id_kategori search

        $.ajax({
            url: "{{ route('asset.getData') }}",
            type: 'GET',
            data: {
                page: page,
                search: searchText,
                divisi: selectedDivisi,
                cabang: selectedCabang,
                id_kategori: selectedKategori // Include id_kategori in the request
            },
            success: function(response) {
                const assets = response.assets.data;
                const currentPage = response.assets.current_page;
                const lastPage = response.assets.last_page;
                const divisiOptions = response.divisiOptions;
                const cabangOptions = response.cabangOptions;

                // Clear existing cards and pagination
                $('#aset-cards').empty();
                $('#pagination-nav .pagination').empty();

                // Populate dropdowns on initial load
                if (page === 1) {
                    populateDropdowns(divisiOptions, cabangOptions);
                }

                if (assets.length === 0) {
                    $('#aset-cards').html('<p>No data available</p>');
                    $('#pagination-nav .pagination').html('');
                    return;
                }

                // Iterate through 'aset' data and generate card HTML
                assets.forEach(function(aset) {
                    var card = `
                        <div class="card data-item mb-3">
                                
                            
                            <div class="card-body">
                            <a href="/aset/asset/${aset.id_asset}" style="text-decoration:none;"><h3>${aset.kode_asset}</h3></a>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td rowspan="7" class="align-middle" align="center" style="width: 150px;">
                                                <img src="{{asset('public/asset/dist/img/avatar.png')}}" alt="" style="max-width: 100%; height: auto;">
                                            </td>
                                            <td style="width: 200px;">Tanggal Beli</td>
                                            <td>${aset.tanggal_beli}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>${aset.id_kategori == '1' ? "FURNITURE" : (aset.id_kategori == '2' ? "ELEKTRONIK" : "UMUM")}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Asset</td>
                                            <td>${aset.nama_asset}</td>
                                        </tr>
                                        <tr>
                                            <td>Spesifikasi</td>
                                            <td>${aset.sfesifikasi}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pegawai</td>
                                            <td>${aset.nama_pegawai}</td>
                                        </tr>
                                        <tr>
                                            <td>Divisi</td>
                                            <td>${aset.divisi}</td>
                                        </tr>
                                        <tr>
                                            <td>Cabang</td>
                                            <td>${aset.cabang}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    `;

                    // Append card to the container
                    $('#aset-cards').append(card);
                });

                // Generate pagination links
                const paginationLinks = [];
                const paginationRange = 5;

                if (currentPage > 1) {
                    paginationLinks.push(`<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">&laquo;</a></li>`);
                }

                for (let i = currentPage - paginationRange; i <= currentPage + paginationRange; i++) {
                    if (i > 0 && i <= lastPage) {
                        const activeClass = i === currentPage ? 'active' : '';
                        paginationLinks.push(`<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`);
                    }
                }

                if (currentPage < lastPage) {
                    paginationLinks.push(`<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">&raquo;</a></li>`);
                }

                $('#pagination-nav .pagination').html(paginationLinks.join(''));
                
                 // Pagination link click event
                 $('#pagination-nav .pagination .page-link').on('click', function(e) {
                    e.preventDefault();
                    const selectedPage = parseInt($(this).data('page'));
                    fetchAndRenderData(selectedPage);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Initial fetch and render data
    fetchAndRenderData();

    // Event listeners for filters
    $('#search-input').on('keyup', function() {
        fetchAndRenderData();
    });

    $('#search-divisi, #search-cabang, #search-kategori').on('change', function() {
        fetchAndRenderData();
    });
});

</script>
@endpush