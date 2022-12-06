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
    $section_name = filter($_POST['section_name']);
    

    if(isset($_GET['section_id'])){
      $arr_where = array("section_id"=>filter($_GET['section_id']));//update where
      $arr_set = array("section_name"  =>$section_name);//set update
      $tbl_name = "course_list";
      $update = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
      header("location: course.php");
    }else{
      $insertArray = array(
      "section_name"  => $section_name,
      "created_by"    => $_SESSION['fname']." ".$_SESSION['lname']);
      insertdata("course_list",$insertArray);
      header("location: course.php");
    }
    
  break;  
}
if(isset($_GET['section_id'])):
    $course = getdata_where("*","section_id","course_list",filter($_GET['section_id']));
    if(!empty($course)){
       foreach ($course as $key => $value) {
        $section_name = $value->section_name;
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Course Information </h3>
              <hr>
        <form method="post">
            <div class="row">
              
              <div class="col-md-12">
                <input type="text" class="form-control" name="section_name" placeholder="Course Name" required value="<?php if(isset($_GET['section_id'])): echo $section_name; elseif(isset($_POST['save_button'])): echo $_POST['section_name']; endif;?>">
              </div>
              <div class="col-md-12">
                <br>
                
                <a href="course.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                <button class="btn btn-primary" name="save_button">
                  <i class="fa fa-save"></i> Save
                </button>
              </div>
            </div>
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
