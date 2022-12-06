<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_admin'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$allowed = array();

  $sql = "SELECT * FROM `announcement` ORDER BY ann_date DESC LIMIT 1";
  $ltems = $dbcon->query($sql) or die($con->error);
  $lz = $ltems->fetch_assoc();

$sql= "SELECT COUNT(ann_id) AS announcements  FROM `announcement`";
$ztems = $dbcon->query($sql) or die($con->error);
$sz = $ztems->fetch_assoc();

if (isset($_POST['upload'])) {

  $data = array(
    "ann_desc"     => $_POST['ann']
    /*,
          "avg_rate"          => $avg_rate,
          "rate_dean"         => $rate_dean
          */,
  );
  insertdata("announcement", $data);
  $sql = "SELECT * FROM `announcement` ORDER BY ann_date DESC LIMIT 1";
  $ltems = $dbcon->query($sql) or die($con->error);
  $lz = $ltems->fetch_assoc(); 

 
  header("location: add-announcement.php");
}
if (isset($_POST['clear'])) {

  $sql = "DELETE FROM announcement";
  $ltems = $dbcon->query($sql) or die($con->error);

  header("location: add-announcement.php");
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
            <h3 class="box-title"><i class="fa fa-plus"></i> Add an Announcement </h3>
            <hr>
            <?php if (isset($msg)) : ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif; ?>
            <form method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-2">Make a new announcement:</div>
                <div class="col-md-8">
                  <textarea name="ann" placeholder="Enter a new announcement here!" style="width: 100%;"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">Current Announcement:</div>
                <div class="col-md-8">
                 
                  <p><?php 
                  if ($sz['announcements'] >   0) {
                    echo $lz['ann_desc'];
                  } else {
                    echo "Currently No Announcements";
                  }
                 ?> </p>
                </div>
              </div> <br>
              <center>
                <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                <button class="btn btn-primary" name="upload">
                  <i class="fa fa-bullhorn"></i> Announce
                </button>
                <button class="btn btn-primary" name="clear">
                  <i class="fa fa-bullhorn"></i> Clear Announcements
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