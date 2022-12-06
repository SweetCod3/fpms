<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$cats = getdata("*","ipcrf_measures");


switch (true) {
  case isset($_POST['save_button']):
    $t_desc = filter($_POST['t_desc']);
    $t_meas = filter($_POST['t_meas']);
    $t_type = filter($_POST['t_type']);
   
    ;
    /*
    $avg_rate = filter($_POST['avg_rate']);
    $rate_dean = filter($_POST['rate_dean']);
    */

    $kweri = $dbcon->query("SELECT * FROM ipcrf_target WHERE t_desc='$t_desc'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

      if(isset($_GET['t_id'])){
        $arr_where = array("t_id"  => $_GET['t_id']);//update where
        $arr_set   = array(
        "t_desc"     => $t_desc,
        "t_type"      => $t_type,
        "t_meas"     => $t_meas
        
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/
       
        );//set update
        $tbl_name  = "ipcrf_target";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: ipcrf-targets.php");
      }else{
      if($checkName > 0){
        $msg = 'Strategic Priority: '.$t_desc.' already exist.';
      }else{
        $data = array(
          "t_desc"     => $t_desc,
          "t_type"      => $t_type,
          "t_meas"     => $t_meas
           
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean
        */,
       
        );
        insertdata("ipcrf_target",$data);
        header("location: ipcrf-targets.php");
      }
        
      }
      
  break;  
}
if(isset($_GET['t_id'])):
    $info = getdata_where("*","t_id","ipcrf_target",filter($_GET['t_id']));
    $sql = "SELECT * FROM ipcrf_target WHERE t_id =".$_GET['t_id'];
    $items = $dbcon->query($sql) or die($con->error);
    $row = $items->fetch_assoc();

    if(!empty($info)){
       foreach ($info as $key => $value) {
         $t_desc = $value->t_desc;
         $t_type  = $value->t_type;
         $t_meas  = $value->t_meas;
          
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Target</h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
                <div class="col-md-2">Target</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="t_desc" placeholder="Please type the Measures"><?php if(isset($_GET['t_id'])): echo $t_desc; elseif(isset($_POST['save_button'])): echo $_POST['t_desc']; endif;?></textarea>
                </div>
            </div>
            <p></p>

            <div class="row">
                <div class="col-md-2">Type</div>
                <div class="col-md-8">
                <select class="form-control" name="t_type">
                  <option <?php if(isset($_GET['t_id'])): if($row['t_type'] == "Quality"): echo "selected"; endif;endif;?> value="Quality">Quality</option>
                  <option <?php if(isset($_GET['t_id'])): if($row['t_type'] == "Efficiency"): echo "selected"; endif;endif;?> value="Efficiency">Efficiency</option>
                  <option <?php if(isset($_GET['t_id'])): if($row['t_type'] == "Timeliness"): echo "selected"; endif;endif;?> value="Timeliness">Timeliness</option>
                </select>
          
                </div>
            </div>
             <p></p>
             <div class="row">
                <div class="col-md-2">Measures</div>
                <div class="col-md-8">

                    <select class="form-control" name="t_meas">
                    <?php foreach ($cats as $key => $value):
       echo '<option'; echo'>'; echo $value->meas_id; echo '-'; echo $value->meas_desc; echo '</option>' ?>
      <?php endforeach;?> 
                    </select>
                </div>
            </div>
            <p></p>

         
            <p></p>
            
            
            <br>
             <center>
            <a href="ipcrf-targets.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
