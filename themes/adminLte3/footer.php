<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
use security\control;

control::loginControl();
?>
<!-- Main Footer -->
<footer class="main-footer">
  <strong>Kodlama : <a href="http://harunuludag.com/">Harun ULUDAĞ</a></strong>

  <div class="float-right d-none d-sm-inline-block">
    <b>Theme Version:</b> 3.1.0-rc
  </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=$themePath?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=$themePath?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=$themePath?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$themePath?>/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?=$themePath?>/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?=$themePath?>/plugins/raphael/raphael.min.js"></script>
<script src="<?=$themePath?>/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?=$themePath?>/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?=$themePath?>/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=$themePath?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=$themePath?>/dist/js/pages/dashboard2.js"></script>


<!-- DataTables  & Plugins -->
<script src="<?=$themePath?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=$themePath?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=$themePath?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=$themePath?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=$themePath?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=$themePath?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?=$themePath?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script src="<?=$themePath?>/dist/js/njs.js?v=<?=rand(1,200)?>"></script>
<script src="/js/formProcess.js?v=<?=rand(1,200)?>"></script>
<script src="<?=$themePath?>/dist/js/footer.js?v=<?=rand(1,200)?>"></script>
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.12.0/dist/sweetalert2.all.min.js"></script>


</body>
</html>
