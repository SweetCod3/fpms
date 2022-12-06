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
    $user_name = filter($_POST['user_name']);
    $fname = filter($_POST['fname']);
    $mname = filter($_POST['mname']);
    $lname = filter($_POST['lname']);
    $section_name = filter($_POST['section_name']);
    $user_address = filter($_POST['user_address']);
    $user_contact = filter($_POST['user_contact']);
    $user_email = filter($_POST['user_email']);
    $suffix= filter($_POST['suffix']);
    $user_brgy = filter($_POST['user_brgy']);
    $user_city = filter($_POST['user_city']);

    $kweri = $dbcon->query("SELECT * FROM user_account WHERE fname='$fname' AND mname='$mname' AND lname='$lname'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    $checkID = single_get("*","user_name","user_account",$user_name);
    if(!is_numeric($user_contact)){
      $msg = 'Please enter a valid number.';
    }elseif(!is_numeric($user_name)){
      $msg = 'ID number accepts numbers only';
    }elseif(ctype_alpha(str_replace(' ', '', $fname)) === false){
      $msg = 'First name only accept letters.';
    }elseif(ctype_alpha(str_replace(' ', '', $mname)) === false){
      $msg = 'Middle name only accept letters.';
    }elseif(ctype_alpha(str_replace(' ', '', $lname)) === false){
      $msg = 'Last name only accept letters.';
    }else{
      if(isset($_GET['user_id'])){
        $arr_where = array("user_id"  => $_GET['user_id']);//update where
        $arr_set   = array(
        "user_name"     => $user_name,
        "fname"         => $fname,
        "mname"         => $mname,
        "lname"         => $lname,
        "section_name"  => $section_name,
        "user_address"  => $user_address,
        "user_contact"  => $user_contact,
        "user_email"    => $user_email,
        "suffix"        => $suffix,
        "user_brgy"     => $user_brgy,
        "user_city"     => $user_city
        );//set update
        $tbl_name  = "user_account";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: student.php");
      }else{
        $data = array(
        "user_name"     => $user_name,
        "fname"         => $fname,
        "mname"         => $mname,
        "lname"         => $lname,
        "section_name"  => $section_name,
        "user_address"  => $user_address,
        "user_contact"  => $user_contact,
        "user_email"    => $user_email,
        "user_role"     => "2",
        "pass"          => hash('sha256', $user_name),
        "suffix"        => $suffix,
        "user_brgy"     => $user_brgy,
        "user_city"     => $user_city
      );
      insertdata("user_account",$data);
      header("location: student.php");
      }
      
    }
  break;  
}
if(isset($_GET['user_id'])):
    $info = getdata_where("*","user_id","user_account",filter($_GET['user_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
        $section_name   = $value->section_name;
         $user_name     = $value->user_name;
         $fname         = $value->fname;
         $mname         = $value->mname;
         $lname         = $value->lname;
         $section_name  = $value->section_name;
         $user_address  = $value->user_address;
         $user_contact  = $value->user_contact;
         $user_email    = $value->user_email;
         $suffix        = $value->suffix;
         $user_city     = $value->user_city;
         $user_brgy     = $value->user_brgy;
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Student Information </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
              <div class="col-md-7">
                <strong>ID Number:</strong>
                  <input type="text" class="form-control" name="user_name" placeholder="ID number" required value="<?php if(isset($_GET['user_id'])): echo $user_name; elseif(isset($_POST['save_button'])): echo $_POST['user_name']; endif;?>" <?php if(isset($_GET['user_id'])): echo 'readonly';endif;?> maxlength="8">
              </div>
              </div>
                <div class="row">
               <div class="col-md-7">
                <strong>First Name:</strong>
                  <input type="text" class="form-control" name="fname" placeholder="First Name" required value="<?php if(isset($_GET['user_id'])): echo $fname; elseif(isset($_POST['save_button'])): echo $_POST['fname']; endif;?>" <?php if(isset($_GET['user_id'])): echo '';endif;?>>
              </div>
              
             </div>
             <p></p>

             <div class="row">
             
              <div class="col-md-7">
                <strong>Middle Name</strong>
                  <input type="text" class="form-control" name="mname" placeholder="Middle Name" required value="<?php if(isset($_GET['user_id'])): echo $mname; elseif(isset($_POST['save_button'])): echo $_POST['mname']; endif;?>" <?php if(isset($_GET['user_id'])): echo '';endif;?>>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <strong>Last Name:</strong>
                <br>
                  <input type="text" style="width:50%;height:34px;" name="lname" placeholder="Last Name" required value="<?php if(isset($_GET['user_id'])): echo $lname; elseif(isset($_POST['save_button'])): echo $_POST['lname']; endif;?>" <?php if(isset($_GET['user_id'])): echo '';endif;?>> 
                  <input type="text"  style="width:49%;height:34px;" name="suffix" placeholder="Jr. Sr. 3rd" value="<?php if(isset($_GET['user_id'])): echo $suffix; elseif(isset($_POST['save_button'])): echo $_POST['suffix']; endif;?>"> 
              </div>
             
             </div>
             <p></p>
             <div class="row">
               
              <div class="col-md-7">
                <strong>Address:</strong>
                <br>
                  <input type="text" name="user_address" placeholder="Address" required value="<?php if(isset($_GET['user_id'])): echo $user_address; elseif(isset($_POST['save_button'])): echo $_POST['user_address']; endif;?>" style="width:35%;height:34px;">
                  <input type="text" style="width:32%;height:34px;" name="user_brgy" placeholder="Barangay" required value="<?php if(isset($_GET['user_id'])): echo $user_brgy; elseif(isset($_POST['save_button'])): echo $_POST['user_brgy']; endif;?>"> 

                  <input type="text"  style="width:32%;height:34px;" name="user_city" placeholder="City" value="<?php if(isset($_GET['user_id'])): echo $user_city; elseif(isset($_POST['save_button'])): echo $_POST['user_city']; endif;?>"> 
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <strong>Contact Number:</strong>
                  <input type="text" maxlength="11" class="form-control" name="user_contact" placeholder="Contact Number" required value="<?php if(isset($_GET['user_id'])): echo $user_contact; elseif(isset($_POST['save_button'])): echo $_POST['user_contact']; endif;?>">
              </div>
             </div>
            <p></p>
             <div class="row">
               
              <div class="col-md-7">
                <strong>Email Address</strong>
                  <input type="email" class="form-control" name="user_email" placeholder="Email Address" required value="<?php if(isset($_GET['user_id'])): echo $user_email; elseif(isset($_POST['save_button'])): echo $_POST['user_email']; endif;?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <strong>Section:</strong>
                  <select class="form-control" name="section_name">
                  <?php $list = getdata("*","course_list");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->section_id?>"
                      <?php if(isset($_GET['user_id'])){
                      if($section_name== $value->section_id){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['section_name'];
                      }
                ?>><?php echo $value->section_name?></option>
                <?php endforeach;?>
              </select>
              </div>
             </div>
             <p></p>
             <div class="row">
              
             </div>
             <br>
             <center>
             
                <a href="student.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
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
