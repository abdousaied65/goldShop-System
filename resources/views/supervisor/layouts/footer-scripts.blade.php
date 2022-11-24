<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('admin-assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('admin-assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{URL::asset('admin-assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{URL::asset('admin-assets/plugins/rating/jquery.barrating.js')}}"></script>
<script src="{{URL::asset('admin-assets/js/eva-icons.min.js')}}"></script>
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('admin-assets/js/sticky.js')}}"></script>
<script src="{{URL::asset('admin-assets/js/bootstrap-select.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('admin-assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('admin-assets/plugins/side-menu/sidemenu.js')}}"></script>
<script src="{{URL::asset('admin-assets/js/datatables.min.js')}}"></script>
<script src="{{asset('admin-assets/js/select2.min.js')}}"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('.js-example-basic-single').select2({
        placeholder: "اختر مما يلى"
    });
</script>
