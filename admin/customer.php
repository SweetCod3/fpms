<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/myfunction.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$customer = fetchWhere("*","UserType","accounts","1");

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
              <h3 class="box-title"><i class="fa fa-plus"></i> Customer Accounts</h3>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <p></p>
            <?php  if(!empty($customer)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Email Address</th>
                  <th>Contact Number</th>
                  <th>Permanent Address</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($customer as $key => $value):?>
                <tr>
                  <td>
                  <?php echo $value->FirstName?> <?php echo $value->LastName?> 
                  </td>
                  <td><?php echo $value->EmailAddress?> </td>
                  <td><?php echo $value->ContactNumber?> </td>
                  <td><?php echo $value->PermanentAddress?></td>
                </tr>
                <!-- View Full Job-->
<div class="modal fade" id="view-content<?php echo $value->ContentID?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              <div class="modal-body">
                <strong>Title:</strong><?php echo $value->ContentTitle?>
                <br>
                <strong>Description: </strong><br>
                <?php echo htmlspecialchars($value->ContentDesc);?>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</div>
<!-- end -->
              <?php endforeach;?>
              </table>
              <?php else:?>
                <div class="alert alert-danger">There are no records on the database.</div>
              <?php endif;?>
             
            </div>
            <!-- /.box-body -->
          </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
