<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
use data\liste,config\themes,security\control;


control::loginControl();
if(!empty($_GET['orderId'])){
  $orderId=intval($_GET['orderId']);
  //$orderIdInfo=liste::getProductInfo($productId);
}else{
  echo "hatalı işlem ";
  die();
}

?>


<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Servis Ekle</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <table id="exchange" class="table table-bordered table-striped"></table>
  <form id="frmServisAdd" name="frmServisAdd" method="post" enctype="multipart/form-data">
    <div class="card-body">


      <div class="form-group">
        <label>Servis Adı</label>
        <input type="text" class="form-control" id="servisName" name="servisName" placeholder="Servis Adı">
      </div>
      <div class="form-group">
        <label>Servis İp Adresi</label>
        <input type="text" class="form-control" id="servisIp" name="servisIp" placeholder="Servis İp Adresi">
      </div>

      <div class="form-group">
        <label>Servis Portu</label>
        <input type="text" class="form-control" id="servisPort" name="servisPort" placeholder="Servis Portu">
      </div>

      <!-- /.card-body -->

    <div class="card-footer">
      <input type="hidden" class="form-control" id="orderId" name="orderId" value="<?=$orderId?>" >

      <button type="submit" id="btnServisAdd" name="btnServisAdd" class="btn btn-primary"> Servis Ekle</button>
    </div>
  </form>

</div>

<?php  // exchange  ende; ?>


</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
