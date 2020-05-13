<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.0-beta.2
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('/') }}/adminPanel/plugins/jquery/jquery.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.bootstrap4.css">
<script src="{{ url('/') }}/adminPanel/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/datatables/dataTables.buttons.min.js"></script>
{{--<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>--}}
<!-- Bootstrap -->
<script src="{{ url('/') }}/adminPanel/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/') }}/adminPanel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/adminPanel/dist/js/adminlte.js"></script>
<script src="{{ url('/') }}/adminPanel/dist/js/parsley.min.js"></script>

<script src="{{ url('/') }}/adminPanel/dist/js/dropzone.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('/') }}/adminPanel/dist/js/demo.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
<!-- PAGE PLUGINS -->
<script src="{{ asset('adminPanel/ckeditor/ckeditor.js') }}"></script>

<!-- jQuery Mapael -->
<script src="{{ url('/') }}/adminPanel/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/raphael/raphael.min.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ url('/') }}/adminPanel/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/') }}/adminPanel/plugins/chart.js/Chart.min.js"></script>
<!-- sweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- PAGE SCRIPTS -->
{{--<script src="{{ url('/') }}/adminPanel/dist/js/pages/dashboard2.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    $(document).ready(function () {

        // image preview
        $(".image").change(function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }

        });

        CKEDITOR.config.language =  "{{ app()->getLocale() }}";

    });
    </script>
@yield('footer')
@stack('js')
@stack('css')
</body>
</html>
