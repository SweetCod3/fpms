<?php
  include 'config/db.php';
  include 'config/functions.php';
  include 'config/main_function.php';
 
  if(isset($_SESSION['login_admin']) == 'login_admin')
  {
    header("location: admin/");
  }

  if(isset($_SESSION['login_professor']) == 'login_professor')
  {
    header("location: professor/");
  }

  if(isset($_SESSION['login_student']) == 'login_student')
  {
    header("location: user/");
  }

  if(isset($_POST['login_button'])){
    $user_name = filter($_POST['user_name']);
    $pass = hash("sha256",$_POST['pass']);

    $loginAccount = login($user_name,$pass);
    if(!empty($loginAccount)){
    foreach ($loginAccount as $key => $value) {
      if($value->user_role == '2'){
          $_SESSION['user_id'] = $value->user_id;
          $_SESSION['user_name'] = $value->user_name; 
          $_SESSION['fname'] = $value->fname;
          $_SESSION['mname'] = $value->mname;
          $_SESSION['lname'] = $value->lname;
          $_SESSION['user_role'] = $value->user_role;
          $_SESSION['login_user'] = 'login_user';
          $_SESSION['section_name']  = $value->section_name;

          header("location: user/");
      }
      elseif($value->user_role == '3'){
          $_SESSION['user_id'] = $value->user_id;
          $_SESSION['user_name'] = $value->user_name; 
          $_SESSION['fname'] = $value->fname;
          $_SESSION['mname'] = $value->mname;
          $_SESSION['lname'] = $value->lname;
          $_SESSION['user_role'] = $value->user_role;
          $_SESSION['login_user'] = 'login_user';
          $_SESSION['section_name']  = $value->section_name;

          header("location: user/");
      }
    }
  }else{
    $msg = 'Wrong username/password or your account is not yet verified.';
  }
  }
?>
<style type="text/css">
.justify
{
  text-align: justify;
}

</style>
<?php include'assets/header.php';?>
  <body style="background:#069;">
    <div class="container" style="width:100%; margin:0 auto;margin-top:5%;">
      <center><img src="images/logo.png"></center>
    </div>
    <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="background:white;padding:20px;margin-top:2%;">
      <center><h4 class="spacing">Please login to continue</h4>
                <small class="spacing">Please enter your ID Number and Password to continue. <br> Teachers, Registrar, Students and Administrator can login to the system.</small>
      </center>
      <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg;?></div><?php endif;?>
      <form method="post">
        <div class="form-group">
          <label for="exampleFormControlInput1">ID Number:</label>
          <input type="text" name="user_name" class="form-control" placeholder="ID Number" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Password:</label>
          <input type="password" name="pass" class="form-control" placeholder="Password" required>
        </div>
         <div class="form-group">
          <label for="exampleFormControlInput1"></label>
          <input type="submit" name="login_button" class="btn btn-success" value="Login!"> 
        </div>
      
      </form>
    </div>
    <div class="col-lg-4"></div>
</div>
   
    
<?php //include'assets/footer.php';?>
</body></html>