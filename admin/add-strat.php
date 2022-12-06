<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$cats = getdata("*","ipcrf_category");

switch (true) {
  case isset($_POST['save_button']):
    $sp_desc = filter($_POST['sp_desc']);
    $psp_wt = filter($_POST['sp_wt']);
    $sp_wt = doubleval($psp_wt / 100);
    $psp_cat = filter($_POST['sp_cat']);
    $sp_cat = (int)$psp_cat[0];
    $access = filter($_POST['access']);
   
    ;
    /*
    $avg_rate = filter($_POST['avg_rate']);
    $rate_dean = filter($_POST['rate_dean']);
    */

    $kweri = $dbcon->query("SELECT * FROM ipcrf_stratprio WHERE sp_desc='$sp_desc'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

      if(isset($_GET['sp_id'])){
        $arr_where = array("sp_id"  => $_GET['sp_id']);//update where
        $arr_set   = array(
        "sp_desc"     => $sp_desc,
        "sp_cat"      => $sp_cat,
        "sp_wt"     => $sp_wt,
        "access"     => $access
        
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/
       
        );//set update
        $tbl_name  = "ipcrf_stratprio";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: ipcrf-strat.php");
      }else{
      if($checkName > 0){
        $msg = 'Strategic Priority: '.$sp_desc.' already exist.';
      }else{
        $data = array(
          "sp_desc"     => $sp_desc,
          "sp_cat"      => $sp_cat,
          "sp_wt"     => $sp_wt,
          "access"     => $access
           
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean
        */,
       
        );
        insertdata("ipcrf_stratprio",$data);
        header("location: ipcrf-strat.php");
      }
        
      }
      
  break;  
}
if(isset($_GET['sp_id'])):
    $info = getdata_where("*","sp_id","ipcrf_stratprio",filter($_GET['sp_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
         $sp_desc = $value->sp_desc;
         $sp_cat  = $value->sp_cat;
         $sp_wt  = $value->sp_wt;
         $access = $value->access; 

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
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Strategic Priority </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
                <div class="col-md-2">Strategic Priority</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="sp_desc" placeholder="Please type the Strategic Priority"><?php if(isset($_GET['sp_id'])): echo $sp_desc; elseif(isset($_POST['save_button'])): echo $_POST['sp_desc']; endif;?></textarea>
                </div>
            </div>
            <p></p>

            <div class="row">
                <div class="col-md-2">Weight</div>
                <div class="col-md-8">
                    <input class="form-control" name="sp_wt" min="1" max="100" placeholder="Enter Weight in 1-100% eg. 25 will be = 25%" type="number" value="<?php if(isset($_GET['sp_id'])): echo $sp_wt * 100; elseif(isset($_POST['save_button'])): echo $_POST['sp_wt']; endif;?>" >  
                </div>
            </div>
             <p></p>
             <div class="row">
                <div class="col-md-2">Category:</div>
                <div class="col-md-8">

                    <select class="form-control" name="sp_cat">
                    <?php foreach ($cats as $key => $value):
       echo '<option'; echo'>'; echo $value->cat_id; echo '-'; echo $value->cat_name; echo '</option>' ?>
      <?php endforeach;?> 
                    </select>
                </div>
            </div>
            <p></p>

            <div class="row">
                <div class="col-md-2"> </div>
                <div class="col-md-8">
                <input type="checkbox" name="access" value="1">
    <label for="vehicle1"> Admin Only</label>
             
                
                </div>
            </div>
            <p></p>
            
            <!--
             <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="avg_rate" class="form-control" value="<?php if(isset($_GET['sp_id'])): echo $avg_rate; elseif(isset($_POST['save_button'])): echo $_POST['avg_rate']; endif;?>">
                </div>
            </div>
                        <p></p>
            <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="rate_dean" class="form-control" value="<?php if(isset($_GET['sp_id'])): echo $rate_dean; elseif(isset($_POST['save_button'])): echo $_POST['rate_dean']; endif;?>">
                </div>
            </div>
          -->
            <br>
             <center>
            <a href="ipcrf-strat.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
