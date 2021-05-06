<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/config/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/data.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/control.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/helper.php");
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "/controller/request.php");

use data\liste,config\themes,security\control,helper\tools,request\post;
control::loginControl();



?>



<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Kullanıcı Servis Listeis </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?
            $tableCaption="
                       <tr>



                    <th>Servis İsmi</th>
                    <th>Kullanıcı İsmi</th>
                    <th>ip</th>
                    <th>port</th>



                  </tr>";
            ?>
            <table id="exchange" class="table table-bordered table-striped">
              <thead>
              <?=$tableCaption?>

              </thead>
              <tbody>
              <?
              foreach (liste::ServiceList() as $line)
              {
                $userName=liste::getUserName($line->userId);

                echo "   <tr>

                    <td>{$userName} </td>
                    <td>{$line->serviceName} </td>
                    <td>{$line->ip} </td>
                    <td>{$line->port} </td>

                    ";


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
