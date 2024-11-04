
<!-- footer -->
      
<!-- footer -->
<section class="content" style="margin-left: 30px;margin-right: 30px">
        <div class="card">
            <div class="card-header">
                <footer class="footer">
                    <div class="text-center p-1">
                        © 2024 Copyright:
                        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Mitra Suzuki </a>
                        | <a href="">it@mitrasuzuki.com</a> Build version 1.0
                    </div>
                </footer>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/asset/dist/js/adminlte.min.js') }}"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <!-- DataTables Buttons -->
    <script src="{{ asset('public/asset/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('public/asset/bootstrap/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('public/asset/ajax/select2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @if ($message = Session::get('success'))
        <script>
            // Display success message using SweetAlert2 and toastr
            Swal.fire({
                position: "center",
                icon: "success",
                title: '{{ $message }}',
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif

    @yield('scripts')

    @stack('script') <!-- Stack for additional scripts -->
</body>
</html>