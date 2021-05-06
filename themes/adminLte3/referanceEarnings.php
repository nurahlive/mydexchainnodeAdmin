<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
use security\control,data\liste;

control::loginControl();


?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Referans Gelirleri </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>
                    <th>Id</th>
                    <th>Coin</th>
                    <th>Hak Eden Hesap</th>
                    <th> Alt Hesap </th>
                    <th> ip Control</th>
                    <th>Tutar</th>
                    <th>Tarih</th>
                    <th>Status</th>
                    <th>Onaylayan</th>
                     <th>operation</th>


                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>
              </thead>
              <tbody>
              <?
              foreach (liste::referenceEarnins() as $line)
              {

                echo "   <tr>
                    <td>{$line->referenceId  }</td>
                     <td>{$line->shortName} </td>
                    <td>". liste::getUserName($line->mainUserId). "</td>
                    <td>". liste::getUserName($line->subUserId). "</td>";
                if($line->status==0){
                  echo "<td>".liste::ipUsersCount($line->mainUserId,$line->subUserId)."</td>";
                }else{
                  echo "<td>Kontrol Edilmedi</td>";
                }

                 echo "   <td>{$line->amount} </td>
                    <td>{$line->date} </td>
                    ";
                if($line->status==0){
                  echo '<td>Beklemede</td>';
                }

                if($line->status==1){
                  echo '<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';
                }
              if($line->status==2){
                  echo '<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>';
                }
                if(!empty($line->ConfirmedUser)){
                  echo "<td>".liste::getAdmUserName($line->ConfirmedUser)."</td>";
                }else{
                  echo "<td>-</td>";
                }
                 if($line->status==0){

                echo '
                          <td>
                        <div class="btn-group">
                      <button type="button" class="btn btn-default">İşlemler</button>
                      <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item" href="#" id="'.$line->referenceId .'" name="referanceConfirm">Onayla</a>


                        <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="#" id="'.$line->referenceId .'" name="referanceCancel"> İptal</a>
                      </div>
                      </div>
                      </td>
                         ';
                 }else{
                   echo "<td>İşlenmiş</td>";
                 }
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
