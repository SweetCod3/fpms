<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$cats = getdata("*","ipcrf_target");


switch (true) {
  case isset($_POST['save_button']):
    $map_targ = filter($_POST['map_targ']);
   
   
   
  
    
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
     
        for ($i=1; $i <= 5; $i++) { 
          $vaD = $_POST['val'.$i];
          $data = array(
            "map_targ"     => $map_targ,
            "map_val"      => $i,
            "map_desc"     => $vaD
          );
         echo insertdata("ipcrf_valmap",$data);
        }
     
        header("location: ipcrf-valGuide.php");
      
        
      }
      
  break;  
}
if(isset($_GET['map_id'])):
    $info = getdata_where("*","t_id","ipcrf_valmap",filter($_GET['t_id']));
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
            
            <p></p>

            <div class="row">
                <div class="col-md-2">Point Equivalent</div>
                <div class="col-md-8">
              <label for="1">1 - </label> <input style="width: 80%;" type="text" name="val1" id="1"><br>
               
  
              <label for="2">2 - </label> <input style="width: 80%;" type="text" name="val2" id="2"><br>
              <label for="3">3 - </label> <input style="width: 80%;" type="text" name="val3" id="3"> <br>
              <label for="4">4 - </label> <input style="width: 80%;"  type="text" name="val4" id="4">  <br>
              <label for="5">5 - </label> <input style="width: 80%;" type="text" name="val5" id="5"><br>
              
          
                </div>
            </div>
             <p></p>
             <div class="row">
                <div class="col-md-2">Target</div>
                <div class="col-md-8">

                    <select class="form-control" name="map_targ">
                      <option value=""></option>
                    <?php foreach ($cats as $key => $value):
       echo '<option'; echo'>'; echo $value->t_id; echo '-'; echo $value->t_desc; echo '</option>' ?>
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
