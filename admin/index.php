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
    $ar = array("eval_id"=>$delete);
    $tbl_name = "evaluation_sheet";
    $del = delete($dbcon,$tbl_name,$ar);
    if($del){
      header("location: index.php");
    }
}
$query = "SELECT COUNT(*) as subjects FROM subject_schedule";
$subjects = single_inner($query);

$kweri = "SELECT COUNT(*) as questions FROM questions";
$questions = single_inner($kweri);

$a = "SELECT COUNT(*) as student FROM user_account WHERE user_role = '2'";
$student = single_inner($a);

$b = "SELECT COUNT(*) as professor FROM user_account WHERE user_role = '1'";
$professor = single_inner($b);

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
      <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $subjects['subjects']?></h3>

              <p>Subjects </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            -->
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $questions['questions']?></h3>

              <p>Evaluation Questions</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!--
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            -->
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $student['student']?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!--
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            -->
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $professor['professor']?></h3>

              <p>Professors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <!--
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            -->
            
          </div>
        </div>
        <!-- ./col -->
    
      </div>
      <div class="box box-solid" style="padding:15px;">
            <div class="box-header with-border">
              <h4><i class="fa fa-book"></i> Evaluation Sheet- <a href="add-data.php" class="btn btn-info">Add Data</a></h4>
              <hr>
       <table width="100%" class="table table-striped table-bordered table-hover" id="example1">
        <thead>
            <tr>
                <th>Evaluation Code</th>
                <th>Code</th>
                <th>Description</th>
                <th>Time</th>
                <!--
                <th>Day</th>
              -->
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
                  <?php echo date("h:i A",strtotime($row['sub_from']));?> - <?php echo date("h:i A",strtotime($row['sub_until']));?>
                </td>
                <!--
                <td><?php echo $row['sub_day']?></td>
              -->
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
