<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$cats = getdata("*","ipcrf_stratprio");

switch (true) {
  case isset($_POST['save_button']):
    $meas_desc = filter($_POST['meas_desc']);
    $pmeas_wt = filter($_POST['meas_wt']);
    $meas_wt = doubleval($pmeas_wt / 100);
    $pmeas_sp = filter($_POST['meas_sp']);
    $meas_sp = (int)filter_var($pmeas_sp, FILTER_SANITIZE_NUMBER_INT); 
   
    ;
    /*
    $avg_rate = filter($_POST['avg_rate']);
    $rate_dean = filter($_POST['rate_dean']);
    */

    $kweri = $dbcon->query("SELECT * FROM ipcrf_measures WHERE meas_desc='$meas_desc'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

      if(isset($_GET['meas_id'])){
        $arr_where = array("meas_id"  => $_GET['meas_id']);//update where
        $arr_set   = array(
        "meas_desc"     => $meas_desc,
        "meas_sp"      => $meas_sp,
        "meas_wt"     => $meas_wt
        
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/
       
        );//set update
        $tbl_name  = "ipcrf_measures";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: ipcrf-measures.php");
      }else{
      if($checkName > 0){
        $msg = 'Measure: '.$meas_desc.' already exist.';
      }else{
        $data = array(
          "meas_desc"     => $meas_desc,
          "meas_sp"      => $meas_sp,
          "meas_wt"     => $meas_wt
           
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean
        */,
       
        );
        insertdata("ipcrf_measures",$data);
        header("location: ipcrf-measures.php");
      }
        
      }
      
  break;  
}
if(isset($_GET['meas_id'])):
    $info = getdata_where("*","meas_id","ipcrf_measures",filter($_GET['meas_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
         $meas_desc = $value->meas_desc;
         $meas_sp  = $value->meas_sp;
         $meas_wt  = $value->meas_wt;

         /*
         $avg_rate      = $value->avg_rate;
         $rate_dean     = $value->rate_dean;
         */
      }
    }else{
      header("location: error.php");
    }
endif;
?>
<?php include'../assets/admin_header.php';?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include'../assets/admin_nav.php';?>
<?php include'../assets/admin_sidebar.php';?>

  <div class="content-wrapper">
        <!-- Main content -->
    <section style="padding:11px;">

      <div class="box box-solid" style="padding:15px;">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Measures </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
                <div class="col-md-2">Measures</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="meas_desc" placeholder="Please type the Measures"><?php if(isset($_GET['meas_id'])): echo $meas_desc; elseif(isset($_POST['save_button'])): echo $_POST['meas_desc']; endif;?></textarea>
                </div>
            </div>
            <p></p>

            <div class="row">
                <div class="col-md-2">Weight</div>
                <div class="col-md-8">
                    <input class="form-control" name="meas_wt" min="1" max="100" placeholder="Enter Weight in 1-100% eg. 25 will be = 25%" type="number" value="<?php if(isset($_GET['meas_id'])): echo $meas_wt * 100; elseif(isset($_POST['save_button'])): echo $_POST['meas_wt']; endif;?>" >  
                </div>
            </div>
             <p></p>
             <div class="row">
                <div class="col-md-2">Strategic Priority:</div>
                <div class="col-md-8">

                    <select class="form-control" name="meas_sp">
                    <?php foreach ($cats as $key => $value):
       echo '<option'; echo'>'; echo $value->sp_id; echo '-'; echo $value->sp_desc; echo '</option>' ?>
      <?php endforeach;?> 
                    </select>
                </div>
            </div>
            <p></p>

         
            <p></p>
            
            
            <br>
             <center>
            <a href="ipcrf-measures.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
             <button class="btn btn-primary" name="save_button">
                  <i class="fa fa-save"></i> Save
                </button>
                
             </center>
            </form>
            </div>
      </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
