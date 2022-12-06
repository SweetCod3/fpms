<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_GET['eval_id'])){
  $arr_where = array("eval_id"=>filter($_GET['eval_id']));//update where
  $arr_set = array("e_status" =>$_GET['stat']);//set update
  $tbl_name = "evaluation_sheet";
  $update = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
  header("location: evaluation.php");
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
        <div class="col-md-12">
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-calendar-o"></i> Evaluation Status</h3>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
     <table width="100%" class="table table-striped table-bordered table-hover" id="example1" style="font-size:12px;">
        <thead>
            <tr>
                <th>Evaluation Code</th>
                <th>Code</th>
                <th>Description</th>
                <th>Time</th>
                <!--
                <th>Day</th>
                <th>School Year</th>
                <th>Room</th>
              -->
                <th>Status</th>
                <th>Option</th>
            </tr>
        </thead>
<tbody>
<?php 
//SELECT * FROM subject_schedule 
  //INNER JOIN rooms on rooms.room_id = subject_schedule.room_id 
  //INNER JOIN school_year on school_year.year = subject_schedule.sub_year WHERE subject_schedule.user_id = '".$_SESSION['user_id']."'
$student = $dbcon->query("SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule on subject_schedule.sched_id = evaluation_sheet.sub_incharge
  ") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><?php echo $row['e_code']?></td>
                <td><?php echo $row['sub_code']?></td>
                <td><?php echo $row['sub_name']?></td>
                <td><?php echo date("h:i A",strtotime($row['sub_from']));?> - <?php echo date("h:i A",strtotime($row['sub_until']));?></td>
                <!--
                <td><?php echo $row['sub_day']?></td>
                <td><?php echo $row['sub_year']?></td>
                <td><?php echo $row['room_name']?></td>
              -->
                <td>
                  <?php if($row['e_status'] == '0'):?>
                    <div class="label label-danger">Deactivated</div>
                    <?php elseif($row['e_status'] == '1'):?>
                    <div class="label label-success">Activated</div>
                    <?php elseif($row['e_status'] == '2'):?>
                    <div class="label label-info">Already Done</div>
                  <?php endif;?>
                </td>
                <td class="center">
                     <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                      <li>
                        <?php if($row['e_status'] == '0'):?>
                           <a href="evaluation.php?eval_id=<?php echo $row['eval_id']?>&stat=1">Activate</a>
                          <?php elseif($row['e_status'] == '1'):?>
                           <a href="evaluation.php?eval_id=<?php echo $row['eval_id']?>&stat=2">Tag as Done</a>
                           <?php elseif($row['e_status'] == '2'):?>
                           <a href="evaluation.php?eval_id=<?php echo $row['eval_id']?>&stat=1">Activate</a>
                        <?php endif;?>
                       </li>
                      
                    </ul>
                  </div>
                </td>
            </tr>
                                    

<?php endwhile;?>
</tbody>
    </table>             
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
