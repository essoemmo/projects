<script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('front/js/wow.min.js')}}"></script>
<script src="{{asset('front/js/lazyload.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>


<script src="{{ asset('custom/parsely/parsley.min.js') }}"></script>
<script type="module" src="{{url('/')}}/custom/parsely/i18n/{{ LaravelLocalization::setLocale() }}.js"></script>
<!---- dropzone ----->
<script src="{{asset('js/dropzone.js')}}"></script>
<script src="{{asset('js/ekko-lightbox.min.js')}}"></script>
<script src="{{url('/')}}/js/ckeditor.js"></script>

<script>
    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>

@stack('js')

