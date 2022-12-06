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
    $ar = array("sched_id"=>$delete);
    $tbl_name = "subject_schedule";
    $del = delete($dbcon,$tbl_name,$ar);

    if($del){
      header("location: subjects.php");
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
              <h3 class="box-title"><i class="fa fa-book"></i> Course - <a href="add-subject.php" class="btn btn-info">  Add Data</a></h3>
              <hr>
     <table width="100%" class="table table-striped table-bordered table-hover" id="example1" style="font-size:12px;">
        <thead>
            <tr>
                <th>Code / Course Name</th>
                <th>Time</th>
                <!--
                <th>Day</th>
                <th>School Year</th>
                <th>Room</th>
              -->
                <th>Professor Assigned</th>
                <th>Option</th>
            </tr>
        </thead>
<tbody>
<?php 
$student = $dbcon->query("SELECT * FROM subject_schedule 
  /*INNER JOIN rooms on rooms.room_id = subject_schedule.room_id */
  INNER JOIN user_account on user_account.user_id = subject_schedule.user_id
  /*
  INNER JOIN school_year on school_year.year = subject_schedule.sub_year
  */
") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><?php echo $row['sub_code']?> / <?php echo $row['sub_name']?></td>
                <td><?php echo date("h:i A",strtotime($row['sub_from']));?> - <?php echo date("h:i A",strtotime($row['sub_until']));?></td>
                <!--
                <td><?php echo $row['sub_day']?></td>
                <td><?php echo $row['sub_year']?></td>
                <td><?php echo $row['room_name']?></td>
              -->
                <td><?php echo $row['fname']?> <?php echo $row['lname']?></td>
                <td class="center">
                     <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="add-subject.php?sched_id=<?php echo $row['sched_id']?>">Update</a></li>
                      <li><a href="view-student.php?sched_id=<?php echo $row['sched_id']?>">View Student</a></li>
                      <li><a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'subjects.php?delete='.$row['sched_id'].'\' : \'\';"'; ?>>Delete</a></li>
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
