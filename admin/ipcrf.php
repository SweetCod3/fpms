<?php
include '../config/db.php';
include '../config/functions.php';
include '../config/main_function.php';
if (empty($_SESSION['login_admin'])) { //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
/* if (isset($_POST['deactivate'])) {
  $sql = "UPDATE user_account SET ipcrf = 99";
  $dbcon->query($sql) or die($dbcon->error);
  $_SESSION['ipcrf'] = 99;
  $sql = "DELETE FROM ipcrf_ansm";
  $dbcon->query($sql) or die($dbcon->error);
  $sql = "DELETE FROM ipcrf_ansf";
  $dbcon->query($sql) or die($dbcon->error);
  $sql = "DELETE FROM ipcrf_anst";
  $dbcon->query($sql) or die($dbcon->error);
  header("location: ipcrf.php");
};*/ 
$query = "SELECT ipcrf_stratprio.*, ipcrf_category.cat_name FROM (ipcrf_stratprio INNER JOIN ipcrf_category ON ipcrf_stratprio.sp_cat = ipcrf_category.cat_id) ORDER BY sp_id ASC";
$question = getdata_inner_join($query);
$cat = getdata("*", "ipcrf_category");

$sql = "SELECT * FROM ipcrf_category ORDER BY cat_id ASC";
$items = $dbcon->query($sql) or die($con->error);
$row = $items->fetch_assoc();

//activate or deactivate ipcrf:
if (isset($_POST['activate'])) {
  $sql = "UPDATE user_account SET ipcrf = 0";
  $_SESSION['ipcrf'] = 0;
  echo $sql;
  $dbcon->query($sql) or die($dbcon->error);
  header("location: ipcrf.php");
};
// to create new version of ipcrf delete this code then copy the code above
if (isset($_POST['deactivate'])) {
  $sql = "UPDATE user_account SET ipcrf = 99";
  echo $sql;
  $_SESSION['ipcrf'] = 99;
  $dbcon->query($sql) or die($dbcon->error);
  header("location: ipcrf.php");
};
//delete hanggang dito=========>>

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
            <h3 class="box-title"><i class="fa fa-book"></i> IPCRF Structure - 
            <hr>
<div style="text-align: center;">

<?php if ($_SESSION['ipcrf'] != 99) {?>
  <form method="post">
<button class="btn btn-danger" name="deactivate"> Deactivate IPCRF </button>
<p style="font-size:15px;">Block professors from accessing ICPRF, and be able to edit the IPCRF while inactive.</p> 
</form>
<?php } else { ?>
  
  <form method="post">
  
  <button class="btn btn-info" name="activate"> Assign IPCRF </button> <br> <br>
  <p style="font-size:15px;">Assign this to all professors, and lock the IPCRF from being edited while Active.</p> 
  </form>

 
  <?php }?>
  </div>
            
            <table id="example1" class="table table-bordered table-striped" style="font-size:16px;">
            <?php
        $i = 1;
          do {
          ?>
           
            <h4>
             
  <tr style="font-size:large; text-align:center;">
    <th> MFO <?php echo "#".$i.": ".$row['cat_name'] ?> </th>
  </tr>
  <?php

              $sql = "SELECT * FROM ipcrf_stratprio WHERE sp_cat =" . $row['cat_id'] . " ORDER BY sp_id ASC";
              $sitems = $dbcon->query($sql) or die($con->error);
              $stratrow = $sitems->fetch_assoc();

              $j = 1; do { ?>
 
 
  <tr >
    <td>      <pre>Strategic Priority <?php echo $i.".".$j." ".$stratrow['sp_desc']?></pre></td>
  </tr>
 
  <?php

$sql = "SELECT * FROM ipcrf_measures WHERE meas_sp =".$stratrow['sp_id'];
$mitems = $dbcon->query($sql) or die($con->error);
$measrow = $mitems->fetch_assoc();


do { ?>
  <tr style="font-size:medium; color:#FF2E1B;">
    <td> <b><?php echo $measrow['meas_desc']; echo " (".$measrow['meas_wt'] * 100 ."%)" ?><br>
    <textarea class="form-control" name="accomp" placeholder="Please type your Actual Accomplishment in this Measure"></textarea>
    <textarea class="form-control" name="accomp" placeholder="Please type your Remarks in this Measure"></textarea>
    </b></td>
  </tr>

  <?php

$sql = "SELECT * FROM ipcrf_target WHERE t_meas =" . $measrow['meas_id'] ;
$titems = $dbcon->query($sql) or die($con->error);
$teasrow = $titems->fetch_assoc();

do { ?>

  <tr >
    <td> <?php echo $teasrow['t_type']; echo " - "; echo $teasrow['t_desc']; ?> <br>
    ⬅ 1
  <input type="radio" name="scr-<?php echo $teasrow['t_id']; ?>" id="1" value="<?php echo $teasrow['t_id']; ?> 1">
  <input type="radio" name="eval-scr" id="1" value="<?php echo $teasrow['t_id']; ?> 2">
  <input type="radio" name="eval-scr" id="1" value="<?php echo $teasrow['t_id']; ?> 3">
  <input type="radio" name="eval-scr" id="1" value="<?php echo $teasrow['t_id']; ?> 4">
  <input type="radio" name="eval-scr" id="1" value="<?php echo $teasrow['t_id']; ?> 5">
  5 ➡

  </td>
  </tr>

  <?php } while ($teasrow = $titems->fetch_assoc());  
   } while ($measrow = $mitems->fetch_assoc());  
$j++;} while ($stratrow = $sitems->fetch_assoc());     
                $i++;} while ($row = $items->fetch_assoc());
                  ?>
           </table><br>
           <table>

           
           </table>
           
           <br><br>
        </div>
      </section>



      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../assets/admin_footer.php'; ?>
</body>

</html>