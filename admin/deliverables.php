<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}


$sql ="SELECT deliv_files.*,user_account.* FROM (deliv_files INNER JOIN user_account ON deliv_files.file_uid = user_account.user_id)";
$items = $dbcon->query($sql) or die($con->error);
$row = $items->fetch_assoc();


if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("file_id"=>$delete); //WHERE statement
  $tbl_name = "deliv_files"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: deliverables.php");
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
              <h3 class="box-title"><i class="fa fa-download"></i> Deliverables  <a href="add-upload-config.php" class="btn btn-success">Configure upload settings</a> <a href="add-upload.php" class="btn btn-info">Upload a File</a></h3>
              <hr>
              <p>NOTE: Once a Strategic Priority Categorizes to a Category, that category WILL NOT BE ABLE TO BE DELETED.</p>
        <?php  if(!empty($row)):?>
          <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                 
                  <th width="15%">Upload ID</th>
                  <th width="25%">File </th>
                  <th width="15%">File Type</th>
                  <th width="30%">Uploaded By</th>
                  <th width="15%">Uploaded On:</th>
                  <!--<th>Average Rate(Student)</th>
                  <th>Average Rate(Dean)</th>-->
                </tr>
                </thead>
                <tbody>
              <?php do {
                # code...
             ?>
              
                <tr>
                  <td>
                   <?php echo $row['file_id'];?>
                  </td>
                  <td>  <a download="<?php echo $row['file_dest'] ?>" href=" <?php echo $row['file_dest'] ?> "> <i class="fa fa-download"></i> </a> 
                  <a href="<?php echo $row['file_dest'];?>"> <?php echo $row['file_name'];?> </a>
                  
                </td>
                  </td>
                  <td>
                  <?php echo $row['file_type'];?>
                </td>
                  
                  <td><?php echo $row['fname']." ".$row['lname'];?> </td>
                  
                  
                  <td><?php echo $row['file_date'];?> </td>
                  <td>

<div class="btn-group">
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
</button>
<ul class="dropdown-menu" role="menu">
  <li>
    <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
?window.location = \'deliverables.php?delete='.$row['file_id'].'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
</li>
</ul>
</div>
</td>
                </tr>
              <?php } while ($row = $items->fetch_assoc());?>
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
