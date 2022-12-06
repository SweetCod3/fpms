<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
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

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'MASTERY OF THE SUBJECT' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'TEACHING SKILLS AND MANAGEMENT' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'PERSONAL TRAITS' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);

$kweri4 = "SELECT * FROM questions WHERE question_cat = 'OTHER FACTORS *for dean and department head only*' ORDER BY q_id ASC";
$others = getdata_inner_join($kweri4);

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
    <li><strong>Time:</strong> <?php echo date("h:i a",strtotime($evaluate['sub_from']))?> / <?php echo date("h:i a",strtotime($evaluate['sub_until']))?></li>
    <li><strong>Day:</strong> <?php echo $evaluate['sub_day']?></li>
  </ul>
    </div>
  </div>
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
<table class="table table-striped">
    <tr>
        <td width="1050"></td>
        <td>Dean</td>
        <td>Students</td>
    </tr>
</table>
<table class="table table-striped">
    <tr>
        <td>Question</td>
        <td>Ratings</td>
        <td>Equivalent</td>
        <td>Ave. Ratings</td>
        <td>Equivalent</td>
    </tr>
    <tr>
      <td><strong>MASTERY OF THE SUBJECT</strong></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
     <?php 
     $count = 1;
     $count_student = 0;
     $count_dean = 0;
     ?>
    <?php foreach ($mastery as $key => $value):?>
    <tr>
        <td>
            <h4><?php echo $count++;?>. <?php echo $value->question_name;?></h4>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$value->q_id."' AND user_role = '3'") or die(mysqli_error());
          $result = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$value->q_id."' AND user_role = '3' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $total_dean = $result['total'] / $fetch;
          echo round($total_dean);
          ?>
        </td>
        <td>
          <?php 
          $equivalent_dean = 20 * round($total_dean) / 40;
          echo $equivalent_dean;      
           $count_dean += $equivalent_dean;    
          ?>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$value->q_id."' AND user_role = '2'") or die(mysqli_error());
          $result = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$value->q_id."' AND user_role = '2' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $q = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$value->q_id."' AND user_role = '2'") or die(mysqli_error());
          $result = $q->fetch_assoc();

          $total = $result['total'] / $fetch;
          $f = 25 * round($result['total']) / 40; 
          echo round($total);
          ?>
        </td>
        <td>
          <?php 
          $equivalent = 25 * round($total) / 40;
          echo $equivalent;
          $count_student += $equivalent;
          ?>
        </td>
    </tr>
    <?php endforeach;?>
     <tr>
      <td><strong>TEACHING SKILLS AND MANAGEMENT</strong></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
    <?php 
    $count = 1;
    $count_student2 = 0;
    $count_dean2 = 0;
    ?>
    <?php foreach ($teaching as $key => $row):?>
    <tr>
        <td>
            <h4><?php echo $count++;?>. <?php echo $row->question_name;?></h4>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$row->q_id."' AND user_role = '3'") or die(mysqli_error());
          $result = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$row->q_id."' AND user_role = '3' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $total_dean2 = $result['total'] / $fetch;
          echo round($total_dean2);


          ?>
        </td>
        <td>
          <?php 
          $equivalent_dean2 = 15 * round($total_dean2) / 40; 
          echo $equivalent_dean2;
          $count_dean2 += $equivalent_dean2;
          ?>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$row->q_id."' AND user_role = '2'") or die(mysqli_error());
          $result = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$row->q_id."' AND user_role = '2' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $total2 = $result['total'] / $fetch;
          echo round($total2);
          ?>
        </td>
        <td>
          <?php 
          $equivalent2 = 20 * round($total2) / 40; 
          echo $equivalent2;
          $count_student2 += $equivalent2;
          ?>
        </td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td><strong>PERSONAL TRAITS</strong></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
    <?php 
    $count_student3 = 0;
    $count_dean3 = 0;
    foreach ($personal as $key => $result):
    ?>
    <tr>
        <td>
            <h4><?php echo $count++;?>. <?php echo $result->question_name;?></h4>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$result->q_id."' AND user_role = '3'") or die(mysqli_error());
          $result1 = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$result->q_id."' AND user_role = '3' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $total_dean3 = $result1['total'] / $fetch;
          echo round($total_dean3);
          ?>
        </td>
        <td>
          <?php 
          $equivalent_dean3 = 5 * round($total_dean3) / 40; 
          echo $equivalent_dean3;
          $count_dean3 += $equivalent_dean3;
          ?>
        </td>
        <td>
         <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$result->q_id."' AND user_role = '2'") or die(mysqli_error());
          $fetch = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$result->q_id."' AND user_role = '2' GROUP BY result.user_id") or die(mysqli_error());
          $fetchme = mysqli_num_rows($g);

          $total3 = $fetch['total'] / $fetchme;
          echo round($total3);
          ?>
        </td>
        <td>
          <?php 
          $equivalent3 = 5 * round($total3) / 40;
          echo $equivalent3;
          $count_student3 += $equivalent3;
          ?>
        </td>
    </tr>
    <?php endforeach;?>
<tr>
      <td><strong>OTHER FACTORS *for dean and department head only*</strong></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
    <?php 
    $count_student4 = 0;
    $count_dean4 = 0;
    ?>
    <?php foreach ($others as $key => $fetch):?>
    <tr>
        <td>
            <h4><?php echo $count++;?>. <?php echo $fetch->question_name;?></h4>
        </td>
        <td>
          <?php 
          $t = $dbcon->query("SELECT SUM(r_result) as total FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$fetch->q_id."' AND user_role = '3'") or die(mysqli_error());
          $result1 = $t->fetch_assoc();

          $g = $dbcon->query("SELECT * FROM result 
            INNER JOIN user_account on user_account.user_id = result.user_id
            WHERE e_code = '".$_GET['e_code']."' AND r_question = '".$fetch->q_id."' AND user_role = '3' GROUP BY result.user_id") or die(mysqli_error());
          $fetch = mysqli_num_rows($g);

          $total_dean4 = $result1['total'] / $fetch;

          echo round($total_dean4);
          ?>
        </td>
        <td>
          <?php 
          $equivalent_dean4 = 10 * round($total_dean4) / 40; 
          echo $equivalent_dean4;
          $count_dean4 += $equivalent_dean4;
          ?>
        </td>
        <td>
         
        </td>
        <td></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td></td>
      <td></td>
      <td>Total: 
        <?php $dean_total = $count_dean4 + $count_dean3 + $count_dean2 + $count_dean;
        echo $dean_total; 
        ?>
        
      </td>
      <td></td>
      <td>Total: 
      <?php $student_total = $count_student3 + $count_student2 + $count_student;
        echo $student_total; 
        $grand_total = $student_total + $dean_total;
      ?>
          
        </td>
    </tr>
    <tr>
      <td><h1>Total: <?php echo $grand_total;?></h1></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
</table>
</div>
  
</body>
</html>
