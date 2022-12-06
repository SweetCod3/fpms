<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/myfunction.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
switch (true) {
  case isset($_POST['save_button']):
    $ContentTitle = filter($_POST['ContentTitle']);
    $ContentDesc = $_POST['ContentDesc'];
    $ContentType = filter($_POST['ContentType']);

    if(isset($_GET['ContentID'])){
      $arr_where = array(
        "ContentID"=>filter($_GET['ContentID'])
      );//update where
      $arr_set = array(
        "ContentTitle"  =>$ContentTitle,
        "ContentDesc"   =>$ContentDesc,
        "ContentType"   =>$ContentType
      );//set update
      $tbl_name = "content_management";
      $update = UpdateQuery($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
      header("location: content.php");
    }else{
      $insertArray = array(
      "ContentTitle"  => $ContentTitle,
      "ContentDesc"   => $ContentDesc,
      "ContentType"   => $ContentType
    );
      SaveData("content_management",$insertArray);
      header("location: content.php");
    }
    
  break;  
}
if(isset($_GET['ContentID'])):
    $trivia = fetchWhere("*","ContentID","content_management",filter($_GET['ContentID']));
    if(!empty($trivia)){
       foreach ($trivia as $key => $value) {
        $ContentTitle = $value->ContentTitle;
        $ContentDesc  = $value->ContentDesc;
        $ContentType  = $value->ContentType;
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
    <br>
    <div class="col-md-12">
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-plus"></i> Trivia Information</h3>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
             <form method="post">
            <div class="row">
              
              <div class="col-md-12">
                <input type="text" class="form-control" name="ContentTitle" placeholder="Title" required value="<?php if(isset($_GET['ContentID'])): echo $ContentTitle; elseif(isset($_POST['save_button'])): echo $_POST['ContentTitle']; endif;?>">
              </div>
              <br>
               <div class="col-md-12">
                <select class="form-control" name="ContentType">
                  <option value="0" <?php if(isset($_GET['ContentID'])){
                  if($ContentType == "0"){echo 'selected';}}
                  elseif(isset($_POST['save_button'])){echo $_POST['ContentType'];}?>>About Us</option>
                  <option value="1" <?php if(isset($_GET['ContentID'])){
                  if($ContentType == "1"){echo 'selected';}}
                  elseif(isset($_POST['save_button'])){echo $_POST['ContentType'];}?>>Contact Us</option>
                </select>
              </div>
              <br>
              <div class="col-md-12">
                <textarea id="editor1" name="ContentDesc" rows="10" cols="80" required><?php if(isset($_GET['ContentID'])): echo $ContentDesc; elseif(isset($_POST['save_button'])): echo $_POST['ContentDesc']; endif;?></textarea>
                <br>
                
                <a href="content.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
                <button class="btn btn-primary" name="save_button">
                  <i class="fa fa-save"></i> Save
                </button>
              </div>
            </div>
            </form>
             
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
