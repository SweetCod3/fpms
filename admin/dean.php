<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$student = getdata_where("*","user_role","user_account","3");
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("user_id"=>$delete); //WHERE statement
  $tbl_name = "user_account"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: professor.php");
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
              <h3 class="box-title"><i class="fa fa-users"></i> Dean Account - <a href="add-dean.php">Add Information</a></h3>
              <hr>
        <?php  if(!empty($student)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Full Name</th>
                  
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
 <?php echo $value->lname?>  <?php echo $value->suffix?>                 </td>
                  
                  <td>
                    <?php echo $value->user_address?>
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
                    <li><a href="add-dean.php?user_id=<?php echo $value->user_id?>"><i class="fa fa-pencil"></i> Update</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'dean.php?delete='.$value->user_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
