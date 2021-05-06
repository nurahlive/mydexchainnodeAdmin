<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
use data\liste,config\themes,security\control,ndatabase\nmysql;


control::loginControl();
$db=new nmysql();
$data=$db->query("select * from coins","all");
$exchanges=$db->query("select * from exchanges where status=:status","all",['status'=>1]);
?>



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Coinler </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>
                    <th>Coin</th>
                    <th> Deposit Bakiye </th>
                    <th> Erarning Bakiye</th>
                    <th>Paketler Tutarı</th>
                    <th>Açık Deposit Tutarı</th>
                    <th>Açık Witdraw Tutarı</th>
                    <th title='Günlük Ortalama Ödeme Tutar'>Ödeme</th>

                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              $daillyEarning=liste::dailyEarningTotal();
              //print_R($daillyEarning);
              foreach ($data as $line)
              {
                $exchangeName=liste::getExchangeName($line->exchange);
                echo "   <tr>
                    <td><img style='width: 50px;height: 50px' src='".themes::$ImagePathPublic."/{$line->coinLogo}'> </td>
                    <td>".liste::depositTotalBalance($line->coinsId)." </td>
                    <td>".liste::earningTotalBalance($line->coinsId)."</td>
                    <td>".liste::packetsTotalBalance($line->coinsId)." </td>
                    <td>".liste::onholddepositTotalBalance($line->coinsId)." </td>
                    <td>".liste::onholdWitdrawTotalBalance($line->coinsId)." </td>


                    ";
                echo "<td> ";

               if(empty($daillyEarning[$line->coinsId])) { echo "0";} else{ echo $daillyEarning[$line->coinsId];};



                echo "</td>
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
