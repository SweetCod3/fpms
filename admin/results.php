<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
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
      <!-- Small boxes (Stat box) -->

      <div class="box box-solid" style="padding:15px;">
            <div class="box-header with-border">
              <h4><i class="fa fa-calendar"></i> Evaluation Results </h4>
              <hr>
       <table width="100%" class="table table-striped table-bordered table-hover" id="example1">
        <thead>
            <tr>
                <th>Evaluation Code</th>
                <th>Code</th>
                <th>Subject</th>
                <th>Time</th>
                <th>Day</th>
                <th>Professor Assigned</th>
                <th>Option</th>
            </tr>
        </thead>
<tbody>
<?php 
$student = $dbcon->query("SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule 
    on subject_schedule.sched_id = evaluation_sheet.sub_incharge
  INNER JOIN user_account on user_account.user_id = subject_schedule.user_id") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><?php echo $row['e_code']?></td>
                <td><?php echo $row['sub_code']?></td>
                <td><?php echo $row['sub_name']?></td>
                <td>
                  <?php echo date("h:i a",strtotime($row['sub_from']))?> / 
                  <?php echo date("h:i a",strtotime($row['sub_until']))?>
                </td>
                <td><?php echo $row['sub_day']?></td>
                <td>
                  <?php echo $row['fname']?> <?php echo $row['mname']?> <?php echo $row['lname']?>
                </td>
                <td class="center">
                     <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to delete?\') 
      ?window.location = \'index.php?delete='.$row['eval_id'].'\' : \'\';"'; ?>>Delete</a></li>
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
