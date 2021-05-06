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
                        <h3 class="card-title">Ürünler </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?
                        $tableCaption="
                       <tr>
                    <th>Id</th>

                    <th> Ürün ismi </th>

                    <th>Tutar</th>
                    <th>Para Tipi</th>
                    <th>Docker Sayısı</th>
                    <th>Süresi(Ay cinsinden)</th>
                    <th>Parex Kazimi</th>
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
                            foreach ($productList as $line)
                            {
                              $moneyType=nc::getMoneyType($line->moneyType);


                                echo "   <tr>
                    <td>{$line->productId }</td>
                    <td>{$line->productName} </td>

                    <td>{$line->amount} </td>
                    <td> $moneyType->name ($moneyType->shortName)</td>
                    <td> {$line->DockerCount}  </td>
                    <td>{$line->periods} </td>


                    ";
                                if($line->parexMinning==1){
                                 echo "       <td>Evet</td>";
                                }else{
                                  echo "       <td>Hayır </td>";
                                }


                                echo $line->status==0?'<td><i  style="color: red" class="fas fa-times" title="Pasif"></i></td>':'<td><i  style="color: green" class="fas fa-check-square" title="Aktif"></i></td>';



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
        <h3 class="card-title">Ürün Ekle </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="frmProductAdd" name="frmProductAdd" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Ürün İsmi</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="ürün İsmi">
            </div>

            <div class="form-group">
                <label>Tutar</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="Ürün ücreti">
            </div>
            <div class="form-group">
                <label>Para Birimi</label>
              <select name="moneyType" id="moneyType" class="form-control">
                <?
                foreach (nc::getMoneyTypeList() as $moneys) {
                  echo ' <option value="'.$moneys->moneyId.'"> '.$moneys->name.' ('.$moneys->shortName.')</option>';
                }
                ?>
              </select>
            </div>
          <div class="form-group">
            <label>Parex Minnin Ekleme(parex kazacak ise evet olmali)</label>
            <select name="parexMinning" id="parexMinning" class="form-control">
              <option value="0" selected="selected"> Hayır</option>
              <option value="1"> Evet</option>

            </select>
          </div>

            <div class="form-group">
                <label>Ürün Süresi(Ay cinsinden.)</label>
                <input type="text" class="form-control" id="period" name="period" placeholder="5 ay için : 5">
            </div>
            <div class="form-group">
                <label>Docker Sayısı(Adet Olarak .)</label>
                <input type="text" class="form-control" id="dockerCount" name="dockerCount" placeholder="Paket Süresi">
            </div>




            <div class="form-group">
                <label>Durum</label>
                <select name="status" id="status" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option  selected="selected" value="1">Aktif</option>
                    <option value="0">Pasif</option>
                </select>
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" id="btnProductAdd" name="btnProductAdd" class="btn btn-primary"> Ekle</button>
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
