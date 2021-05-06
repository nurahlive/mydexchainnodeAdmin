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
            <h3 class="card-title">Yatırımcılar </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>
                    <th>Id</th>
                    <th>User name</th>
                    <th>name </th>
                    <th>surName</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>user Type</th>
                    <th>Referans</th>
                    <th>status</th>

                    <th>operation</th>


                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              foreach (liste::investorList() as $line)
              {

                echo "   <tr>
                    <td>{$line->memberId}</td>
                    <td>{$line->userName} </td>
                    <td>{$line->name} </td>
                    <td>{$line->surName} </td>
                    <td>{$line->email} </td>
                    <td>{$line->phone} </td>
                    <td>{$line->userType} </td>
                    <td>{$line->RefUserId} </td>
                    ";

                if($line->status==1){
                  echo '<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';
                }else{
                  echo '<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>';
                }
                echo '
                        <td>
                      <div class="btn-group">
                    <button type="button" class="btn btn-default">İşlemler</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="#" id="'.$line->memberId.'" name="#">Durum Değiştir</a>


                      <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="#" id="'.$line->memberId.'" name="member#"> Sil</a>
                    </div>
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
