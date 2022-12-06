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
  WHERE e_code = '".$_GET['e_code']."'";
$evaluate = single_inner($query);

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'OTHER FACTORS *for dean and department head only*' ORDER BY q_id ASC";
$others = getdata_inner_join($kweri1);
$kweri1 = "SELECT * FROM questions WHERE question_cat = 'MASTERY OF THE SUBJECT' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'TEACHING SKILLS AND MANAGEMENT' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'PERSONAL TRAITS' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bootstrap/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../bootstrap/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../bootstrap/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../bootstrap/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="wrapper" style="padding:15px;">
  <div class="row">
    <div class="col-md-8">
        <h1>Evaluation Sheet: <?php echo $_GET['e_code']?></h1>
    </div>
    <div class="col-md-4">
      <ul style="line-height: 25px; list-style: none; padding:5px;">
    <li><strong>Evaluatee:</strong> <?php echo $evaluate['fname']?> <?php echo $evaluate['mname']?> <?php echo $evaluate['lname']?></li>
    <li><strong>Subject Name/ Code:</strong> <?php echo $evaluate['sub_name']?> / <?php echo $evaluate['sub_code']?></li>
    <li><strong>Time:</strong> <?php echo date("h:i a",strtotime($evaluate['sub_from']))?> - <?php echo date("h:i a",strtotime($evaluate['sub_until']))?></li>
    <li><strong>Day:</strong> <?php echo $evaluate['sub_day']?></li>
  </ul>
    </div>
  </div>
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
<form method="GET" action="process_dean.php">
  <input type="hidden" name="e_code" value="<?php echo $_GET['e_code']?>">
  <?php $count = 1; ?>
  <strong>MASTERY OF THE SUBJECT</strong>
  <?php foreach ($mastery as $key => $value):?>
  <h4><?php echo $count++;?>. <?php echo $value->question_name;?></h4>
    <ul style="font-size:16px;line-height: 25px; list-style: none; padding:5px;">
     <li><input type="radio" name="answers<?php echo $value->q_id?>" value="5" required> Excellent</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="4" required> Very Satisfactory</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="3" required> Satisfactory</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="2" required> Needs Improvement</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="1" required> Poor</li>
    </ul>
  <?php endforeach;?>
  
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
  <strong>TEACHING SKILLS AND MANAGEMENT</strong>
  <?php $count = 1; ?>
  <?php foreach ($teaching as $key => $row):?>
    <h4><?php echo $count++;?>. <?php echo $row->question_name;?></h4>
    <ul style="font-size:16px;line-height: 25px; list-style: none; padding:5px;">
      <li><input type="radio" name="answers2<?php echo $row->q_id?>" value="5" required> Excellent</li>
      <li><input type="radio" name="answers2<?php echo $row->q_id?>" value="4" required> Very Satisfactory</li>
      <li><input type="radio" name="answers2<?php echo $row->q_id?>" value="3" required> Satisfactory</li>
      <li><input type="radio" name="answers2<?php echo $row->q_id?>" value="2" required> Needs Improvement</li>
      <li><input type="radio" name="answers2<?php echo $row->q_id?>" value="1" required> Poor</li>
    </ul>
  <?php endforeach;?>
<div style="border-bottom:1px solid #333;height: 2px;"></div>
<strong>PERSONAL TRAITS</strong>
<?php $count = 1; ?>
  <?php foreach ($personal as $key => $result):?>
    <h4><?php echo $count++;?>. <?php echo $result->question_name;?></h4>
    <ul style="font-size:16px;line-height: 25px; list-style: none; padding:5px;">
    <li><input type="radio" name="answers3<?php echo $result->q_id?>" value="5" required> Excellent</li>
    <li><input type="radio" name="answers3<?php echo $result->q_id?>" value="4" required> Very Satisfactory</li>
    <li><input type="radio" name="answers3<?php echo $result->q_id?>" value="3" required> Satisfactory</li>
    <li><input type="radio" name="answers3<?php echo $result->q_id?>" value="2" required> Needs Improvement</li>
    <li><input type="radio" name="answers3<?php echo $result->q_id?>" value="1" required> Poor</li>
    </ul>
  <?php endforeach;?>
  <?php $count = 1; ?>
  <strong>OTHER FACTORS *for dean and department head only*</strong>
  <?php foreach ($others as $key => $value):?>
  <h4><?php echo $count++;?>. <?php echo $value->question_name;?></h4>
    <ul style="font-size:16px;line-height: 25px; list-style: none; padding:5px;">
     <li><input type="radio" name="answers<?php echo $value->q_id?>" value="5" required> Excellent</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="4" required> Very Satisfactory</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="3" required> Satisfactory</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="2" required> Needs Improvement</li>
      <li><input type="radio" name="answers<?php echo $value->q_id?>" value="1" required> Poor</li>
    </ul>
  <?php endforeach;?>
  
  

<button class="btn btn-info btn-lg" name="submit_eval"><i class="fa fa-check"></i> Submit</button>
</form>

</div>
  
</body>
</html>
