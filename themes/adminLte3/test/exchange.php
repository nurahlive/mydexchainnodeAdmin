



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Borsalar <?  print_r($data)?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?
                  $tableCaption="
                       <tr>
                    <th>Id</th>
                    <th> Borsa</th>
                    <th>Durum</th>
                    <th>İşlem</th>

                  </tr>";
                ?>
                <table id="exchange" class="table table-bordered table-striped">
                  <thead>
                  <?=$tableCaption?>

                  </thead>
                  <tbody>
                  <?
                   foreach ($data as $line)
                   {

                     echo "   <tr>
                    <td>{$line->exchangeId}</td>
                    <td>{$line->name}
                    </td>";
                       if($line->status==1){
                         echo '<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';
                       }else{
                         echo '<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>';
                       }
                       echo '
                        <td>
                       <div class="btn-group">
                    <button type="button" class="btn btn-default">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                    </div><td>
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
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
