<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/np.php");

use data\liste,config\themes,security\control,ndatabase\nmysql,np\nc;
control::loginControl();
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Özel Sunucu Listesi </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>
                    <th>Pool Id</th>
                    <th> master Pool sName </th>
                    <th>ip</th>
                    <th>Pool Key</th>
                    <th>Açıklama</th>
                    <th>Durum</th>


                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
             // foreach (nc::masterPoolKeyList() as $line)
              foreach (nc::masterPoolKeyList() as $line)
              {
               // print_R($line);
               // $useNode=nc::serverUseNodeCount($line->serverId);
               // $kalanNode=$line->DockerCount-$useNode;

                echo "   <tr>
                    <td>{$line->masterPoolId }</td>
                    <td>{$line->masterTrakerPoolName} </td>
                    <td>{$line->serverIp} </td>
                    <td>{$line->poolApiKey} </td>
                    <td>{$line->comment} </td>
                    ";
                //0 pasif 1 aktif 2 dolms 400 olunca 3 ekleme Sorunu yasayinca cevirikece değer kontrol gerek

                if( $line->status==0) $serverStatusStr="Pasif";
                if( $line->status==1) $serverStatusStr="Aktif";
                if( $line->status==2) $serverStatusStr="Dolu Pool";
                if( $line->status==3) $serverStatusStr="Kontrol Edilmeli";
                echo " <td>{$serverStatusStr} </td>";

                echo "
                  </tr>";

              }
              ?>


              </tbody>
              <tfoot>
              <?=$tableCaption?>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->





<?php  // exhange Add  start;  ?>

<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Master Traker Pool  </h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  <form id="frmMasterPoolKey" name="frmMasterPoolKey" method="post" enctype="multipart/form-data">
    <div class="card-body">

      <div class="form-group">
        <label>Master  Traker Pool  Name </label>
        <input type="text" class="form-control" id="masterTrakerPoolName" name="masterTrakerPoolName" placeholder="Belirteç Bir isim ">
      </div>
      <div class="form-group">
        <label>Pool Api Server (api key eklenecek server)</label>
        <select name="masterPoolServer" id="masterPoolServer" class="form-control">
          <?
          foreach (nc::masterPoolServerList() as $masterTrakerServer) {
            echo ' <option value="'.$masterTrakerServer->serverId .'"> '.$masterTrakerServer->serverName.' ('.$masterTrakerServer->ShortServerName.')</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Master  Traker Pool Key </label>
        <input type="text" class="form-control" id="masterTrakerPoolKey" name="masterTrakerPoolKey" placeholder="Master pool Key">
      </div>

      <div class="form-group">
        <label>Açıklama</label>
        <input type="text" class="form-control" id="masterPoolComment" name="masterPoolComment" placeholder="Açıklama">
      </div>


      <div class="form-group">
        <label>Aktiflik Durumu</label>
        <select name="poolStatus" id="poolStatus" class="form-control">
          <option value="1" selected="selected"> Aktif</option>
          <option value="0"> Pasif</option>
          <option value="2"> Dolu</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" id="btnMasterPoolSave" name="btnMasterPoolSave" class="btn btn-primary"> Ekle</button>
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
