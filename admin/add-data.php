<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
switch (true) {
  case isset($_POST['save_button']):
    $e_code = filter($_POST['e_code']);
    $sub_incharge = filter($_POST['sub_incharge']);
    

    $kweri = $dbcon->query("SELECT * FROM evaluation_sheet WHERE sub_incharge='$sub_incharge'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

    if($checkName > 0){
      $msg = 'Subject List already exist.';
    
    }else{
      if(isset($_GET['eval_id'])){
        $arr_where = array("eval_id"  => $_GET['eval_id']);//update where
        $arr_set   = array(
        "e_code"         => $e_code,
        "sub_incharge"   => $sub_incharge
        );//set update
        $tbl_name  = "evaluation_sheet";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: index.php");
      }else{
        $data = array(
        "e_code"        => $e_code,
        "sub_incharge"  => $sub_incharge,
        "e_status"      =>"1",
        "date_started"  =>date("Y-m-d")
      );
      insertdata("evaluation_sheet",$data);
      header("location: index.php");
      }
      
    }
  break;  
}
if(isset($_GET['eval_id'])):
    $info = getdata_where("*","eval_id","evaluation_sheet",filter($_GET['eval_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
         $e_code = $value->e_code;
         $sub_incharge  = $value->sub_incharge;
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Evaluation Sheet </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
           <div class="row">
            <div class="col-md-2">Evaluation Code</div>
            <div class="col-md-9">
              <input type="text" name="e_code" class="form-control" value="HR-<?php echo rand()?>" readonly> 
            </div>
           </div>
           <p></p>
           <div class="row">
            <div class="col-md-2">Subject List:</div>
            <div class="col-md-9">
              <select class="form-control" name="sub_incharge">
                <?php 
                $query = "SELECT * FROM subject_schedule INNER JOIN user_account on user_account.user_id = subject_schedule.user_id";
                $list = getdata_inner_join($query);
                ?>
                <?php if(!empty($list)):?>
                  <?php foreach ($list as $key => $value):?>
                    <option value="<?php echo $value->sched_id?>"><?php echo $value->sub_code?> <?php echo $value->sub_name?> - <?php echo $value->sub_from?> - <?php echo $value->sub_until?> / Professor Name: <?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?> </option>
                  <?php endforeach;?>
                <?php else:?>
                  <option>No Records</option>
                <?php endif;?>
              </select>
            </div>
           </div>
           <br>
             <center>
               <a href="index.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
