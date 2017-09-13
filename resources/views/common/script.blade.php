<script type="text/javascript" src="/js/jquery.min.js"></script> 
<script type="text/javascript" src="/js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>

<!-- datepicker js -->
<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- time picker js -->
<script src="{{ asset('/plugins/jonthornton-timepicker/jquery.timepicker.min.js') }}"></script>

<!-- Editor js -->
<script src="{{ asset('/plugins/tinymce/js/tinymce/tinymce.js') }}"></script>
<!--Data Table-->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
@stack('before-main-js')

@stack('js')