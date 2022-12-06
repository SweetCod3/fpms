<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/myfunction.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['save_btn'])){
 
  $ItemCode = filter($_POST['ItemCode']);
  $OrderStatus = filter($_POST['OrderStatus']);
  if($OrderStatus == '2'){
     $deliveryDate = filter($_POST['deliveryDate']);
    $arr_where = array("ItemCode"=>filter($_GET['ItemCode']));//update where
    $arr_set = array(
      "deliveryDate"  => $deliveryDate,
      "OrderStatus"   => $OrderStatus
    );//set update
    $tbl_name = "ordering";
    $update = UpdateQuery($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
  }elseif($OrderStatus == '3'){
    $arr_where = array("ItemCode"=>filter($_GET['ItemCode']));//update where
    $arr_set = array(
      "OrderStatus"   => $OrderStatus
    );//set update
    $tbl_name = "ordering";
    $update = UpdateQuery($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
  }
  
  header("location: transaction.php");
}
$b = viewProduct($_GET['ItemCode']);
$h = fetchWhere("*","ItemCode","ordering",$_GET['ItemCode']);
if(!empty($h)){
  foreach ($h as $key => $value) {
    $ID = $value->UserID;
    $OrderStatus = $value->OrderStatus;
  }
}else{
  header("location: index.php");
}
$user = getSingleRow("*","UserID","accounts",$ID);
$myOrder = allTransactions();
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
          <h3 class="box-title"><i class="fa fa-pencil"></i> Update Transaction</h3>
          <hr>
<h4><i class="fa fa-user"></i> Personal Information</h4>
<hr>
<table class="table table-bordered">
  <tr>
    <td>Full Name:</td>
    <td><?php echo $user['FirstName']?> <?php echo $user['LastName']?></td>
    <td>Email Address:</td>
    <td><?php echo $user['EmailAddress']?></td>
  </tr>
  <tr>
    <td>Contatc Number:</td>
    <td><?php echo $user['ContactNumber']?></td>
    <td>Home Address:</td>
    <td><?php echo $user['PermanentAddress']?></td>
  </tr>
</table>
<hr>
<h4><i class="fa fa-file"></i> Product List</h4>
<hr>
<?php if(!empty($b)):?>
  <table id="example1" class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>Photo</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Sub Total</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($b as $key => $value):?>
     <tr>
      <td>
        <img src="../img/<?php echo $value->ItemPhoto?>" class="img-thumbnail" width="100">
      </td>
      <td><?php echo $value->ItemName?></td>
      <td><?php echo $value->ReservationQty?> Items</td>
      <td>&#8369; <?php echo $value->ReservationPrice?></td>
    </tr>
  <?php endforeach;?>
</table>
<?php else:?>
  <div class="aler alert-danger">No records on the database.</div>
<?php endif;?>
<h4>Delivery Date:</h4>
<form method="post">
  <input type="hidden" name="ItemCode" value="<?php echo $_GET['ItemCode']?>">
<?php if($OrderStatus == '1'):?>
  <input type="date" name="deliveryDate" class="form-control" required min="<?php echo date("Y-m-d");?>">
<?php endif;?><br>
  <select class="form-control" name="OrderStatus">
     <option value="1" <?php if(isset($_GET['ItemCode'])){
      if($OrderStatus == "1"){echo 'selected';}}
      elseif(isset($_POST['save_btn'])){echo $_POST['OrderStatus'];}?>>Order</option>
    <option value="2" <?php if(isset($_GET['ItemCode'])){
      if($OrderStatus == "2"){echo 'selected';}}
      elseif(isset($_POST['save_btn'])){echo $_POST['OrderStatus'];}?>>For Delivery</option>
    <option value="3" <?php if(isset($_GET['ItemCode'])){
      if($OrderStatus == "3"){echo 'selected';}}
      elseif(isset($_POST['save_btn'])){echo $_POST['OrderStatus'];}?>>Delivered</option>
  </select>
<br>
<button class="btn btn-primary" name="save_btn"><i class="fa fa-save"></i> Save</button>
</form>
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
