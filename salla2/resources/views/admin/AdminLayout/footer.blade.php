    </div>  {{-- <-----pcoded-container-----> --}}
</div>{{-- <-----pcoded-----> --}}
<!-- Warning Section Ends -->

@stack('app')

<!-- Required Jquery -->
 <script src="{{asset('AdminFlatAble/js/jquery.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/popper.min.js')}}"></script>

 <script type="text/javascript" src="{{asset('AdminFlatAble/js/bootstrap.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/bundle.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/pages/widget/flipclock/flipclock.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/jquery.slimscroll.js')}}"></script>
 {{--<script type="text/javascript" src="{{asset('AdminFlatAble/js/ecommerce-dashboard.js')}}"></script>--}}
 <!-- modernizr js -->
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/modernizr.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/css-scrollbars.js')}}"></script>
 <!--<script src="{{asset('AdminFlatAble/js/chart.js/js/Chart.js')}}"></script>-->
 <!--<script src="{{asset('AdminFlatAble/js/chart/chartjs/chartjs-custom.js')}}"></script>-->
 <!-- classie js -->
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/classie.js')}}"></script>
 <!-- i18next.min.js -->
 <script type="text/javascript" src="{{asset('AdminFlatAble/ckeditor/ckeditor.js')}}"></script>
 
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/i18next.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/i18nextXHRBackend.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/jquery-i18next.min.js')}}"></script>
 <!-- Custom js -->
 <script type="text/javascript" src="{{asset('AdminFlatAble/js/script.js')}}"></script>
 
 {{--parsleyjs--}}
 <script src="{{asset('custom/parsley.min.js')}}"></script>
 
 {{--datepiker--}}
 <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
 
 
 <!-- Chart js -->
 
 
 {{-- <script src="{{asset('AdminFlatAble/js/chart/chartlist/js/chartist-plugin-threshold.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/raphael/js/raphael.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/morris.js/js/morris.js')}}"></script>
 <!--<script src="{{asset('AdminFlatAble/js/chart/morris/morris-custom-chart.js')}}"></script> --}}-->
 
 <script src="{{asset('AdminFlatAble/js/d3/js/d3.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/nvd3/js/nv.d3.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/chart/nv-chart/js/stream_layers.js')}}"></script>
 
 <!-- Chart js -->
 <script src="{{asset('AdminFlatAble/js/jquery.dataTables.min.js')}}"></script>
 <!--<script src="{{asset('AdminFlatAble/js/popper.min.js')}}"></script>-->
 <script src="{{asset('AdminFlatAble/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/buttons.flash.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/buttons.colVis.min.js')}}"></script>
 <!--<script src="{{asset('AdminFlatAble/pages/wysiwyg-editor/wysiwyg-editor.js')}}"></script>-->
 <script src="{{asset('AdminFlatAble/pages/wysiwyg-editor/js/tinymce.min.js')}}"></script>
 <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/jquery.nice-select.min.js')}}"></script>
 
 <script src="{{asset('AdminFlatAble/js/stroll/js/stroll.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/list-scroll/list-custom.js')}}"></script>
 
 <script src="{{asset('AdminFlatAble/js/select2.full.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/c3.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/pcoded.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/demo-12.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/menu/menu-rtl.js')}}"></script>
 <script src="{{asset('AdminFlatAble/js/jquery.mousewheel.min.js')}}"></script>
 <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
 <script type="text/javascript" src="{{asset('AdminFlatAble/dist/clipboard.min.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 
 <script>
        $( document ).ready(function() {
            $( "#pcoded" ).pcodedmenu({
                verticalMenuplacement: 'right',
            });
        });

    </script>
    <script>
    /*share icon toggle*/
    $('.share').hide();
    $(".option-font").on('click', function() {
        // $(this).next().slideToggle();
        $(this).next().toggle("slide");
    });
    $(function () {
        'use strict'

        $('.selectpicker').on('change',function(e){
            $(this).next().next().toggleClass('show');
        })
        $('.dropdown-toggle').click(function () {
            $(this).next().toggleClass('show');
        });
    })
    /*end share icon toggle */
</script>

 <script>
    //

    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
//                CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
    //    $('.textarea').wysihtml5();

        $('.modal').on('hidden.bs.modal', function () {
            $('.modal-backdrop').removeClass('modal-backdrop');
            $('body').css({'padding-right':'0'});
        })
    });
</script>


@stack('js')
 </body>

    <style>
        .table{
            width: 100% !important;
        }
        .btn-circle {
             width: 45px;
             height: 45px;
             line-height: 45px;
             text-align: center;
             padding: 0;
             border-radius: 50%;
         }
        .btn-danger{
            color: #fff !important;
        }
        .dt-button,.btn{
            font-family: "elmessiri-regular";

        }
        .dt-bootstrap .row{
            width: 100%;
        }
    </style>

 </html>
