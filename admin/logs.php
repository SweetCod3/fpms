<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$query = "SELECT * FROM logs ORDER BY log_id ASC";
$logs = getdata_inner_join($query);
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
              <h3 class="box-title"><i class="fa fa-book"></i> System Logs </h3>
              <hr>
        <?php  if(!empty($logs)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th>Log Description</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($logs as $key => $value):?>
              
                <tr>
                  <td>
                   <?php echo $value->log_desc;?>
                  </td>
                  <td><?php echo $value->date_created;?></td>
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
