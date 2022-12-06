<?php
  include 'config/db.php';
  include 'config/functions.php';
  include 'config/main_function.php';
 
 
  if(isset($_POST['login_button'])){
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $gMail = $_POST['gMail'];
    $intialPass = $_POST['pW'];
    $fpass = $_POST['cW'];

    $namePattern = "/^[a-zA-Z-' ]*$/";
    $numPattern = "/^[0-9]*$/";
   
    $uppercase = preg_match('@[A-Z]@', $intialPass);
    $lowercase = preg_match('@[a-z]@', $intialPass);
    $number    = preg_match('@[0-9]@', $intialPass);
    $specialChars = preg_match('@[^\w]@', $intialPass);

    switch (true) {
      case !preg_match($namePattern, $_POST['fName']) || !preg_match($namePattern, $_POST['lName']) :
        $msg = "Only text and whitespaces allowed in name fields";
          break;
      case !filter_var($_POST['gMail'], FILTER_VALIDATE_EMAIL):
        $msg = "Invalid email, please a valid one.";
        break;

      case $_POST['pW'] != $_POST['cW']:
        $msg = "Passwords do not match.";
      break;

      case !$uppercase :
      case !$number :
      case !$specialChars :
      case strlen($intialPass) < 8:
        $msg = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      break;
        default:
        $pass = hash("sha256",$_POST['cW']);
        $hashname = hash("sha256",$_POST['fName']);
        $yearCode = date("Y");
        $cutHash = substr($hashname, 0,5);
        $uName = $yearCode.$cutHash;

        $sql = 
        "INSERT INTO user_account (`user_name`,`pass`,`user_role`,`fname`, `lname`, `user_email`) 
        VALUES ('$uName','$pass','11','$fname','$lname','$gMail')";
        $dbcon->query($sql) or die ($dbcon ->error);
        $gdmsg = "Welcome! You have successfully created an account! Please kindly wait for the admin's approval of the account.";
        break;
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


  <body style="background:#d8b242;">
    <div class="container" style="width:100%; margin:0 auto;margin-top:5%;">
      <center><img src="images/logo.png" width="180"></center>
    </div>
    <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="background:#f9f9f9;padding:20px;margin-top:2%;border:1px solid #dee2e6; border-radius:3px; ">
      <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg;?></div><?php endif;?>
      <?php if(isset($gdmsg)):?><div class="alert alert-success"><?php echo $gdmsg;?></div><?php endif;?>
      <center> <p>Welcome to Faculty Registration</p> </center>
      
        <form method="post">
        <div class="form-group">
        <div class="form-group">
          <input type="text" name="gMail" class="form-control" placeholder="Gmail Account Address" required>
        </div>
        <div class="form-group">
          <input type="password" name="pW" class="form-control" placeholder="Enter Password" required>
        </div>
        <div class="form-group">
          <input type="password" name="cW" class="form-control" placeholder="Confirm Password" required>
        </div>
        <div class="form-group">
          <input type="text" name="fName" class="form-control" placeholder="Firstname" required>
        </div>
        <div class="form-group">
          <input type="text" name="lName" class="form-control" placeholder="Lastname" required>
        </div>  
        <div class="form-group">
          <label for="exampleFormControlInput1"></label>
          <center><input type="submit" name="login_button" class="btn btn-info" value="Register"> </center>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1"></label>
          <center><p>Already have an account?</p> 
        <p>Go back to <a href="index.php">login page</a>. </a> </p>
        </center>
        </div>
      
         
      </form>
    </div>
    <div class="col-lg-4"></div>
</div>
</body>
</html>