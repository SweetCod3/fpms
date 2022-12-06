<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_prof'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}


function fetchData()
{
$output ='';
  $db_server = "localhost:3306"; // server 127.0.0.1
  $db_user = "root"; // databe user name
  $db_pass = ""; //password
  $db_name = "evaluation"; //daiontabase name 

  $dbcon = new mysqli($db_server, $db_user, $db_pass, $db_name);
  if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
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

$count = 1;
if(!empty($mastery)){
  $output= '
  <table class="table table-striped">
    <tr>
      <td><strong>A. Commitment - Questions</strong></td>
    </tr>'; foreach ($mastery as $key => $value){
      $output.= '<tr>
      <td>'.$count++.'.'.$value->question_name.'</td>
  </tr>';};
  
  $output.= '</table>';

  $total1 = 0;
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'A. Commitment' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total1 += $row['total'] / $count;
  }}
 
 $output.=' <div style="border-bottom:1px solid #333;height: 2px;"></div>';
  
  $count = 1;
  if(!empty($teaching)){
    $output.='<table >
    <tr>
    <td><strong>B. Knowledge of the subject - Questions</strong></td>

   
    </tr>';
    foreach ($teaching as $key => $value){
 $output.='<tr>
      <td>'.$count++.'.'.$value->question_name.'</td>
  </tr>';
    };
    $output.='  </table>';

$total2 = '0';
  $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'B. Knowledge of the subject' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
  $count = mysqli_num_rows($query3);
  while($row = $query3->fetch_assoc()){

    $total2 += $row['total'] / $count;
  }}  
$output.='
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
<br>
<strong></strong>';
$count = 1;
  if(!empty($personal)){
    $output.='<table >
    <tr>
      <td><strong>C. Teaching for independent learning - Question</strong></td>
    </tr>'; 
    
    foreach ($personal as $key => $value){
      $output.='<tr>
      <td>'.$count++.'.'.$value->question_name.'</td>
  </tr>';
    }
    $output.='</table>';
    $total3 = 0;
      $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'C. Teaching for independent learning' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
      $count = mysqli_num_rows($query3);
      while($row = $query3->fetch_assoc()){
    
        $total3 += $row['total'] / $count;
      }}


     $output.='
  <div style="border-bottom:1px solid #333;height: 2px;"></div>
     
     <br><strong></strong>';
     $count = 1; 
    if(!empty($last)){
      $output.='<table >
        <tr>
          <td><strong>D. Management of learning - Question</strong></td>
        </tr>';
        foreach ($last as $key => $row){
          $output.='<tr>
          <td>'.$count++.'.'.$row->question_name.'</td>  
      </tr>';
       }
        $output.='</table>';
      
        $total4 = '0';
          $query3 = $dbcon->query("SELECT SUM(r_result / 5) as total FROM `result` WHERE question_cat = 'D. Management of learning' AND e_code = '".$_GET['e_code']."' GROUP BY user_id") or die(mysqli_error());
          $count = mysqli_num_rows($query3);
          while($row = $query3->fetch_assoc()){
        
            $total4 += $row['total'] / $count;
          }}
          $output.='<br>';

          $output.='<h1> Overall Rating:';          
          
          $grand = ($total1 + $total2 + $total3 + $total4) / 4; 
          switch (true) {
            case $grand > 4.75:
              $rating = "Outstanding";
              break;
            case $grand > 4.00:
              $rating = "Very Satisfactory";
              break;
            case $grand > 3.00:
              $rating = "Satisfactory";
              break;
            case $grand > 2.00:
              $rating = "Unsatisfactory";
              break;
            default:
            $rating = "Poor";
              break;
          }
          $output.= ' '.$grand.' - '.$rating.'</h1>';          
          

  return $output;
}




if (isset($_POST["create_pdf"])) {
  require_once("TCPDF-main/tcpdf.php");



  class PDF extends TCPDF
  {
    function Header()
    {
      $imageFile = K_PATH_IMAGES . 'logo.jpg';

      $this->Image($imageFile, 28, 7, 20, '', 'JPG', '', 'C', false, 300, '', false, false, 0, false, false, false);
      $this->Ln(10);
      $this->setFont('helvetica', '8', 10);
      $this->Cell(180, 3, 'DR.FILEMON C. AGUILAR MEMORIAL COLLEGE OF LAS PIÑAS', 0, 1, 'C');
      $this->setFont('helvetica', '8', 10);
      $this->Cell(180, 3, 'Golden Gate Subd., Talon III, Las Piñas City', 0, 1, 'C');
      $this->Cell(180, 3, 'Tel No. 403-1985, 478-8671, 519-1960', 0, 1, 'C');
      $this->Ln(6);
    }
    function Footer()
    {
    }
  }




  // create new PDF document
  $obj_pdf = new PDF('P', 'mm', 'A4', true, 'UTF-8', false);

  // set document information
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetAuthor('Inventory Coordinator');
  $obj_pdf->SetTitle('Evaluation Report');
  $obj_pdf->SetSubject(' ');
  $obj_pdf->SetKeywords(' ');

  // set default header data
  $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
  $obj_pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

  // set header and footer fonts
  $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

  // set default monospaced font
  $obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

  // set margins
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 35, PDF_MARGIN_RIGHT);
  $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

  // set auto page breaks
  $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

  // set image scale factor
  $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

  // set some language-dependent strings (optional)
  if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $obj_pdf->setLanguageArray($l);
  }

  // set default font subsetting mode
  $obj_pdf->setFontSubsetting(true);

  // Set font
  // dejavusans is a UTF-8 Unicode font, if you only need to
  // print standard ASCII chars, you can use core fonts like
  // helvetica or times to reduce file size.
  $obj_pdf->SetFont('helvetica', '', 9, '', true);





  $dbcontent = '';



  $dbcontent .= '

      <h3 align="center"> Evaluation Results </h3>

      <table border = "1" cellspacing ="0" cellpadding = "5" style="font-size: 10px;">
      <tr align="center" >
      <th width ="35%"; >Reviewed by:  </th>
      <th width ="15%"; >Date:  </th>
      <th width ="35%"; >Approved by:</th>
      <th width ="15%"; >Date:  </th>
      </tr>
      <tr align="center" >
      <th width ="35%"; > John Doe </th>
      <th width ="15%";  rowspan="2"> ' . date('y-m-d') . ' </th>
      <th width ="35%"; > Mary Sue</th>
      <th width ="15%";  rowspan="2"> ' . date('y-m-d') . ' </th>
      </tr>
      <tr align="center" >
      <th width ="35%"; >Supervisor  </th>
      <th width ="35%"; >Head of the Office</th>
      </tr>
      </table>
      <br>
      <br>
      <br>
      <br>
      ';

  $dbcontent .= fetchData();
  $dbcontent .= "  ";


  $obj_pdf->AddPage();

  $obj_pdf->writeHTML($dbcontent);

  $obj_pdf->Output("sample.pdf", "I");
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
            <br><br>
              <center>
                <form action="" method="post">
                  <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Evaluation Comment PDF"></input>
                </form>
              </center>

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
   <?php else:?>
  <?php endif;?>
<br>
<?php /* ?>
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
  <?php endwhile; ?></div>
</div>
<br>
<?php */ ?>
<div class="alert alert-info">
<h1 >Overall Rating: <?php $grand = ($total1 + $total2 + $total3 + $total4) / 4; 

switch (true) {
  case $grand > 4.75:
    $rating = "Outstanding";
    break;
  case $grand > 4.00:
    $rating = "Very Satisfactory";
    break;
  case $grand > 3.00:
    $rating = "Satisfactory";
    break;
  case $grand > 2.00:
    $rating = "Unsatisfactory";
    break;
  default:
  $rating = "Poor";
    break;
}

echo $grand." - ".$rating;?></h1>
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
  