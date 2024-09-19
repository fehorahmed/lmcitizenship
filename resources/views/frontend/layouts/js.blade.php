<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/js/mousewheel.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('cssc/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    @if (Session::has('swal_warning'))
        swal("Warning!", "<?= Session::get('swal_warning') ?>", "warning");
    @endif

    @if (Session::has('swal_error'))

        swal("Error!", "<?= Session::get('swal_error') ?>", "error");
    @endif

    @if (Session::has('swal_success'))
        swal("Success!", "<?= Session::get('swal_success') ?>", "success");
    @endif

    @if (Session::has('swal_info'))
        swal("Info", "<?= Session::get('swal_info') ?>", "info");
    @endif
</script>
