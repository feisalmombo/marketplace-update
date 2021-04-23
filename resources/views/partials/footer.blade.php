<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1.0
    </div>
    <strong>
        &copy; {{date('Y')}} MarketPlace All Rights Reserved. <a href="https://getpesa.co.tz/" target="_blank"><strong style="color:#EE4323;">A Product by GetPesa</strong></a>
    </strong>
</footer>


<!-- jQuery 3 -->
<script src="{{asset('temp/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('temp/dist/js/permission_ajax.js')}}"></script>

<!--JQueryFile -->
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('temp/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('temp/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('temp/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('temp/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('temp/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('temp/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('temp/dist/js/demo.js')}}"></script>
<!-- AdminLTE for requests funs -->
<!-- page script -->
<script>


  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>



