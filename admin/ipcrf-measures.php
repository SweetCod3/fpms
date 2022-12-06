<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT ipcrf_measures.*, ipcrf_stratprio.sp_desc FROM (ipcrf_measures INNER JOIN ipcrf_stratprio ON ipcrf_measures.meas_sp = ipcrf_stratprio.sp_id) ORDER BY meas_id ASC";
$question = getdata_inner_join($query);

$sql ="SELECT * FROM ipcrf_measures";
$items = $dbcon->query($sql) or die($con->error);
$row = $items->fetch_assoc();
$totwt =0;

if (!empty($items)) {
  do {
        $totwt += $row['meas_wt'];
      }  while ($row = $items->fetch_assoc());     
}

if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("meas_id"=>$delete); //WHERE statement
  $tbl_name = "ipcrf_measures"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: ipcrf_measures.php");
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
              <h3 class="box-title"><i class="fa fa-book"></i> IPCRF Measures List - <a href="add-meas.php" class="btn btn-info">Add Data</a></h3>
              <hr>
              <p>NOTE: Once a Strategic Priority Categorizes to a Category, that category WILL NOT BE ABLE TO BE DELETED.</p>
        <?php  if(!empty($question)):?>
          <h3 >Total weight: <?php echo $totwt * 100?>%</h3>    
          <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th width="15%"> ID</th>
                  <th width="40%">Description</th>
                  <th width="15%">Weight</th>
                  <th width="30%">Strategic Priority</th>
                  <!--<th>Average Rate(Student)</th>
                  <th>Average Rate(Dean)</th>-->
                </tr>
                </thead>
                <tbody>
              <?php foreach ($question as $key => $value):?>
              
                <tr>
                  <td>
                   <?php echo $value->meas_id;?>
                  </td>
                  <td>
                  <?php echo $value->meas_desc;?>
                </td>
                  </td>
                  <td>
                  <?php echo $value->meas_wt*100; echo '%'?>
                </td>
                  
                  <td><?php echo $value->meas_sp;?> - <?php echo $value->sp_desc;?> </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="add-meas.php?meas_id=<?php echo $value->meas_id?>"><i class="fa fa-pencil"></i> Update</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'ipcrf-measures.php?delete='.$value->meas_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
