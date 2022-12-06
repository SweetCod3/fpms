<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_GET['delete'])){
  $delete = filter($_GET['delete']);
    $ar = array("room_id"=>$delete);
    $tbl_name = "rooms";
    $del = delete($dbcon,$tbl_name,$ar);

    $tbl_name2 = "subject_schedule";
    $del2 = Delete($dbcon,$tbl_name2,$ar);

    if($del){
      header("location: rooms.php");
    }
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
              <h3 class="box-title"><i class="fa fa-book"></i> Rooms - <a href="add-room.php" class="btn btn-info">Add Data</a></h3>
              <hr>
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
                <th>Room Name</th>
                <th>Date Added</th>
                <th>Created By</th>
                <th>Option</th>
            </tr>
        </thead>
<tbody>
<?php 
$student = $dbcon->query("SELECT * FROM rooms") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><?php echo $row['room_name']?></td>
                <td><?php echo $row['date_created']?></td>
                <td><?php echo $row['created_by']?></td>
                
                <td class="center">
                     <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="add-room.php?room_id=<?php echo $row['room_id']?>">Update</a></li>
                      <li><a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'rooms.php?delete='.$row['room_id'].'\' : \'\';"'; ?>>Delete</a></li>
                    </ul>
                  </div>
                </td>
            </tr>
                                    

<?php endwhile;?>
</tbody>
    </table>
            </div>
      </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
