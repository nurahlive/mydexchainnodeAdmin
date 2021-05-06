<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/helper.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/np.php");

use data\liste,config\themes,security\control,helper\tools,np\nc;
control::loginControl();
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-18">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Siparişler</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>


                    <th>Kullanıcı</th>
                    <th>Ürün</th>
                    <th>Ürün Node Sayısı</th>
                    <th>Ürün Fiyatı</th>
                    <th>Ödenen </th>
                    <th title='Kac Adet ALındı'>Adet</th>
                    <th style='width: 2%'>Süre</th>
                    <th style='width: 2%'>Sipariş Tarihi</th>
                    <th style='width: 5%'>txt Kodu</th>
                     <th>DexTraker Kodu</th>

                    <th>Durum</th>
                    <th>Türü</th>


                    <th>İşlem</th>

                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped" style="width: 100%">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              foreach (nc::orderList() as $line)
              {
                $getProduct=nc::getProduct($line->productId);
                $getuser=nc::getuser($line->memberId);

                echo "   <tr>

                    <td>$getuser->email</td>
                    <td>{$getProduct->productName} </td>
                    <td>{$getProduct->DockerCount} </td>
                    <td>".number_format($getProduct->amount,0)." DXC</td>
                    <td>".number_format($line->paymendPrice,0)." DXC</td>
                    <td>{$line->quantity} Adet</td>
                    <td> {$line->periods}  Ay </td>
                    <td>{$line->orderDate}  </td>
                    <td><textarea>{$line->txtCode}</textarea> </td>
                    <td><textarea>{$line->dexchainTrakeCode} </textarea></td>
                    ";
                $statusStr="";
                 switch ($line->status){

                   case 0: $statusStr="Beklemede"; break;
                   case 1: $statusStr="Onaylı"; break;
                   case 5: $statusStr="uzatma"; break;
                   case 3: $statusStr="iptal"; break;
                   case 4: $statusStr="süresi Bitmiş"; break;
                 }
                 echo "<td>  $statusStr</td>";
                 if($line->orderType==0){
                   echo "<td>  Yeni</td>";

                 }else{
                   echo "<td>  Uzatma</td>";
                 }


               // echo $line->status==0?'<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>':'<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';



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
                  echo   '<a class="dropdown-item" href="#" id="'.$line->orderId.'" name="orderConfirm"> Onayla</a>';
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
