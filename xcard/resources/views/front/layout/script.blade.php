
<!---------------------------------------------------------------
<a href="#" class="go-top"><i class="fa fa-chevron-up"></i></a>
------------------------------------------------------------------>
<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-rtl.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/droopmenu.min.js')}}"></script>
<script src="{{asset('front/js/lazyload.min.js')}}"></script>
<script src="{{ asset('adminPanel/bower_components/lightbox2/js/lightbox.js') }}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
<script src="{{asset('front/js/jquery.number.min.js')}}"></script>

<script src="{{ asset('custom/parsley.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>


<script>
    $(function () {
        'use strict';
        $('.country-select').on('change', function () {
            var country = $(this).val();
            var that = $(this);
            $.ajax({
                url: '{{ url('/change_country')}}',
                type: 'get',
                dataType: 'json',
                data: {country: country},
                success: function (res) {
                    console.log(res);
                    if(res == true){
                        window.location.reload();
                    }
                }
            })
        });
    });
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
    });
</script>

<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>

@stack('js')
