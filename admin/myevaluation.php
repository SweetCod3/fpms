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
        <div class="col-md-12">
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-calendar-o"></i> Evaluation Result</h3>

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
                <th># of Students Evaluated</th>
                <!--
                <th>Dean</th>
              -->
            </tr>
        </thead>
<tbody>
<?php 

$student = $dbcon->query("SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule on subject_schedule.sched_id = evaluation_sheet.sub_incharge
  WHERE e_status = '2' or e_status = '1'") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><a href="view-rating.php?e_code=<?php echo $row['e_code']?>"><?php echo $row['e_code']?></a></td>
                <td><?php echo $row['sub_code']?></td>
                <td><?php echo $row['sub_name']?></td>
                <td>
                    <?php echo date("h:i A",strtotime($row['sub_from']));?> - <?php echo date("h:i A",strtotime($row['sub_until']));?>
                </td>
                <!--
                <td><?php echo $row['sub_day']?></td>
                <td><?php echo $row['sub_year']?></td>
                <td><?php echo $row['room_name']?></td>
              -->
                <td>
                  <?php $g = $dbcon->query("SELECT * FROM result 
                  INNER JOIN user_account on user_account.user_id = result.user_id 
                  INNER JOIN student_list on student_list.user_id = user_account.user_name 
                  WHERE e_code = '".$row['e_code']."' 
                  AND user_role = '2' GROUP BY result.user_id") or die(mysqli_error());
                  $count = mysqli_num_rows($g);

                  echo $count;
                  ?> out of <?php $f = $dbcon->query("SELECT * FROM `evaluation_sheet` 
                  INNER JOIN student_list on sub_incharge = sched_id
                  WHERE e_code = '".$row['e_code']."'") or die(mysqli_error());
                  $count1 = mysqli_num_rows($f);

                  echo $count1;
                  ?> 
                </td>
                <!--
                <td>
                  <?php $j = $dbcon->query("SELECT * FROM result  
                  INNER JOIN user_account on user_account.user_id = result.user_id 
                  WHERE e_code = '".$row['e_code']."' AND user_role = '3' GROUP BY result.user_id") or die(mysqli_error());
                  $countme = mysqli_num_rows($j);

                  echo $countme;
                  ?>
                </td>
              -->
                
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
