<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_prof'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT * FROM evaluation_sheet 
  INNER JOIN subject_schedule 
    on subject_schedule.sched_id = evaluation_sheet.sub_incharge 
  INNER JOIN user_account
    on user_account.user_id = subject_schedule.user_id
  WHERE e_code = '".$_GET['e_code']."'";
$evaluate = single_inner($query);

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'A. Commitment' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'B. Knowledge of the subject' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'C. Teaching for independent learning' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);

$kweri4 = "SELECT * FROM questions WHERE question_cat = 'D. Management of learning' ORDER BY q_id ASC";
$last = getdata_inner_join($kweri4);

$fetch = single_get("*","e_code","comment_type",$_GET['e_code']);

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
              <h3 class="box-title"><i class="fa fa-calendar-o"></i> Evaluation CODE: <?php echo $_GET['e_code']?></h3>

            </div>
            
              <!-- /.box-header -->
              <div class="box-body">
        <form method="GET" action="process.php">
  <input type="hidden" name="e_code" value="<?php echo $_GET['e_code']?>">
  <?php $count = 1; ?>
  <?php if(!empty($mastery)):?>
  <strong>A. Commitment</strong>
  <table class="table table-striped">
    <tr>
      <td><strong>Question</strong></td>
    </tr>
    <?php foreach ($mastery as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
  </tr>
    <?php endforeach;?>
  </table>
<?php 
$total1 = '0';
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'A. Commitment' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total1 += $row['total'] / $count;
  }
 
?>
  <h3>Rating: <?php  echo $total1; ?></h3>
   <?php else:?>
  <?php endif;?>
 
  
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
  <strong>B. Knowledge of the subject</strong>
  <?php $count = 1; ?>
  <?php if(!empty($teaching)):?>
  <table class="table table-striped">
    <tr>
      <td><strong>Question</strong></td>
    </tr>
    <?php foreach ($teaching as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
      
      
    
  </tr>
    <?php endforeach;?>
  </table>
<?php 
$total2 = '0';
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'B. Knowledge of the subject' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total2 += $row['total'] / $count;
  }
 
?>
<h3>Rating: <?php  echo $total2; ?></h3>
   <?php else:?>
  <?php endif;?>
<div style="border-bottom:1px solid #333;height: 2px;"></div>
<br>
<strong>C. Teaching for independent learning</strong>
   <?php $count = 1; ?>
  <?php if(!empty($personal)):?>
  <table class="table table-striped">
    <tr>
      <td><strong>Question</strong></td>
    </tr>
    <?php foreach ($personal as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
      
    
    
  </tr>
    <?php endforeach;?>
  </table>
<?php 
$total3 = '0';
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'C. Teaching for independent learning' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total3 += $row['total'] / $count;
  }
 
?>
<h3>Rating: <?php  echo $total3; ?></h3>
   <?php else:?>
  <?php endif;?>
  <br><strong>D. Management of learning</strong>
   <?php $count = 1; ?>
  <?php if(!empty($last)):?>
  <table class="table table-striped">
    <tr>
      <td><strong>Question</strong></td>
    </tr>
    <?php foreach ($last as $key => $row):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $row->question_name;?></td>  
  </tr>
    <?php endforeach;?>
  </table>
<?php 
$total4 = '0';
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'D. Management of learning' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total4 += $row['total'] / $count;
  }
 
?>
<h3>Rating: <?php  echo $total4; ?></h3>
   <?php else:?>
  <?php endif;?>
<br>
<strong>Comment Type:</strong>
<?php
$kweri5 = $dbcon->query("SELECT * FROM comment_type WHERE e_code = '".$_GET['e_code']."'") or die(mysqli_error());
$count2 = mysqli_num_rows($kweri5);
?>
<?php
$kweri6 = $dbcon->query("SELECT * FROM comment_type WHERE e_code = '".$_GET['e_code']."'") or die(mysqli_error());
$count3 = mysqli_num_rows($kweri6);
?>
<div class="row">
  <div class="col-md-6">Good: <?php //echo $count2;?><hr>
  <?php 
  $num = '1';
  while($fetch = $kweri5->fetch_assoc()):
  ?>
  <?php echo $num++;?>. <?php echo $fetch['comment_feedback']?><br>
  <?php endwhile; ?>
  </div>
  <div class="col-md-6">Bad: <?php //echo $count3;?> 
  <hr>
  <?php 
  $num = '1';
  while($fetch2 = $kweri6->fetch_assoc()):
  ?>
  <?php echo $num++;?>. <?php echo $fetch2['negative_comment']?><br>
  <?php endwhile; ?>
  </div>

<br>
</div>
<div class="alert alert-info">
<h1 >Overall Rating: <?php $grand = ($total1 + $total2 + $total3 + $total4) / 4; echo $grand;?></h1>
</div>
</form>
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
  