<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_admin'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$allowed = array();

$sql = "SELECT * FROM allowed_f";
$atems = $dbcon->query($sql) or die($con->error);
$al = $atems->fetch_assoc();

$al2 = getdata("*", "allowed_f");

$sql = "SELECT config_size FROM upload_config";
$ztems = $dbcon->query($sql) or die($con->error);
$sz = $ztems->fetch_assoc();

$size = $sz['config_size'];




$cats = getdata("*", "ipcrf_stratprio");
if (isset($_POST['upload'])) {
  $ext = $_POST['ext'];
  $sz = $_POST['size'];



  if (!empty($ext)) {
    $data = array(
      "al_ext"     => $ext,
    );
    insertdata("allowed_f", $data);
  }



  $arr_where = array("config_size"  => $size); //update where
  $arr_set   = array(
    "config_size"     => $sz
  ); //set update
  $tbl_name  = "upload_config";
  $update    = update($dbcon, $tbl_name, $arr_set, $arr_where); // UPDATE SQL
  header("location: add-upload-config.php");
}

if (isset($_GET['delete'])) { // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("al_id" => $delete); //WHERE statement
  $tbl_name = "allowed_f";
  $del = Delete($dbcon, $tbl_name, $ar);
  if ($del) {
    header("location: ipcrf-strat.php");
  }
}
?>
<?php include '../assets/admin_header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include '../assets/admin_nav.php'; ?>
    <?php include '../assets/admin_sidebar.php'; ?>

    <div class="content-wrapper">
      <!-- Main content -->
      <section style="padding:11px;">

        <div class="box box-solid" style="padding:15px;">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-edit"></i> Modify Upload Settings</h3>
            <hr>
            <?php if (isset($msg)) : ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif; ?>
            <form method="post">
              <div class="row">
                <div class="col-md-2">Settings:</div>
                <div class="col-md-8">
                  <label for="size">File Size Limit: </label><input type="number" name="size" id="size" <?php echo 'value="' . $sz['config_size'] . '"' ?>>
                  <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                    <thead>
                      <tr>
                        <th>File Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($al2 as $key => $value) : ?>
                        <tr>
                          <td><?php echo $value->al_ext; ?> </td>

                          <td>

                            <div class="btn-group">
                              <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                  <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'add-upload-config.php?delete=' . $value->al_id . '\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                  </table>
                  <label for="ext">Add another File Type: </label><input type="text" name="ext" id="ext">
                </div>
              </div>
              <br><br><br>
              <center>
                <a href="ipcrf-measures.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go back</a>
                <button class="btn btn-primary" name="upload">
                  <i class="fa fa-upload"></i> Update
                </button>

              </center>
            </form>
          </div>
        </div>
      </section>


      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../assets/admin_footer.php'; ?>
</body>

</html>