<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT ipcrf_valmap.*, ipcrf_target.t_desc FROM (ipcrf_valmap INNER JOIN ipcrf_target ON ipcrf_valmap.map_targ = ipcrf_target.t_id) ORDER BY map_id ASC";
$target= getdata_inner_join($query);


if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("map_id"=>$delete); //WHERE statement
  $tbl_name = "ipcrf_valmap"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: ipcrf_valGuide.php");
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
              <h3 class="box-title"><i class="fa fa-book"></i> IPCRF Target Value Guide - <a href="add-target-gd.php" class="btn btn-info">Add Data</a></h3>
              <hr>
              <p>NOTE: Once a Target Categorizes to a Measure, that Measure WILL NOT BE ABLE TO BE DELETED.</p>

        <?php  if(!empty($target)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th width="15%"> ID</th>
                  <th width="12.5%">Values</th>
                  <th width="20%">Target</th>
                  <!--<th>Average Rate(Student)</th>
                  <th>Average Rate(Dean)</th>-->
                </tr>
                </thead>
                <tbody>
              <?php foreach ($target as $key => $value):?>
              
                <tr>
                  <td>
                   <?php echo $value->map_id;?>
                  </td>
                  <td>
                  <?php echo $value->map_desc;?>
                </td>
                  </td>
                  <td>
                  <?php echo $value->map_val?>
                </td>
                 
                  <td><?php echo $value->map_targ;?> - <?php echo $value->t_desc;?> </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'ipcrf-valGuide.php?delete='.$value->map_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
