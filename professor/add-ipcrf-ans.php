<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_prof'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$query = "SELECT ipcrf_stratprio.*, ipcrf_category.cat_name FROM (ipcrf_stratprio INNER JOIN ipcrf_category ON ipcrf_stratprio.sp_cat = ipcrf_category.cat_id) ORDER BY sp_id ASC";
$question = getdata_inner_join($query);
$cat = getdata("*", "ipcrf_category");

$sql = "SELECT * FROM ipcrf_category ORDER BY cat_id ASC";
$items = $dbcon->query($sql) or die($con->error);
$row = $items->fetch_assoc();

$sql = "SELECT * FROM user_account WHERE user_id = " . $_SESSION['user_id'];
            $user = $dbcon->query($sql) or die($con->error);
            $urow = $user->fetch_assoc();

if ($urow['ipcrf'] != 0) {

$kuery = "SELECT * FROM ipcrf_ansf WHERE fans_fid =".$_SESSION['user_id'];
$ktems = $dbcon->query($kuery) or die($dbcon->error);
$krow = $ktems->fetch_assoc();
$result = intval($krow['fans_frate']) ;

switch (true) {
  case $result > 4.75:
    $rating = "Outstanding";
    break;
  case $result > 4.00:
    $rating = "Very Satisfactory";
    break;
  case $result > 3.00:
    $rating = "Satisfactory";
    break;
  case $result > 2.00:
    $rating = "Unsatisfactory";
    break;
  default:
  $rating = "Poor";
    break;}
  
if ($krow['fans_appr'] >= 2) {

$admin = "SELECT ipcrf_ansf.*, user_account.* FROM (ipcrf_ansf INNER JOIN user_account ON ipcrf_ansf.fans_appr_admin = user_account.user_id) WHERE fans_fid =".$_SESSION['user_id'];
$atems = $dbcon->query($admin) or die($dbcon->error);
$arow = $atems->fetch_assoc();


}
}
$alWt =0;
switch (true) {
  case isset($_POST['save_button']):

    if (isset($_GET['q_id'])) {
      $arr_where = array("q_id"  => $_GET['q_id']); //update where
      $arr_set   = array(
        "question_name"     => $question_name,
        "question_cat"      => $question_cat
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/,
        "date_created"      => date("Y-m-d h:i a")
      ); //set update
      $tbl_name  = "questions";
      $update    = update($dbcon, $tbl_name, $arr_set, $arr_where); // UPDATE SQL
      header("location: questions.php");
    } else {


      $sql = "SELECT ipcrf_measures.*, ipcrf_stratprio.* FROM (ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id)";
      $measure = $dbcon->query($sql) or die($con->error);
      $mrow = $measure->fetch_assoc();

      do {
        $data = array(
          "mans_fid"     => $_SESSION['user_id'],
          "mans_meas"     => $mrow['meas_id'],
          "mans_accomp"     => filter($_POST['ac-' . $mrow['meas_id']]),
          "mans_remark"     => filter($_POST['re-' . $mrow['meas_id']]),
          "mans_date"      => date("Y-m-d h:i a")
        );
        insertdata("ipcrf_ansm", $data);
      } while ($mrow = $measure->fetch_assoc());

      $sql = "SELECT ipcrf_target.* FROM ((ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) INNER JOIN ipcrf_target ON ipcrf_target.t_meas = ipcrf_measures.meas_id )";
      $targs = $dbcon->query($sql) or die($con->error);
      $trow = $targs->fetch_assoc();

      do {
        $data = array(
          "ans_fid"     => $_SESSION['user_id'],
          "ans_target"     => $trow['t_id'],
          "ans_val"     => $_POST['scr-' . $trow['t_id']],
          "ans_date"      => date("Y-m-d h:i a")
        );
        insertdata("ipcrf_anst", $data);
      } while ($trow = $targs->fetch_assoc());

        $data = array(
          "fans_fid"     => $_SESSION['user_id'],
          "fans_date"      => date("Y-m-d h:i a")
        );
        insertdata("ipcrf_ansf", $data);

        $arr_where = array("user_id"  => $_SESSION['user_id']); //update where
        $arr_set   = array(
          "ipcrf"     => 1
        ); //set update
        $tbl_name  = "user_account";
        $update    = update($dbcon, $tbl_name, $arr_set, $arr_where); // UPDATE SQL

      header("location: index.php");
    }

    break;
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

            <?php

            
            if ($urow['ipcrf'] == 0) {
            ?>

            
              <form method="post">
                <table id="example1" class="table table-bordered table-striped" style="font-size:16px;">
                  <?php
                  $i = 1;
                  do {
                  ?>

                    <h4>
                  
                      <tr style="font-size:large; text-align:center;">
                        <th> MFO <?php echo "#" . $i . ": " . $row['cat_name'] ?> </th>
                      </tr>
                      <?php

                      $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'];
                      $sitems = $dbcon->query($sql) or die($con->error);
                      $stratrow = $sitems->fetch_assoc();

                      $j = 1;
                      do { ?>


                        <tr>
                          <td>
                            <pre>Strategic Priority <?php echo $i . "." . $j . " " . $stratrow['sp_desc'] ?></pre>
                          </td>
                        </tr>

                        <?php

                        $sql = "SELECT ipcrf_measures.*, ipcrf_stratprio.* FROM (ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) WHERE meas_sp =" . $stratrow['sp_id'];
                        $mitems = $dbcon->query($sql) or die($con->error);
                        $measrow = $mitems->fetch_assoc();


                        do { ?>
                          <tr style="font-size:medium; color:#FF2E1B;">
                            <td> <b><?php echo $measrow['meas_desc'];
                                    echo " (" . $measrow['meas_wt'] * 100 . "%)" ?><br>
                                <textarea class="form-control" name="ac-<?php echo $measrow['meas_id']; ?>" 
                                <?php if ($measrow['access'] == 0) {
                                echo  'placeholder="Please type your Actual Accomplishment in this Measure"';
                                } else {
                                  echo  'placeholder="This is to be answered by an Admin."';
                                  echo "readonly";
                                }?>
                                ></textarea>
                                <textarea class="form-control" name="re-<?php echo $measrow['meas_id']; ?>" 
                                <?php if ($measrow['access'] == 0) {
                                echo  'placeholder="Please type your Actual Accomplishment in this Measure"';
                                } else {
                                  echo  'placeholder="This is to be answered by an Admin."';
                                  echo "readonly";
                                }?>></textarea>
                              </b></td>
                          </tr>

                          <?php

                          $sql = "SELECT ipcrf_target.*, ipcrf_stratprio.access FROM ((ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) INNER JOIN ipcrf_target ON ipcrf_target.t_meas = ipcrf_measures.meas_id ) WHERE t_meas =" . $measrow['meas_id'];
                          $titems = $dbcon->query($sql) or die($con->error);
                          $teasrow = $titems->fetch_assoc();

                          do { ?>

                            <tr>
                              <td> <?php echo $teasrow['t_type'];
                                    echo " - ";
                                    echo $teasrow['t_desc']; ?> <br>
                                
                                <input type="number" name="scr-<?php echo $teasrow['t_id']; ?>" id="1" min="1" max="5"
                                
                                <?php if ($measrow['access'] != 0) {
                                echo  ' readonly';
                                }?>>
                                
                              

                              
                               
                      
                              </td>
                            </tr>

                    <?php } while ($teasrow = $titems->fetch_assoc());
                        } while ($measrow = $mitems->fetch_assoc());
                        $j++;
                      } while ($stratrow = $sitems->fetch_assoc());
                      $i++;
                    } while ($row = $items->fetch_assoc());
                    ?>
                </table><br>
                <br>
                <center>
                  <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                  <button class="btn btn-primary" name="save_button">
                    <i class="fa fa-save"></i> Submit ratings
                  </button>
                </center>

              <?php         # code...
            } else { ?>
              </form>
                    <h4>  <p>
                      
                    <?php 
                    if ( $krow['fans_appr'] >= 2) {
                   ?>
                    Approved by: <b><?php echo "ADMIN ".$arow['fname']." ".$arow['lname'] ?></b> <br>
                    Your Final Rating: <b><?php echo $arow['fans_frate']."/5 - ".$rating?></b>  
                    </p></h4>
                    <?php } else {
                      ?>
                      <b> Your IPCRF Submission is still up for review by Administrators</b> 
                    <?php }?>
                    
              <table id="example1" class="table table-bordered table-striped" style="font-size:16px;">
                <?php
                $i = 1;
                do {
                  
                ?>

                  <h4>

                    <tr style="font-size:large; text-align:center;">
                      <th colspan="2"> MFO <?php echo "#" . $i . ": " . $row['cat_name'] ?> </th>
                    </tr>
                    <?php

                    $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'] . " ORDER BY sp_id ASC";
                    $sitems = $dbcon->query($sql) or die($con->error);
                    $stratrow = $sitems->fetch_assoc();

                    $j = 1;
                    do {
                      $stratWt =0;
                      ?>


                      <tr>
                        <td>
                          <pre>Strategic Priority <?php echo $i . "." . $j . " " . $stratrow['sp_desc'] ?></pre>
                        </td>
                      </tr>

                      <?php

                      $sql = "SELECT ipcrf_measures.*, ipcrf_stratprio.* FROM (ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) WHERE meas_sp =" . $stratrow['sp_id'];
                      $mitems = $dbcon->query($sql) or die($con->error);
                      $measrow = $mitems->fetch_assoc();

                      $sql = "SELECT * FROM ipcrf_ansm WHERE mans_meas =" . $measrow['meas_id'] . " AND mans_fid =" . $_SESSION['user_id'];
                      $amitems = $dbcon->query($sql) or die($con->error);
                      $ameasrow = $amitems->fetch_assoc();


                      do { ?>
                        <tr style="font-size:medium; color:#FF2E1B;">
                          <td colspan="2"> <b><?php echo $measrow['meas_desc'];
                                              echo " (" . $measrow['meas_wt'] * 100 . "%)" ?><br>
                              <textarea class="form-control" name="ac-<?php echo $measrow['meas_id']; ?>" placeholder="Please type your Actual Accomplishment in this Measure" readonly>
                              <?php if ($measrow['access'] == 0) {
                                echo  $ameasrow['mans_accomp'] ;
                                } else {
                                  echo  'This is to be answered by an Admin.';
                                }?>
                              </textarea>
                              <textarea class="form-control" name="re-<?php echo $measrow['meas_id']; ?>" placeholder="Please type your Remarks in this Measure" readonly>
                              <?php if ($measrow['access'] == 0) {
                                echo  $ameasrow['mans_accomp'] ;
                                } else {
                                  echo  'This is to be answered by an Admin.';
                                }?>
                            </textarea>
                            </b></td>
                        </tr>

                        <?php


                        $sql = "SELECT ipcrf_target.*, ipcrf_stratprio.access FROM ((ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) INNER JOIN ipcrf_target ON ipcrf_target.t_meas = ipcrf_measures.meas_id ) WHERE t_meas =" . $measrow['meas_id'];
                        $titems = $dbcon->query($sql) or die($con->error);
                        $teasrow = $titems->fetch_assoc();

                       
                        do {
                          $sql = "SELECT * FROM ipcrf_anst WHERE ans_target =" . $teasrow['t_id'] . " AND ans_fid =" . $_SESSION['user_id'];
                          $atitems = $dbcon->query($sql) or die($con->error);
                          $ateasrow = $atitems->fetch_assoc();
  
                          $targval = 0;
                          $targCount = 0;
                        ?>

                          <tr>
                            <td style="width: 50%;"> <?php echo $teasrow['t_type'];
                                                      echo " - ";
                                                      echo $teasrow['t_desc']; ?> <br>

                            </td>
                            <td> <?php echo $teasrow['t_type'];
                                  echo " - ";
                                  $targval += $ateasrow['ans_val'];

                                  if ($measrow['access'] == 0) {
                                    echo  $ateasrow['ans_val'];
                                    } else {
                                      echo  'To be graded by admin';
                                    }
                                    ?> <br>

                            </td>
                          </tr>

                        <?php
                          $targCount++;
                        } while ($teasrow = $titems->fetch_assoc());
                        ?>
                        <tr>
                          <td><b>Average for this measure: <?php echo ($targval / $targCount) . "/5" ?> </b> </td>
                          <td><b>Weighted Average  <?php echo "(".$measrow['meas_wt']."):".(($targval / $targCount) * $measrow['meas_wt']). "/5" ?> </b> </td>
                        </tr>
                <?php
                      $stratWt += ($targval / $targCount) * $measrow['meas_wt'];
                  
                    } while ($measrow = $mitems->fetch_assoc());
                      $j++;
                      ?>
                      <tr>
                      <td><b>Weighted Average for this Strategic Priority: <?php echo $stratWt. "/5" ?> </b> </td>

                    </tr>
                      <?php 

                    $alWt += $stratWt;

                    } while ($stratrow = $sitems->fetch_assoc());
                    $i++;
                  } while ($row = $items->fetch_assoc());
                  ?>
                   <tr>
                    <td style="background-color: #F5AC02 ; color:#211700; font-size:large;" colspan="2">
                    
                   
                  <?php
                  
                 
                  

                    if ( $krow['fans_appr'] >= 2) {
                   ?>
                    <b>Final Weighted Average : <?php echo $alWt. "/5 - ".$rating ?> </b> 
                  <p style="font-size:medium;">
                    Thank you for your patience, your ICPRF Submission has now been reviwed and approved.
                    <?php } else {
                      ?>
                       <b>Initial Weighted Average : <?php 
                       
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
    break;}
                       
                       echo $alWt. "/5 - ".$rating?> </b> 
                  <p style="font-size:medium;">
                      <b>Note: Your IPCRF Submission is subjected to further review by the admin. <br>
                  You will be informed if your submission was approved</b> 
                    <?php }?>
             
                  </p>
                  </td>

                  </tr>
                  <?php
                } 
                ?>
                   
                    <?php 
                ?>
              
              </table><br>
              <br>
          </div>
        </div>
      </section>



      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../assets/admin_footer.php'; ?>
</body>

</html>