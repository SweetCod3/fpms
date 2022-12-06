<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['save_button'])){
  $year = filter($_POST['year']);
  $kweri = $dbcon->query("SELECT * FROM school_year WHERE year='$year'") or die(mysqli_error());
  
  if($checkName > 0){
    $msg = 'School Year: '.$year.' already exist.';
  }else{
      $insertSQL = array(
        "year"          =>$year,
        "created_by"    =>$_SESSION['user_name'],
        "semester"      =>$_POST['semester']
      );
      insertdata("school_year",$insertSQL);
      header("location: school-year.php");
  }
}
if(isset($_POST['update_button'])){
  $year = filter($_POST['year']);
    //UPDATE updated Sy
     $arr_where = array(
        "sy_id"=>filter($_GET['sy_id'])
     );//update where
     $arr_set = array(
        "year"        =>$year,
        "created_by"  =>$_SESSION['user_name'],
        "semester"    =>$_POST['semester']
     );//set update
     $tbl_name = "school_year";
     $update = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
     header("location: school-year.php");
}
if(isset($_GET['sy_id'])){
  $row = single_get("*","sy_id","school_year",$_GET['sy_id']);
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
              <h3 class="box-title"><i class="fa fa-plus"></i> School Year Information </h3>
              <hr>
<form method="post">
     <?php if(isset($msg)):?><div class="alert alert-danger"><?php  echo $msg;?></div> <?php endif;?>

<table class="table">
    <tr>
        <td>School Year:</td>
        <td>
            <input type="text" name="year" class="form-control" placeholder="School Year" value="<?php if(isset($_GET['sy_id'])): echo $row['year']; elseif(isset($_POST['save_button'])): echo $_POST['year']; endif; ?>">
        </td>  
    </tr>
    <tr>
      <td>Semester:</td>
      <td>
        <select class="form-control" name="semester">
          <option value="1st Semester"  <?php if(isset($_GET['sy_id'])){
                      if($row['semester']== "1st Semester"){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['semester'];
                      }
                ?>>1st Semester</option>
          <option value="2nd Semester"  <?php if(isset($_GET['sy_id'])){
                      if($row['semester']== "2nd Semester"){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['semester'];
                      }
                ?>>2nd Semester</option>
          <option value="3rd Semester"  <?php if(isset($_GET['sy_id'])){
                      if($row['semester']== "3rd Semester"){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['semester'];
                      }
                ?>>3rd Semester</option>
                
              </select>
      </td>
    </tr>
    
    </table>
    <center>
      <a href="school-year.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        <button class="btn btn-primary" name="<?php if(isset($_GET['sy_id'])):?>update_button<?php else:?>save_button<?php endif;?>"><i class="fa fa-save"></i> Save Data</button>
        
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
