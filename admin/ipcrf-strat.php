<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT ipcrf_stratprio.*, ipcrf_category.cat_name FROM (ipcrf_stratprio INNER JOIN ipcrf_category ON ipcrf_stratprio.sp_cat = ipcrf_category.cat_id) ORDER BY sp_id ASC";
$question = getdata_inner_join($query);


if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("sp_id"=>$delete); //WHERE statement
  $tbl_name = "ipcrf_stratprio"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: ipcrf-strat.php");
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
              <h3 class="box-title"><i class="fa fa-book"></i> IPCRF Strategic Prioties List - <a href="add-strat.php" class="btn btn-info">Add Data</a></h3>
              <hr>
              <p>NOTE: Once a Measure Categorizes to a Strategic Priority, that Strategic Priority WILL NOT BE ABLE TO BE DELETED.</p>

        <?php  if(!empty($question)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th width="15%"> ID</th>
                  <th width="40%">Description</th>
                  <th width="12.5%">Weight</th>
                  <th width="12.5%">Admin-only access</th>
                  <th width="20%">Category</th>
                  <!--<th>Average Rate(Student)</th>
                  <th>Average Rate(Dean)</th>-->
                </tr>
                </thead>
                <tbody>
              <?php foreach ($question as $key => $value):?>
              
                <tr>
                  <td>
                   <?php echo $value->sp_id;?>
                  </td>
                  <td>
                  <?php echo $value->sp_desc;?>
                </td>
                  </td>
                  <td>
                  <?php echo $value->sp_wt*100; echo '%'?>
                </td>
                  <td>
                  <?php echo $value->access;?>
                </td>
                  <td><?php echo $value->sp_cat;?> - <?php echo $value->cat_name;?> </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="add-strat.php?sp_id=<?php echo $value->sp_id?>"><i class="fa fa-pencil"></i> Update</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'ipcrf-strat.php?delete='.$value->sp_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
