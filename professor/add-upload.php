<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_prof'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$sql = "SELECT * FROM ipcrf_category ORDER BY cat_id ASC";
$items = $dbcon->query($sql) or die($con->error);
$row = $items->fetch_assoc();

$allowed = array();

$sql = "SELECT al_ext FROM allowed_f";
$atems = $dbcon->query($sql) or die($con->error);
$al = $atems->fetch_assoc();

$sql = "SELECT config_size FROM upload_config";
$ztems = $dbcon->query($sql) or die($con->error);
$sz = $ztems->fetch_assoc();

$size = $sz['config_size'];
do {
  array_push($allowed, $al['al_ext']);
} while ($al= $atems->fetch_assoc());


$cats = getdata("*", "ipcrf_stratprio");
if (isset($_POST['upload'])) {
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileErr = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.',  $fileName);
  $fileActualExt = strtolower(end($fileExt));  


  if (in_array($fileActualExt, $allowed)) {
     if ($fileErr === 0 ) {
      if ($fileSize < $size) {
          $fileNameNew = $fileName.uniqid('',true).".".$fileActualExt;
          $fileDestination = '../uploads/'.$fileNameNew; 
          move_uploaded_file($fileTmpName,$fileDestination);

          $data = array(
            "file_name"     => $fileNameNew,
            "file_dest"      =>$fileDestination,
            "file_type"     =>$fileActualExt,
            "file_date"     =>date('y-m-d'),
            "file_uid"     =>$_SESSION['user_id']
          /*,
          "avg_rate"          => $avg_rate,
          "rate_dean"         => $rate_dean
          */,
          );
          insertdata("deliv_files",$data);
          header("location: deliverables.php");

          
      }else {
          $msg = "Your file is too big!";
      }
     }
     else {
      $msg ="There was an error in uploading your file!";
     }
  }else {
    $msg = "You cannot upload files of this type!";
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
            <h3 class="box-title"><i class="fa fa-plus"></i> <? print_r($allowed); ?> Add Files </h3>
            <hr>
            <?php if (isset($msg)) : ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif; ?>
            <form  method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-2">Upload your file</div>
                <div class="col-md-8">
                  <input type="file" name="file" id="">
                </div>
              </div>
              <center>
                <a href="ipcrf-measures.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                <button class="btn btn-primary" name="upload">
                  <i class="fa fa-upload"></i> Upload
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