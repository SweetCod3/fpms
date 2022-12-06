<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_admin'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$query = "SELECT ipcrf_stratprio.*, ipcrf_category.cat_name FROM (ipcrf_stratprio INNER JOIN ipcrf_category ON ipcrf_stratprio.sp_cat = ipcrf_category.cat_id) ORDER BY sp_id ASC";
$question = getdata_inner_join($query);
$cat = getdata_where("*", "user_id", "user_account", $_GET['prof_id']);

$sql = "SELECT * FROM ipcrf_category ORDER BY cat_id ASC";
$items = $dbcon->query($sql) or die($dbcon->error);
$row = $items->fetch_assoc();

$pql = "SELECT * FROM user_account WHERE user_id =".$_GET['prof_id'];
$ptems = $dbcon->query($pql) or die($dbcon->error);
$pow = $ptems->fetch_assoc();


$alWt = 0;

function fetchData(){

  $db_server = "localhost:3306"; // server 127.0.0.1
  $db_user = "root"; // databe user name
  $db_pass = ""; //password
  $db_name = "evaluation"; //daiontabase name 
  
  $dbcon = new mysqli($db_server,$db_user,$db_pass,$db_name);
  if ($dbcon->connect_error) 
  {
      die("Connection failed: " . $dbcon->connect_error);
  }
  

$sql = "SELECT * FROM ipcrf_category ORDER BY cat_id ASC";
$output ="";
$items = $dbcon->query($sql) or die($dbcon->error);
$row = $items->fetch_assoc();
$alWt =0;
  $i = 1;
  do {
      $output.='
      <tr>
      <th style="text-align: center;";colspan="2"> MFO'.$i. ':'.$row['cat_name'].'</th>
      </tr>';
      $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'] . " ORDER BY sp_id ASC";
      $sitems = $dbcon->query($sql) or die($dbcon->error);
      $stratrow = $sitems->fetch_assoc();

      $j = 1;
      do {  $stratWt = 0;
       $output.= '<tr>
        <td colspan ="2" Style="color:red;">Strategic Priority '.$i.'.'.$j. ' '. $stratrow['sp_desc'].'</td>
      </tr>';

      $sql = "SELECT * FROM ipcrf_measures WHERE meas_sp =" . $stratrow['sp_id'];
      $mitems = $dbcon->query($sql) or die($dbcon->error);
      $measrow = $mitems->fetch_assoc();

      do {
        $sql = "SELECT * FROM ipcrf_ansm WHERE mans_meas =" . $measrow['meas_id'] . " AND mans_fid =" . $_GET['prof_id'];
        $amitems = $dbcon->query($sql) or die($dbcon->error);
        $ameasrow = $amitems->fetch_assoc();
        $prod = ($measrow['meas_wt']* 100)."%";
        $output.= '<tr>
          <td colspan="2" > <u><b>Measure: </b>'.$measrow['meas_desc'].'('.$prod.') </u></td>
        </tr>
        <tr>
          <td>Accomplishment: '.$ameasrow['mans_accomp'].'</td>
          <td>Remark: '.$ameasrow['mans_remark'].'</td>
        </tr>
        ';

        $sql = "SELECT * FROM ipcrf_target WHERE t_meas =" . $measrow['meas_id'];
        $titems = $dbcon->query($sql) or die($dbcon->error);
        $teasrow = $titems->fetch_assoc();

        do {
          $sql = "SELECT * FROM ipcrf_anst WHERE ans_target =" . $teasrow['t_id'] . " AND ans_fid =" . $_GET['prof_id'];
          $atitems = $dbcon->query($sql) or die($dbcon->error);
          $ateasrow = $atitems->fetch_assoc();
          $targval = 0;
          $targCount = 0;
          $targval += $ateasrow['ans_val'];
          $scr = filter($ateasrow['ans_val']);
          
          $output.=   '<tr>
          <td style="width: 50%;">'.$teasrow['t_type'].' - '.$teasrow['t_desc'].'<br>
          </td>
          <td>'
             .$teasrow['t_type'].' - '.$scr.'
          </td>
        </tr>';
        $targCount++;
      } while ($teasrow = $titems->fetch_assoc());
      $output.=     '<tr>
        <td><b>Average for this measure:'.($targval / $targCount).'/5 </b> </td>
        <td><b>Weighted Average ('.$measrow['meas_wt'].'):'.(($targval / $targCount) * $measrow['meas_wt']) . '/5 </b> </td>
      </tr>';
      $stratWt += ($targval / $targCount) * $measrow['meas_wt'];
    } while ($measrow = $mitems->fetch_assoc());
    $j++;
    
    $output.='<tr>
      <td><b>Weighted Average for this Strategic Priority:'.$stratWt.'/5 </b> </td>

    </tr>';
    $alWt += $stratWt;
    switch (true) {
      case $alWt > 4.75:
        $rating = "Outstanding";
        break;
      case $alWt > 4.00:
        $rating = "Very Satisfactory";
        break;
      case $alWt > 3.00:
        $rating = "Satisfactory";
        break;
      case $alWt > 2.00:
        $rating = "Unsatisfactory";
        break;
      default:
      $rating = "Poor";
        break;
    }
  } while ($stratrow = $sitems->fetch_assoc());
  $i++;

  } while ($row = mysqli_fetch_array($items));
   $output.='<tr>
   <td style="width:100%; font-size: 15px; text-align:center;"><b>Final Rating:'.$alWt.' - '.$rating.'</b> </td>
 </tr>
 <tr>
 <td style="width:100%;"> Comments and Recommendation for Development Purporses </td>
 <td style="height:100px; "> Comments and Recommendation for Development Purporses </td>
</tr>
 <tr style="text-align:center;">
 <td style="width:16.666666666666666666666666666667%;">Discussed with</td>
 <td style="width:16.666666666666666666666666666667%;">Date</td>
 <td style="width:16.666666666666666666666666666667%;">Assessed by</td>
 <td style="width:16.666666666666666666666666666667%;">Date</td>
 <td style="width:16.666666666666666666666666666667%;">Final Rating by</td>
 <td style="width:16.666666666666666666666666666667%;">Date</td>
</tr>
 <tr style="text-align:center;">
 <td style="width:16.666666666666666666666666666667%;">Johanna E. Ave <br> Employee</td>
 <td style="width:16.666666666666666666666666666667%;" rowspan="2";>'.date('y-m-d').'</td>
 <td style="width:16.666666666666666666666666666667%;">Mary Rose B. Martinez <br> BSIS Program Chair</td>
 <td style="width:16.666666666666666666666666666667%;" rowspan="2";>'.date('y-m-d').'</td>
 <td style="width:16.666666666666666666666666666667%;">EUGENIA V. GUERRA <br> Head of Office</td>
 <td style="width:16.666666666666666666666666666667%;" rowspan="2";>'.date('y-m-d').'</td>
</tr>
 ';
  return $output;
  }




if (isset($_POST["create_pdf"])) {
  require_once("TCPDF-main/tcpdf.php");
  
  
  
  class PDF extends TCPDF 
  {
      function Header()
      {
          $imageFile = K_PATH_IMAGES. 'logo.jpg';
  
          $this -> Image($imageFile, 60,7,25,'','JPG','','C',false,300,'',false,false, 0,false,false,false);
          $this ->Ln(10);
          $this -> setFont('helvetica','8',12);
          $this -> Cell(275,5,'DR.FILEMON C. AGUILAR MEMORIAL COLLEGE OF LAS PIÑAS',0,1,'C');
          $this -> setFont('helvetica','8',12); 
          $this -> Cell(275,3,'Golden Gate Subd., Talon III, Las Piñas City',0,1,'C');
          $this -> Cell(275,3,'Tel No. 403-1985, 478-8671, 519-1960',0,1,'C');
          $this ->Ln(10);
  
      
  
      }
      function Footer()
      {
          
      }
  }
  
  
  
  
  // create new PDF document
  $obj_pdf = new PDF('L', 'mm', 'A4', true, 'UTF-8', false);
  
  // set document information
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetAuthor('Inventory Coordinator');
  $obj_pdf->SetTitle('Sample report');
  $obj_pdf->SetSubject(' ');
  $obj_pdf->SetKeywords(' ');
  
  // set default header data
  $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
  $obj_pdf->setFooterData(array(0,64,0), array(0,64,128));
  
  // set header and footer fonts
  $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
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
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $obj_pdf->setLanguageArray($l);
  }
  
  // set default font subsetting mode
  $obj_pdf->setFontSubsetting(true);
  
  // Set font
  // dejavusans is a UTF-8 Unicode font, if you only need to
  // print standard ASCII chars, you can use core fonts like
  // helvetica or times to reduce file size.
  $obj_pdf->SetFont('helvetica', '', 10, '', true);
  
  
  
  
  
  $dbcontent = '';
  
 
  
  $dbcontent .='
      <br>
      <br>
      <br>
      <br>
      <h3 align="center"> City Government of Las Piñas <br>
      Individual Performance Commitment and Review Form (IPCRF)</h3>

      <p>  I, <u> Martinez, Mary Rose</u>, of the <u>Academic Affairs Office</u> 
      commit to deliver and agree to be rated on the attainment of the following targets in 
      accordance with the indicated measures for the period of 1st Semester SY 2021-2022.</p>

      <p>Name of Employee: <b>'.$pow['fname'].' '. $pow['mname']. ' '.$pow['lname']. ' '.$pow['suffix']. '</b> '.'<br>Employment Status: <b>Employed - Professor 2 </b></p>
      
      <table border = "1" cellspacing ="0" cellpadding = "5" style="font-size: 10px;">
      <tr align="center" >
      <th width ="35%"; >Reviewed by:  </th>
      <th width ="15%"; >Date:  </th>
      <th width ="35%"; >Approved by:</th>
      <th width ="15%"; >Date:  </th>
      </tr>
      <tr align="center" >
      <th width ="35%"; > John Doe </th>
      <th width ="15%";  rowspan="2"> '.date('y-m-d').' </th>
      <th width ="35%"; > Mary Sue</th>
      <th width ="15%";  rowspan="2"> '.date('y-m-d').' </th>
      </tr>
      <tr align="center" >
      <th width ="35%"; >Supervisor  </th>
      <th width ="35%"; >Head of the Office</th>
      </tr>
      </table>
      <table border = "1" cellspacing ="0" cellpadding = "5" style="font-size: 10px;">
      ';

      $dbcontent .= fetchData();
      $dbcontent .= '</table>';
      $dbcontent .= "  ";
  

  $obj_pdf->AddPage();
  
  $obj_pdf -> writeHTML($dbcontent);
  
  $obj_pdf -> Output("sample.pdf", "I");
  
  
  }




















switch (true) {
  case isset($_POST['save_button']):


    $sql = "SELECT * FROM ipcrf_ansm WHERE mans_fid = " . $_GET['prof_id'];
    $measure = $dbcon->query($sql) or die($dbcon->error);
    $mrow = $measure->fetch_assoc();

    do {
      $mid = $mrow['mans_id'];
      $aid =   $_POST['ac-' . $mrow['mans_id']];
      $rid =   $_POST['re-' . $mrow['mans_id']];

      $kweri = "UPDATE  `ipcrf_ansm` SET `mans_accomp` = '" . $aid . "', `mans_remark` = '" . $rid . "' WHERE `mans_id` = '" . $mid . "'";
      $exec = $dbcon->query($kweri) or die($dbcon->error);
    } while ($mrow = $measure->fetch_assoc());

    $sql = "SELECT * FROM ipcrf_anst WHERE ans_fid = " . $_GET['prof_id'];
    $targs = $dbcon->query($sql) or die($dbcon->error);
    $trow = $targs->fetch_assoc();

    do {
      $haha = "scr-" . $trow['ans_id'];
      $anv = $_POST[$haha];
      $anId = $trow['ans_id'];

      $kweri = "UPDATE `ipcrf_anst` SET `ans_val` = '" . $anv . "' WHERE `ans_id` = '" . $anId . "'";

      $exec = $dbcon->query($kweri) or die($dbcon->error);
    } while ($trow = $targs->fetch_assoc());

    if ($_GET['appr'] == 0) {
      $arr_where = array("fans_fid"  => $_GET['prof_id']); //update where
      $arr_set   = array(
        "fans_appr"     => 1
      );
      $tbl_name  = "ipcrf_ansf";
      $update    = update($dbcon, $tbl_name, $arr_set, $arr_where);
  } else{
    $arr_where = array("fans_fid"  => $_GET['prof_id']); //update where
    $arr_set   = array(
      "fans_appr"     => 2,
      "fans_frate"     => $_POST['rt'],
      "fans_appr_admin"     => $_SESSION['user_id'],
      "fans_appr_date"      => date("Y-m-d h:i a")
    );
    $tbl_name  = "ipcrf_ansf";
    $update    = update($dbcon, $tbl_name, $arr_set, $arr_where);
  }
    

    $arr_where = array("user_id"  => $_GET['prof_id']); //update where
    $arr_set   = array(
      "ipcrf"     => 1
    ); //set update
    $tbl_name  = "user_account";
    $update    = update($dbcon, $tbl_name, $arr_set, $arr_where); // UPDATE SQL
    break;

header("location: questions.php");

}
if (isset($_GET['q_id'])) :
  $info = getdata_where("*", "q_id", "questions", filter($_GET['q_id']));
  if (!empty($info)) {
    foreach ($info as $key => $value) {
      $question_name = $value->question_name;
      $question_cat  = $value->question_cat;
      /*
         $avg_rate      = $value->avg_rate;
         $rate_dean     = $value->rate_dean;
         */
    }
  } else {
    header("location: error.php");
  }
endif;
?>
<?php include '../assets/admin_header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include '../assets/admin_nav.php'; ?>
    <?php include '../assets/admin_sidebar.php'; ?>

    <div class="content-wrapper">
      <!-- Main content -->
      <section style="padding:11px;">

        <div class="box box-solid" style="padding:15px;">
          <div class="box-header with-border">
            <h3> Submitted by: <b>
                <?php foreach ($cat as $key => $value) : ?>
                  <?php echo $value->fname ?> <?php echo $value->mname ?>
                  <?php echo $value->lname ?> <?php echo $value->suffix ?>
                <?php endforeach ?>
              </b></h3> 
              <?php if ($_GET['appr'] == 2):
                ?>

              <form action="" method="post">
              <input  type="submit" name="create_pdf" class="btn btn-danger" value="Generate User report PDF"></input>
              </form><br><br>
                <?php 
              endif?>
      
            <form method="post">
              <table id="example1" class="table table-bordered table-striped" style="font-size:16px;">
                <?php
                $i = 1;
                do {

                ?>

                

                    <tr style="font-size:large; text-align:center;">
                      <th colspan="2"> MFO <?php echo "#" . $i . ": " . $row['cat_name'] ?> </th>
                    </tr>
                    <?php

                    $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'] . " ORDER BY sp_id ASC";
                    $sitems = $dbcon->query($sql) or die($dbcon->error);
                    $stratrow = $sitems->fetch_assoc();

                    $j = 1;
                    do {
                      $stratWt = 0;
                    ?>


                      <tr>
                        <td>
                          <pre>Strategic Priority <?php echo $i . "." . $j . " " . $stratrow['sp_desc'] ?></pre>
                        </td>
                      </tr>

                      <?php

                      $sql = "SELECT * FROM ipcrf_measures WHERE meas_sp =" . $stratrow['sp_id'];
                      $mitems = $dbcon->query($sql) or die($dbcon->error);
                      $measrow = $mitems->fetch_assoc();




                      do {
                        $sql = "SELECT * FROM ipcrf_ansm WHERE mans_meas =" . $measrow['meas_id'] . " AND mans_fid =" . $_GET['prof_id'];
                        $amitems = $dbcon->query($sql) or die($dbcon->error);
                        $ameasrow = $amitems->fetch_assoc();
                      ?>
                        <tr style="font-size:medium; color:#FF2E1B;">
                          <td colspan="2"> <b><?php echo $measrow['meas_desc'];
                                              echo " (" . $measrow['meas_wt'] * 100 . "%)" ?><br>
                              <textarea   <?php if ($_GET['appr'] != 0) :echo "readonly"; endif ?> class="form-control" name="ac-<?php echo $ameasrow['mans_id']; ?>" placeholder="Please type your Actual Accomplishment in this Measure"><?php echo $ameasrow['mans_accomp'] ?></textarea>
                              <textarea   <?php if ($_GET['appr'] != 0) :echo "readonly"; endif ?> class="form-control" name="re-<?php echo $ameasrow['mans_id']; ?>" placeholder="Please type your Remarks in this Measure"><?php echo $ameasrow['mans_remark'] ?></textarea>
                            </b>
                          </td>
                        </tr>

                        <?php


                        $sql = "SELECT * FROM ipcrf_target WHERE t_meas =" . $measrow['meas_id'];
                        $titems = $dbcon->query($sql) or die($dbcon->error);
                        $teasrow = $titems->fetch_assoc();



                        do {
                          $sql = "SELECT * FROM ipcrf_anst WHERE ans_target =" . $teasrow['t_id'] . " AND ans_fid =" . $_GET['prof_id'];
                          $atitems = $dbcon->query($sql) or die($dbcon->error);
                          $ateasrow = $atitems->fetch_assoc();
                          $targval = 0;
                          $targCount = 0;
                        ?>

                          <tr>
                            <td style="width: 50%;"> <?php echo $teasrow['t_type'];
                                                      echo " - ";
                                                      echo $teasrow['t_desc']; ?> <br>

                            </td>
                            <td>
                              <?php echo $teasrow['t_type'];
                              echo " - ";
                              $targval += $ateasrow['ans_val'];
                              $scr = filter($ateasrow['ans_val']);

                              ?> <input type="number" min="0" max="5"   <?php if ($_GET['appr'] != 0) :echo "readonly"; endif?> name=<?php echo '"scr-' . $ateasrow['ans_id'] . '"'; ?> <?php echo "value='" . $scr . "'" ?>> <br>

                            </td>
                          </tr>

                        <?php
                          $targCount++;
                        } while ($teasrow = $titems->fetch_assoc());
                        ?>
                        <tr>
                          <td><b>Average for this measure: <?php echo ($targval / $targCount) . "/5" ?> </b> </td>
                          <td><b>Weighted Average <?php echo "(" . $measrow['meas_wt'] . "):" . (($targval / $targCount) * $measrow['meas_wt']) . "/5" ?> </b> </td>
                        </tr>
                      <?php
                        $stratWt += ($targval / $targCount) * $measrow['meas_wt'];
                      } while ($measrow = $mitems->fetch_assoc());
                      $j++;
                      ?>
                      <tr>
                        <td><b>Weighted Average for this Strategic Priority: <?php echo $stratWt . "/5" ?> </b> </td>

                      </tr>
                  <?php

                      $alWt += $stratWt;
                    } while ($stratrow = $sitems->fetch_assoc());
                    $i++;
                  } while ($row = $items->fetch_assoc());
                  ?>
                  <tr>
                    <td style="background-color: #F5AC02 ; color:#211700; font-size:large;" colspan="2">
                      <?php if ($_GET['appr'] == 0) :
                        echo '<b>Initial Weighted Average :' . $alWt . '/5</b>';
                      elseif ($_GET['appr'] >= 1) :
                        echo '<b>Final Weighted Rate :' . $alWt . '/5</b>';
                      endif; ?>

                      </p>
                    </td>

                  </tr>


              </table>
              <?php if ($_GET['appr'] != 2) {
              ?>

                <input style="display: none;" type="number" value="<?php echo $alWt ?>" name="rt">

              
              <center>
                <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                <button class="btn btn-primary" name="save_button">
                  <i class="fa fa-save"></i> <?php if ($_GET['appr'] != 0){echo "Approve this Rating"; }else{echo "Submit ratings";} ?>
                </button>
              </center>
              <?php
              } ?>
            </form>
            <br>
            <br>
          </div>
        </div>
      </section>
    </div>
    <?php include '../assets/admin_footer.php'; ?>

    ?>
</body>

</html>