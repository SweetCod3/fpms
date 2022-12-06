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

$sql= "SELECT COUNT(ann_id) AS announcements  FROM `announcement`";
$ztems = $dbcon->query($sql) or die($con->error);
$sz = $ztems->fetch_assoc();
  
  if(isset($_POST['login_button'])){
    $user_name = filter($_POST['user_name']);
    $pass = hash("sha256",$_POST['pass']);

    $loginAccount = login($user_name,$pass);
    if(!empty($loginAccount)){
    foreach ($loginAccount as $key => $value) {
      if($value->user_role == '0'){
          $_SESSION['user_id'] = $value->user_id;
          $_SESSION['user_name'] = $value->user_name; 
          $_SESSION['fname'] = $value->fname;
          $_SESSION['mname'] = $value->mname;
          $_SESSION['lname'] = $value->lname;
          $_SESSION['user_role'] = $value->user_role;
          $_SESSION['ipcrf'] = $value->ipcrf;
          $_SESSION['login_admin'] = 'login_admin';

          $data = array("log_desc"  => "".$value->fname." ".$value->mname." ".$value->lname." has login to the system");
          insertdata("logs",$data);
          header("location: admin/");
      }
      elseif($value->user_role == '1'){
          $_SESSION['user_id'] = $value->user_id;
          $_SESSION['user_name'] = $value->user_name; 
          $_SESSION['fname'] = $value->fname;
          $_SESSION['mname'] = $value->mname;
          $_SESSION['lname'] = $value->lname;
          $_SESSION['user_role'] = $value->user_role;
          $_SESSION['ipcrf'] = $value->ipcrf;
          $_SESSION['login_prof'] = 'login_prof';
          $data = array("log_desc"  => "".$value->fname." ".$value->mname." ".$value->lname." has login to the system");
          insertdata("logs",$data);
          header("location: professor/");
      }
      elseif($value->user_role == '2'){
          $_SESSION['user_id'] = $value->user_id;
          $_SESSION['user_name'] = $value->user_name; 
          $_SESSION['fname'] = $value->fname;
          $_SESSION['mname'] = $value->mname;
          $_SESSION['lname'] = $value->lname;
          $_SESSION['user_role'] = $value->user_role;
          $_SESSION['login_user'] = 'login_user';
          $_SESSION['section_name']  = $value->section_name;
          $data = array("log_desc"  => "".$value->fname." ".$value->mname." ".$value->lname." has login to the system");
          insertdata("logs",$data);
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

          $data = array("log_desc"  => "".$value->fname." ".$value->mname." ".$value->lname." has login to the system");
          insertdata("logs",$data);

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
  <body style="background-image: url(images/bg.jpg); background-repeat: no-repeat; background-size: 100%; background-position: center;">
   <br><br>
   
    <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-4" style="background:#f9f9f9;padding:20px;border:1px solid #dee2e6; border-radius:3px; ">
    <?php  if ($sz['announcements'] >   0) {
     
$sql= "SELECT * FROM `announcement` ORDER BY ann_date";
$ltems = $dbcon->query($sql) or die($con->error);
$lz = $ltems->fetch_assoc();
     ?>
    <center>  <h5> Announcement</h5>
    </center> 


    <p><?php do {
      echo $lz['ann_desc'].'<br>'; 
    } while ($lz = $ltems->fetch_assoc());?> </p>
      <?php
    }  else {
      ?> 
          <center>  <h5>No Announcements at the moment</h5>
    <p> </p>
    </center>   
    <?php 
    } ?>
    <br>
   
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-4" style="background:#f9f9f9;padding:20px;border:1px solid #dee2e6; border-radius:3px; ">
    <div class="container" style="width:100%; margin:0 auto;">
      <center><img src="images/logo.png" width="180"></center>
    </div>
    <br>
    
    <h4> <center>Login </center> </h4>
    <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg;?></div><?php endif;?>
        
      <form method="post">
        <div class="form-group">
          <input type="text" name="user_name" class="form-control" placeholder="Enter ID Number" required>
        </div>
        
        <div class="form-group">
          <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1"></label>
          <center><input type="submit" name="login_button" class="btn btn-success" value="Login"> </center>
        </div>
        
        <div class="form-group">
          <label for="exampleFormControlInput1"></label>
          <center><p>Don't have an account yet?</p> 
        <p>Register as a <a href="studReg.php">Student</a> or a <a href="facReg.php">Faculty Member. </a> </p>
        </center>
        </div>
      
         
      </form>
    </div>
    <div class="col-lg-1"></div>
</div>
</body>
</html>