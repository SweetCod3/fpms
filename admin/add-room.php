<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['save_button'])){
  $room_name = filter($_POST['room_name']);
  $kweri = $dbcon->query("SELECT * FROM rooms WHERE room_name='$room_name'") or die(mysqli_error());
  $checkName = mysqli_num_rows($kweri);
  if($checkName > 0){
    $msg = 'Room Name: '.$room_name.' already exist.';
  }else{
      $insertSQL = array(
        "room_name"       =>$room_name,
        "created_by"      =>$_SESSION['user_name']
      );
      insertdata("rooms",$insertSQL);
      header("location: rooms.php");
  }
}
if(isset($_GET['room_id']) AND isset($_POST['update_button'])){
  $room_name = filter($_POST['room_name']);
  $kweri = $dbcon->query("SELECT * FROM rooms WHERE room_name='$room_name'") or die(mysqli_error());
  $checkName = mysqli_num_rows($kweri);

  if($checkName > 0){
    $msg = 'Room Name: '.$room_name.' already exist.';
  }else{
     $arr_where = array(
        "room_id"=>filter($_GET['room_id'])
     );//update where
     $arr_set = array(
        "room_name"     =>$room_name,
        "created_by"    =>$_SESSION['user_name']
     );//set update
     $tbl_name = "rooms";
     $update = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
     header("location: rooms.php");
  }
}
if(isset($_GET['room_id'])){
  $row = single_get("*","room_id","rooms",$_GET['room_id']);
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Room Information </h3>
              <hr>
<form method="post">
     <?php if(isset($msg)):?><div class="alert alert-danger"><?php  echo $msg;?></div> <?php endif;?>

<table class="table">
    <tr>
        <td>Room Name:</td>
        <td>
            <input type="text" name="room_name" class="form-control" placeholder="Room Name" value="<?php if(isset($_GET['room_id'])): echo $row['room_name']; elseif(isset($_POST['save_button'])): echo $_POST['room_name']; endif; ?>">
        </td>    
    </tr>
   
    </table>
    <center>
       <a href="rooms.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
