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
                    <th>Id</th>

                    <th> Name </th>

                    <th>ip</th>
                    <th>Port</th>
                    <th>Node Sayisi</th>
                    <th>port1</th>
                    <th>port2</th>
                    <th>port3</th>
                    <th>port4</th>
                    <th>Durum</th>


                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              foreach (nc::privateServerList() as $line)
              {
                $useNode=nc::serverUseNodeCount($line->serverId);
                $kalanNode=$line->DockerCount-$useNode;

                echo "   <tr>
                    <td>{$line->serverId }</td>
                    <td>{$line->serverName} </td>
                    <td>{$line->serverIp} </td>
                    <td>{$line->serverPort} </td>
                    <td> {$line->DockerCount} ($useNode) =$kalanNode </td>


                    <td>{$line->startPort1} </td>
                    <td>{$line->startPort2} </td>
                    <td>{$line->startPort3} </td>
                    <td>{$line->startPort4} </td>
                    ";

                 if( $line->status==0) $serverStatusStr="Musait";
                 if( $line->status==1) $serverStatusStr="Kuruluma Kapali";
                 if( $line->status==2) $serverStatusStr="Server Dolur";
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
    <h3 class="card-title">Özel Server Kurulumu </h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  <form id="frmPrivateNodeSetup" name="frmPrivateNodeSetup" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label>Kurulum Yapılacak Üye</label>
        <select name="members" id="members" class="form-control">
          <?
          foreach (nc::memberlist() as $members) {
            echo ' <option value="'.$members->memberId.'"> '.$members->email.' ('.$members->memberName.')</option>';
          }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label>Kurulacak Özel Ürün</label>


        <select name="productId" id="productId" class="form-control">
          <?
          foreach (nc::specialProductList() as $specialProduc) {

            echo ' <option value="'.$specialProduc->productId.'"> '.$specialProduc->productName.' ('.$specialProduc->DockerCount.')</option>';
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label>Kaç Aylık Olacak</label>
        <input type="text" class="form-control" id="serverPeriod" name="serverPeriod" placeholder="ay cinsinden">
      </div>



      <div class="form-group">
        <label>Dex Traker Number</label>
        <input type="text" class="form-control" id="dextrakerNumber" name="dextrakerNumber" value="5c41faf4706b11eb88ab06a281cead4eBRlScE8YEl" placeholder=" dex traker Number ">
      </div>



      <div class="form-group">
        <label>Kaç Adet</label>
        <input type="text" class="form-control" id="quantity" name="quantity" value="1" placeholder="Sayı cinsinden Node sayisi= adet * urun node sayısı">
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" id="btnPrivateNodeSetup" name="btnPrivateNodeSetup" class="btn btn-primary"> Ekle</button>
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
