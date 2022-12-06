<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_admin'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT comment_type.*, user_account.* FROM (comment_type INNER JOIN user_account ON comment_type.com_uid = user_account.user_id)";
$question = getdata_inner_join($query);





function fetchData()
{
 
  $db_server = "localhost:3306"; // server 127.0.0.1
  $db_user = "root"; // databe user name
  $db_pass = ""; //password
  $db_name = "evaluation"; //daiontabase name 

  $dbcon = new mysqli($db_server, $db_user, $db_pass, $db_name);
  if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
  }

  $sql= "SELECT comment_type.*, user_account.* FROM (comment_type INNER JOIN user_account ON comment_type.com_uid = user_account.user_id)";
  $atems = $dbcon->query($sql) or die($dbcon->error);
  $al = $atems->fetch_assoc();
  

  $output= '  <h3> Comments </h3>
          
            '; do{

 $output.= '<p> - '.$al['comment_feedback'].'</p>

              ';}while ($al = $atems->fetch_assoc());
            
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
      $this->Ln(10);
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
  $obj_pdf->SetTitle('Comment Report');
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
  $obj_pdf->SetFont('helvetica', '', 10, '', true);





  $dbcontent = '';



  $dbcontent .= '
      <br>
      <br>
      <br>
      <br>
      <h3 align="center"> Evaluation Results <br>
      Comments Retrieved from Evaluation Forms </h3>

      
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
    
      
      ';

  $dbcontent .= fetchData();
  $dbcontent .= "  ";


  $obj_pdf->AddPage();

  $obj_pdf->writeHTML($dbcontent);

  $obj_pdf->Output("sample.pdf", "I");
}








if (isset($_GET['delete'])) { // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("meas_id" => $delete); //WHERE statement
  $tbl_name = "ipcrf_measures";
  $del = Delete($dbcon, $tbl_name, $ar);
  if ($del) {
    header("location: ipcrf_measures.php");
  }
}
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
            <h3 class="box-title"><i class="fa fa-book"></i> Evaluation Comments
              <br><br>
              <center>
                <form action="" method="post">
                  <input type="submit" name="create_pdf" class="btn btn-danger" value="Generate Evaluation Comment PDF"></input>
                </form>
              </center>
              <hr>
              <?php if (!empty($question)) : ?>
                <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                  <thead>
                    <tr>
                      <th width="20%">Comment id</th>
                      <th width="40%">Comment</th>
                      <th width="40%">Commenter/Student</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($question as $key => $value) : ?>

                      <tr>
                        <td>
                          <?php echo $value->comment_id; ?>
                        </td>
                        <td>
                          <?php echo $value->comment_feedback; ?>
                        </td>
                        </td>
                        <td>
                          <?php echo $value->fname.' '.$value->mname.' '.$value->lname; ?>
                        </td>




                      </tr>
                    <?php endforeach; ?>
                </table>
              <?php else : ?>
                <div class="alert alert-danger">There are no records on the database.</div>
              <?php endif; ?>
          </div>


        </div>
      </section>



      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../assets/admin_footer.php'; ?>
</body>

</html>