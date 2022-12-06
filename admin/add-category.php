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
    $cat_name = filter($_POST['cat_name']);
    /*
    $avg_rate = filter($_POST['avg_rate']);
    $rate_dean = filter($_POST['rate_dean']);
    */

    $kweri = $dbcon->query("SELECT * FROM ipcrf_category WHERE cat_name='$cat_name'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

      if(isset($_GET['cat_id'])){
        $arr_where = array("cat_id"  => $_GET['cat_id']);//update where
        $arr_set   = array(
        "cat_name"      => $cat_name
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/
        ,
        );//set update
        $tbl_name  = "ipcrf_category";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: ipcrf-cats.php");
      }else{
      if($checkName > 0){
        $msg = 'Category: '.$cat_name.' already exist.';
    
      }else{
        $data = array(
        "cat_name"      => $cat_name
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean
        */,
        );
        insertdata("ipcrf_category",$data);
        header("location: ipcrf-cats.php");
      }
        
      }
      
  break;  
}
if(isset($_GET['cat_id'])):
    $info = getdata_where("*","cat_id","ipcrf_category",filter($_GET['cat_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
         $cat_name  = $value->cat_name;
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Category </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
                <div class="col-md-2">Category</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="cat_name" placeholder="Write Category Name"><?php if(isset($_GET['q_id'])): echo $question_name; elseif(isset($_POST['save_button'])): echo $_POST['question_name']; endif;?>
                    </textarea>
                </div>
            </div>
             <p></p>
     
            <p></p>
            <!--
             <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="avg_rate" class="form-control" value="<?php if(isset($_GET['q_id'])): echo $avg_rate; elseif(isset($_POST['save_button'])): echo $_POST['avg_rate']; endif;?>">
                </div>
            </div>
                        <p></p>
            <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="rate_dean" class="form-control" value="<?php if(isset($_GET['q_id'])): echo $rate_dean; elseif(isset($_POST['save_button'])): echo $_POST['rate_dean']; endif;?>">
                </div>
            </div>
          -->
            <br>
             <center>
            <a href="questions.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
