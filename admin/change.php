<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['change_btn'])){
    $old_pass = hash("sha256",$_POST['old_pass']);
    $new_pass = filter($_POST['new_pass']);
    $confirm_pass = filter($_POST['confirm_pass']);

    $g = single_get("*","user_name","user_account",filter($_SESSION['user_name']));

   if($new_pass != $confirm_pass){
      $msg = 'Password do not matched.';
    }
    elseif($g['pass'] != $old_pass){
      $msg = 'Old password do no matched';
    }
    else{
    
      $arr_where  = array("user_name"=>$_SESSION['user_name']);//update where
      $arr_set    = array("pass"=>hash("sha256",$new_pass));//set update
      $tbl_name   = "user_account";
      $update     = update($dbcon,$tbl_name,$arr_set,$arr_where);   
      $success    = 'Password has been successfully updated.';
    }
  }
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
              <h3 class="box-title"><i class="fa fa-wrench"></i> Change Password</h3>
              <hr>
        <?php if(isset($msg)):?>
              <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $msg;?>
              <br />
            </div>
            <?php endif;?>
            <?php if(isset($success)):?>
              <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $success;?>
              <br />
            </div>
            <?php endif;?>
             <form method="post">
             <table class="table table-bordered">
                <tr>
                  <td>Old Password:</td>
                  <td><input type="password" name="old_pass" class="form-control" placeholder="Old Password" required></td>
                </tr>
                 <tr>
                  <td>New Password:</td>
                  <td><input type="password" name="new_pass" class="form-control" placeholder="New Password" required></td>
                </tr>
                 <tr>
                  <td>Confirm Password:</td>
                  <td><input type="password" name="confirm_pass" class="form-control" placeholder="Confirm Password" required></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                     <button class="btn btn-primary btn-large" name="change_btn"><i class="fa fa-save"></i> Change Password</button>
                <a href="index.php" class="btn btn-danger btn-large"><i class="fa fa-arrow-left"></i> Return</a>
                  </td>
                </tr>
              </table>
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
