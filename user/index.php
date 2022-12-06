<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_user'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$query = "SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule 
    on subject_schedule.sched_id = evaluation_sheet.sub_incharge 
  INNER JOIN user_account
    on user_account.user_id = subject_schedule.user_id
  INNER JOIN student_list
  	on student_list.sched_id = subject_schedule.sched_id
WHERE student_list.user_id = '".$_SESSION["user_name"]."'";
$evaluate = getdata_inner_join($query);

/*
$query2 = "SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule 
    on subject_schedule.sched_id = evaluation_sheet.sub_incharge 
  INNER JOIN user_account
    on user_account.user_id = subject_schedule.user_id";
$evaluate_dean = getdata_inner_join($query2);
*/
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
      <!--
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $subjects['subjects']?></h3>

              <p>Subjects </p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>

            
          </div>
        </div>
    </div>
    -->
          <div class="box-body table-responsive" style="background:white;">
            <h4><i class="fa fa-check"></i> Evaluate Professor</h4><hr>

<?php if($_SESSION['user_role'] == '2'):?>
            <?php  if(!empty($evaluate)):?>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Evaluation Code</th>
                  <th>Course Code</th>
                  <th>Description</th>
                  <th>Date Started</th>
                  <!--
                  <th>Day</th>
                  <th>Time</th>
                -->
                  <th>Professor to Evaluate</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($evaluate as $key => $value):?>
                <tr>
                  <td>
                    <?php echo $value->e_code?>
                  </td>
                  <td>
                    <?php echo $value->sub_code?>  
                  </td>
                  <td><?php echo $value->sub_name?></td>
                  <td><?php echo $value->date_started?></td>
                  <!--
                  <td>
                    <?php echo $value->sub_day?>
                  </td>
                  <td>
                    <?php echo date("h:i a",strtotime($value->sub_from))?> - <?php echo date("h:i a",strtotime($value->sub_until))?>
                  </td>
                -->
                  <td>
                    <?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?>
                  </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <?php 
                    $fetch = $dbcon->query("SELECT * FROM result WHERE user_id = '".$_SESSION['user_id']."' AND e_code = '".$value->e_code."'") or die(mysqli_error());
                    $count = mysqli_num_rows($fetch);
                    ?>
                    <?php if($count > 0):?>
                      <li>Already evaluated</li>
                    <?php else:?>
                      <?php 
                      $date_today = date("Y-m-d");
                      $expired_date = date('Y-m-d', strtotime($value->date_started. ' + 14 days'));
                      if($expired_date < $date_today):
                      ?>
                    <li>Bawal Mg evaluate</li>
                      <?php else:?>
                    <li><a href="evaluation.php?e_code=<?php echo $value->e_code?>">Evaluate Professor</a> </li>
                  <?php endif;?>
                    <?php endif;?>
                  </ul>
                  </div>
                  </td>
                </tr>
                
              <?php endforeach;?>
              </table>
              <?php else:?>
                <div class="alert alert-danger">There are no records on the database.</div>
              <?php endif;?>
<?php else:?>
  <!--
   <?php  if(!empty($evaluate_dean)):?>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Evaluation Code</th>
                  <th>Subject Code</th>
                  <th>Description</th>
                  <th>Day</th>
                  <th>Time</th>
                  <th>Professor to Evaluate</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($evaluate_dean as $key => $value):?>
                <tr>
                  <td>
                    <?php echo $value->e_code?>
                  </td>
                  <td>
                    <?php echo $value->sub_code?>  
                  </td>
                  <td><?php echo $value->sub_name?></td>
                  <td>
                    <?php echo $value->sub_day?>
                  </td>
                  <td>
                    <?php echo date("h:i a",strtotime($value->sub_from))?> - <?php echo date("h:i a",strtotime($value->sub_until))?>
                  </td>
                  <td>
                    <?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?>
                  </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                  <?php 
                    $fetch = $dbcon->query("SELECT * FROM result WHERE user_id = '".$_SESSION['user_id']."' AND e_code = '".$value->e_code."'") or die(mysqli_error());
                    $count = mysqli_num_rows($fetch);
                    ?>
                    <?php if($count > 0):?>
                      <li>Already evaluated</li>
                    <?php else:?>
                    <li>
                      <a href="evaluation_dean.php?e_code=<?php echo $value->e_code?>">Evaluate Professor</a></li>
                  <?php endif;?>
                  </ul>
                  </div>
                  </td>
                </tr>
                
              <?php endforeach;?>
              </table>
              <?php else:?>
                <div class="alert alert-danger">There are no records on the database.</div>
              <?php endif;?>
            -->
<?php endif;?>
             
            </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
