<script>
    var APP_URL = {!! json_encode(url('/')) !!};
    var TOAST_POSITION = 'top-right';
</script>
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" ></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Admin -->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Admin for demo purposes -->
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
@stack('scripts')
