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

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'A. Commitment' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'B. Knowledge of the subject' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'C. Teaching for independent learning' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);

$kweri4 = "SELECT * FROM questions WHERE question_cat = 'D. Management of learning' ORDER BY q_id ASC";
$last = getdata_inner_join($kweri4);
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
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
    <!--
    <li><strong>Day:</strong> <?php echo $evaluate['sub_day']?></li>
  -->
  </ul>
    </div>
  </div>
  <h4 style="text-indent:20px; margin-left:20px; margin-right:15px;">
       This instrument is intended to determine the intellectual and scholastic qualities, instructional competence,
       professionalism, research, extension, and production functions of the faculty as well as their plus factors. The 
       various groups of respondents shall accomplish the instrument as follows:
       </h4>
           </p>
       <br />
           <p>
           <h4 style="margin-left:100px;">
      <ol>
        <li>The <b style="color:rgb(43, 84, 126);">Dean/Administrator</b> shall evalaute the faculty on all components of the instrument.</li>
        <li>The <b style="color:rgb(43, 84, 126);">Self-Evaulator</b> shall evaluate his/her performance on Part I (<b style="color:rgb(43, 84, 126);">TEACHING EFFECTIVENESS</b>) 
        and Part II (<b style="color:rgb(43, 84, 126);">PROFESSIONALISM</b>) of the instrument.
        </li>
        <li>The <b style="color:rgb(43, 84, 126);">Peer</b> shall evaluate the faculty on Part I (<b style="color:rgb(43, 84, 126);">TEACHING EFFECTIVENESS</b>) 
        and Part II (<b style="color:rgb(43, 84, 126);">PROFESSIONALISM</b>) of the instrument. </li>
      </ol>
       </h4>
         <table width="800" class="table table-hover">                      
           <p>
           <h4><u>INSTRUCTION:</u> Please evaluate the teacher using the scale below. Select from the radio buttons below. </h4>
           </p>          
    <thead>
      <tr>
        <th>Scale</th>
        <th>Descriptive Rating</th>
        <th>Qualitative Description</th>
      </tr>   
      
        
      
    </thead>
    <tbody>
      <tr>
       <td>5</td>
       <td>Outstanding</td>
       <td>The performance always exceeds the job requirements. The faculty is exceptional role model.</td>
      </tr>
    <tr>
       <td>4</td>
       <td>Very Satisfactory</td>
       <td>The performance meets and often exceeds the job requirements.</td>
      </tr>
    <tr>
       <td>3</td>
       <td>Satisfactory</td>
       <td>The performance meets job requirements.</td>
      </tr>
    <tr>
       <td>2</td>
       <td>Fair</td>
       <td>The performance needs some development to meet job requirements.</td>
      </tr>
    <tr>
       <td>1</td>
       <td>Poor</td>
       <td>The faculty fails to meet job requirements.</td>
      </tr>
    </tbody>


   </table>
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
<form method="GET" action="process.php">
  <input type="hidden" name="e_code" value="<?php echo $_GET['e_code']?>">
  <?php $count = 1; ?>
  <?php if(!empty($mastery)):?>
  <strong>A. Commitment</strong>
  <table class="table table-striped">
    <tr>
      <td width="1000"><strong>Question</strong></td>
      <td><strong>Scale</strong></td>
    </tr>
    <?php foreach ($mastery as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
      
      <td>
        <input type="radio" name="answers<?php echo $value->q_id?>" value="5" required> 5
        <input type="radio" name="answers<?php echo $value->q_id?>" value="4" required> 4
        <input type="radio" name="answers<?php echo $value->q_id?>" value="3" required> 3
        <input type="radio" name="answers<?php echo $value->q_id?>" value="2" required> 2
        <input type="radio" name="answers<?php echo $value->q_id?>" value="1" required> 1
      </td>
    
  </tr>
    <?php endforeach;?>
  </table>
   <?php else:?>
  <?php endif;?>
 
  
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
  <strong>B. Knowledge of the subject</strong>
  <?php $count = 1; ?>
  <?php if(!empty($teaching)):?>
  <table class="table table-striped">
    <tr>
      <td width="1000"><strong>Question</strong></td>
      <td><strong>Scale</strong></td>
    </tr>
    <?php foreach ($teaching as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
      
      <td>
        <input type="radio" name="answers2<?php echo $value->q_id?>" value="5" required> 5
        <input type="radio" name="answers2<?php echo $value->q_id?>" value="4" required> 4
        <input type="radio" name="answers2<?php echo $value->q_id?>" value="3" required> 3
        <input type="radio" name="answers2<?php echo $value->q_id?>" value="2" required> 2
        <input type="radio" name="answers2<?php echo $value->q_id?>" value="1" required> 1
      </td>
    
  </tr>
    <?php endforeach;?>
  </table>
   <?php else:?>
  <?php endif;?>
<div style="border-bottom:1px solid #333;height: 2px;"></div>
<br>
<strong>C. Teaching for independent learning</strong>
   <?php $count = 1; ?>
  <?php if(!empty($personal)):?>
  <table class="table table-striped">
    <tr>
      <td width="1000"><strong>Question</strong></td>
      <td><strong>Scale</strong></td>
    </tr>
    <?php foreach ($personal as $key => $value):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $value->question_name;?></td>
      
      <td>
        <input type="radio" name="answers3<?php echo $value->q_id?>" value="5" required> 5
        <input type="radio" name="answers3<?php echo $value->q_id?>" value="4" required> 4
        <input type="radio" name="answers3<?php echo $value->q_id?>" value="3" required> 3
        <input type="radio" name="answers3<?php echo $value->q_id?>" value="2" required> 2
        <input type="radio" name="answers3<?php echo $value->q_id?>" value="1" required> 1
      </td>
    
  </tr>
    <?php endforeach;?>
  </table>
   <?php else:?>
  <?php endif;?>
  <br><strong>D. Management of learning</strong>
   <?php $count = 1; ?>
  <?php if(!empty($last)):?>
  <table class="table table-striped">
    <tr>
      <td width="1000"><strong>Question</strong></td>
      <td><strong>Scale</strong></td>
    </tr>
    <?php foreach ($last as $key => $row):?>
      <tr>
      <td><?php echo $count++;?>. <?php echo $row->question_name;?></td>
      
      <td>
        <input type="radio" name="answers4<?php echo $row->q_id?>" value="5" required> 5
        <input type="radio" name="answers4<?php echo $row->q_id?>" value="4" required> 4
        <input type="radio" name="answers4<?php echo $row->q_id?>" value="3" required> 3
        <input type="radio" name="answers4<?php echo $row->q_id?>" value="2" required> 2
        <input type="radio" name="answers4<?php echo $row->q_id?>" value="1"  required> 1
      </td>
    
  </tr>
    <?php endforeach;?>
  </table>
   <?php else:?>
  <?php endif;?>
<br>
<div class="row">
  <div class="col-md-6">
    <strong>Comment:</strong>
    <textarea class="form-control" name="comment_feedback"></textarea>

  </div>
</div>

<br>
<button class="btn btn-info btn-lg" name="submit_eval"><i class="fa fa-check"></i> Submit</button>
</form>

</div>
  
</body>
</html>
