<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['save_button'])){
  $day_name = filter($_POST['day_name']);
  $kweri = $dbcon->query("SELECT * FROM days WHERE day_name='$day_name'") or die(mysqli_error());
  $checkName = mysqli_num_rows($kweri);
  if($checkName > 0){
    $msg = 'Day Name: '.$day_name.' already exist.';
  }else{
      $insertSQL = array("day_name"=>$day_name,"created_by"=>$_SESSION['user_name']);
      insertdata("days",$insertSQL);
      header("location: days.php");
  }
}
if(isset($_GET['day_id']) AND isset($_POST['update_button'])){
  $day_name = filter($_POST['day_name']);
  $kweri = $dbcon->query("SELECT * FROM days WHERE day_name='$day_name'") or die(mysqli_error());
  $checkName = mysqli_num_rows($kweri);
  if($checkName > 0){
    $msg = 'Day Name: '.$day_name.' already exist.';
  }else{
  $updateQuery = $dbcon->query("UPDATE days SET day_name='$day_name', created_by='".$_SESSION['user_name']."' WHERE day_id = '".$_GET['day_id']."'") or die(mysqli_error());
  header("location: days.php");
  }
}
if(isset($_GET['day_id'])){
  $row = single_get("*","day_id","days",$_GET['day_id']);
}
?>
<?php include'../assets/admin_header.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include'../assets/admin_nav.php';?>
<?php include'../assets/admin_sidebar.php';?>

  <div class="content-wrapper">
        <!-- Main content -->
    <section style="padding:11px;">

      <div class="box box-solid" style="padding:15px;">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-book"></i> Day Information </h3>
              <hr>
    <form method="post">
     <?php if(isset($msg)):?><div class="alert alert-danger"><?php  echo $msg;?></div> <?php endif;?>

<table class="table">
    <tr>
        <td>Day:</td>
        <td>
            <input type="text" name="day_name" class="form-control" placeholder="Day" value="<?php if(isset($_GET['day_id'])): echo $row['day_name']; elseif(isset($_POST['save_button'])): echo $_POST['day_name']; endif; ?>">
        </td>    
    </tr>
    
    </table>
    <center>
      <a href="days.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        <button class="btn btn-primary" name="<?php if(isset($_GET['room_id'])):?>update_button<?php else:?>save_button<?php endif;?>"><i class="fa fa-save"></i> Save Data</button>
        
    </center>
</form>
            </div>
      </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
