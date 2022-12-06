<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$student = getdata_where("*","user_role","user_account","22");
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("user_id"=>$delete); //WHERE statement
  $tbl_name = "user_account"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: student.php");
  }
}
if(isset($_GET['reset'])){ // Deleting records on the database.
  $reset = filter($_GET['reset']);

  $arr_where = array("user_name"  => $reset);//update where
  $arr_set   = array("pass"       => hash("sha256",$reset));//set update
  $tbl_name  = "user_account";
  $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
  echo '<script>alert("Password has been successfully reset. Your password is: '.$reset.'");</script>';
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
              <h3 class="box-title"><i class="fa fa-users"></i> Unverified Student Accounts 
                <!--
                 <a href="upload-student.php" class="btn btn-danger"><i class="fa fa-upload"></i> Upload CSV</a>
               -->
                </h3>
              <hr>
        <?php  if(!empty($student)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:13px;">
                <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Full Name</th>
                  <th>Block</th>
                  <th>Address</th>
                  <th>Contact #</th>
                  <th>Email</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($student as $key => $value):?>
                <tr>
                  <td>
                   <?php echo $value->user_name;?>
                  </td>
                  <td>
                    <?php echo $value->fname?> <?php echo $value->mname?>
 <?php echo $value->lname?> <?php echo $value->suffix?>                    </td>
                  <td>
                    <?php $f = single_get("*","section_id","course_list",$value->section_name);
                    echo $f['section_name']?>
                  </td>
                  <td>
                    <?php echo $value->user_address?> <?php echo $value->user_brgy?> <?php echo $value->user_city?>
                  </td>
                  <td>
                    <?php echo $value->user_contact?>
                  </td>
                  <td>
                    <?php echo $value->user_email?>
                  </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="studVerify.php?user_id=<?php echo $value->user_id?>"><i class="fa fa-check"></i> Verify</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'student.php?delete='.$value->user_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Deny</a>
    </li>
   
                  </ul>
                  </div>
                  </td>
                </tr>
              <?php endforeach;?>
              </table>
              <?php else:?>
                <div class="alert alert-danger">There are no records on the database.</div>
              <?php endif;?>
            </div>
      </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
