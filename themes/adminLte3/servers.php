<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/np.php");

use data\liste,config\themes,security\control,ndatabase\nmysql,np\nc;
control::loginControl();
$db= new nmysql();
$productList=$db->query("select * from product","all");
?>



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Serverlar </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>
                    <th>Id</th>

                    <th> İsmi </th>
                    <th> Kısa İsim </th>

                    <th>ip</th>
                    <th>port</th>
                    <th>Docker Sayısı</th>
                    <th>Türü</th>
                    <th> port1 2800</th>
                    <th> port2 3800</th>
                    <th> port3 5800</th>
                    <th> port4 1800</th>
                    <th>Durumu</th>


                    <th>İşlem</th>


                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              foreach (nc::serverList() as  $line)
              {


                echo "   <tr>
                    <td>{$line->serverId  }</td>
                    <td>{$line->serverName} </td>
                    <td>{$line->ShortServerName} </td>

                    <td>{$line->serverIp} </td>
                    <td> $line->serverPort</td>
                    <td> {$line->DockerCount}  </td>


                    ";
                if($line->serverType==0)  echo " <td>Genel Müşteri</td>";
                if($line->serverType==1)  echo " <td>Özel</td>";
                if($line->serverType==2)  echo " <td>Master Traker Pool</td>";


                echo "<td> {$line->startPort1}  </td>";
                echo "<td> {$line->startPort2}  </td>";
                echo "<td> {$line->startPort3}  </td>";
                echo "<td> {$line->startPort4}  </td>";


                if($line->status==0)  {$statusStr="Müsait";}
                if($line->status==1)  {$statusStr="Kuruluma Kapali";}
                if($line->status==2)  {$statusStr="Dolu";}
                echo "<td>$statusStr</td>";
                $statusStr="";

 //               echo $line->status==0?'<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>':'<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';

                echo '
                        <td>
                      <div class="btn-group">
                    <button type="button" class="btn btn-default">İşlemler</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">

                      <div class="dropdown-divider"></div>
                     ';
                if($line->status==0){
                  echo   '<a class="dropdown-item" href="#" id="'.$line->productId.'" name="productEnable"> Satışa Aç</a>';
                }else{
                  echo   '<a class="dropdown-item"  href="#" id="'.$line->productId.'" name="productDisaple"> <span style="color: #ff0000">Satışa Kapat</span></a>';

                }
                echo ' </div>
                    </div>
                    </td>
                       ';
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
    <h3 class="card-title">Server Ekle </h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form id="frmServerAdd" name="frmServerAdd" method="post" enctype="multipart/form-data">
    <div class="card-body">
      <div class="form-group">
        <label>Server İsmi</label>
        <input type="text" class="form-control" id="serverName" name="serverName" placeholder="Server İsmi">
      </div>
      <div class="form-group">
        <label>Kısa İsim (tr karekter  boşluk vs  olmamali)</label>
        <input type="text" class="form-control" id="ShorName" name="ShorName" placeholder="Server Kısa idim">
      </div>

      <div class="form-group">
        <label>Server İp</label>
        <input type="text" class="form-control" id="serverIp" name="serverIp" placeholder="Server İp">
      </div>
      <div class="form-group">
        <label>Server Port( iletişim portu)</label>
        <input type="text" class="form-control" id="serverPort" name="serverPort" placeholder="Server Port">
      </div>

      <div class="form-group">
        <label>Server Tipi( Özel serverlara Admin panelden kurulum yapılır)</label>
        <select name="serverType" id="serverType" class="form-control">
          <option value="0" selected="selected"> Normal Server</option>
          <option value="1"> Özel Server</option>
          <option value="2"> Master Traker</option>
        </select>
      </div>

      <div class="form-group">
        <label>Docker Sayısı(Servere Kurulacak  node Sayısı)</label>
        <input type="text" class="form-control" id="dockerCount" name="dockerCount" placeholder="Paket Süresi">
      </div>
      <div class="form-group">
        <label>Port1 (2800  lu port )</label>
        <input type="text" class="form-control" id="startPort1" name="startPort1" value="2800">
      </div>
      <div class="form-group">
        <label>Port2 (3800  lu port )</label>
        <input type="text" class="form-control" id="startPort2" name="startPort2" value="3800">
      </div>
      <div class="form-group">
        <label>Port3 (5800  lu port )</label>
        <input type="text" class="form-control" id="startPort3" name="startPort3" value="5800">
      </div>
      <div class="form-group">
        <label>Port4 (1800  lu port )</label>
        <input type="text" class="form-control" id="startPort4" name="startPort4" value="1800">
      </div>


      <div class="form-group">
        <label>Durum</label>
        <select name="status" id="status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
          <option  selected="selected" value="0">Kuruluma musait</option>
          <option value="1">Kuruluma Kapali</option>
          <option value="3"> Server Dolu olarak işaretle</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" id="btnServerAdd" name="btnServerAdd" class="btn btn-primary"> Server Ekle</button>
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
