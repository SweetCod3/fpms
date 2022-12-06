<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$course = getdata("*","course_list");
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("section_id"=>$delete); //WHERE statement
  $tbl_name = "course_list"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: course.php");
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
              <h3 class="box-title"><i class="fa fa-book"></i> Course - <a href="add-course.php" class="btn btn-info">Add New Course</a></h3>
              <hr>
        <?php  if(!empty($course)):?>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Course Name</th>
                  <th>Created By</th>
                  <th>Date Added</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($course as $key => $value):?>
                <tr>
                  <td>
                   <?php echo $value->section_name;?>
                  </td>
                  <td>
                    <?php echo $value->created_by?>
                  </td>
                  <td>
                    <?php echo $value->date_added?>
                  </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="add-course.php?section_id=<?php echo $value->section_id?>"><i class="fa fa-pencil"></i> Update</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'course.php?delete='.$value->section_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
