<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/myfunction.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$myOrder = viewTransactions();
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
          <h3 class="box-title"><i class="fa fa-book"></i> Transactions</h3>
          <hr>
         <?php if(!empty($myOrder)):?>
        <table id="example1" class="table table-hover table-bordered">
            <thead>
                <tr>
                  <th>Purchase Order</th>
                  <th>Delivery Date</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Option</th>
                </tr>
            </thead>
        <tbody>
        <?php 
        foreach($myOrder as $key => $row):
          $g = TotalOrder($row->ItemCode);
        ?>
        <tr>
            <td>#<?php echo $row->ItemCode?></td>
            <td><?php echo $row->deliveryDate?></td>
            <td><?php echo $g['total']?></td>
            <td>
              <?php if($row->OrderStatus == '1'):?>
                <div class="label label-primary">Order</div>
              <?php elseif($row->OrderStatus == '2'):?>
                <div class="label label-warning">On Delivery</div>
              <?php elseif($row->OrderStatus == '3'):?>
                <div class="label label-success">Delivered</div>
              <?php endif;?>
            </td>
            <td>
            <?php if($row->OrderStatus == '3'):?>
            <?php else:?>
              <a href="update-order.php?ItemCode=<?php echo $row->ItemCode?>" class="btn btn-warning btn-sm">Update</a>
            <?php endif;?>
            </td>
        </tr>
                
                
                
    
        <?php endforeach;?>
       </table>
      <?php else:?>
        <div class="alert alert-danger">Shopping Cart is empty</div>
      <?php endif;?>
        </div>
      
      </div>
      </div>
    </section>


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
