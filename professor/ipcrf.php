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

$sql = "SELECT * FROM ipcrf_measures ORDER BY meas_id ASC";
$measure = $dbcon->query($sql) or die($con->error);
$mcount = mysqli_num_rows($measure);
$mrow = $measure->fetch_assoc();


$sql = "SELECT * FROM ipcrf_target ORDER BY t_id ASC";
$target = $dbcon->query($sql) or die($con->error);
$trow = $target ->fetch_assoc();

if (isset($_GET['delete'])) { // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("sp_id" => $delete); //WHERE statement
  $tbl_name = "ipcrf_stratprio";
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
            <h3 class="box-title"><i class="fa fa-book"></i> IPCRF Structure - <a href="add-strat.php" class="btn btn-info">Assign ICPRF</a></h3>
            <hr>

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

                  $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'] . " ORDER BY sp_id ASC";
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

                    $sql = "SELECT * FROM ipcrf_measures WHERE meas_sp =" . $stratrow['sp_id'];
                    $mitems = $dbcon->query($sql) or die($con->error);
                    $measrow = $mitems->fetch_assoc();


                    do { ?>
                      <tr style="font-size:medium; color:#FF2E1B;">
                        <td> <b><?php echo $measrow['meas_desc'];
                                echo " (" . $measrow['meas_wt'] * 100 . "%)" ?><br>
                            <textarea class="form-control" name="ac-<?php echo $measrow['meas_id']; ?>"  placeholder="Please type your Actual Accomplishment in this Measure"> <?php echo "ac-".$measrow['meas_id']; ?></textarea>
                            <textarea class="form-control" name="re-<?php echo $measrow['meas_id']; ?>" placeholder="Please type your Remarks in this Measure"></textarea>
                          </b></td>
                      </tr>

                      <?php

                      $sql = "SELECT * FROM ipcrf_target WHERE t_meas =" . $measrow['meas_id'];
                      $titems = $dbcon->query($sql) or die($con->error);
                      $teasrow = $titems->fetch_assoc();

                      do { ?>

                        <tr>
                          <td> <?php echo $teasrow['t_type'];
                                echo " - ";
                                echo $teasrow['t_desc']; ?> <br>
                            ⬅ 1
                            <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="1" value="<?php echo $teasrow['t_id']; ?> 1">
                            <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="2" value="<?php echo $teasrow['t_id']; ?> 2">
                            <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="3" value="<?php echo $teasrow['t_id']; ?> 3">
                            <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="4" value="<?php echo $teasrow['t_id']; ?> 4">
                            <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="5" value="<?php echo $teasrow['t_id']; ?> 5">
                            5 ➡

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
            <table>


            </table>

            <br><br>
            <a href="add-strat.php" class="btn btn-info"><b> Submit your ratings</b></a>
            </form>
          </div>
      </section>



      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../assets/admin_footer.php'; ?>
</body>

</html>