<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/myfunction.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
$items = fetchAll("*","items");
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("ItemID"=>$delete); //WHERE statement
  $tbl_name = "items"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: item-list.php");
  }
}
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
              <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Item List</h3>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
            <a href="add-item.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add Data</a>
              <p></p>
            <?php  if(!empty($items)):?>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Photo</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Date Created</th>
                  <th>Feature Product</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($items as $key => $value):?>
                <tr>
                  <td>
                    <img src="../img/<?php echo $value->ItemPhoto?>" class="img-thumbnail" width="80">
                  </td>
                  <td>
                    <?php echo $value->ItemName?>
                    <br><br>
                    <?php 
                    if($value->ItemQty == '0'){
                      echo '<span style="color:white;background:red; padding:5px;">Out of Stock</span>';
                    }elseif($value->ItemQty < '5'){
                      echo '<span style="color:white;background:red; padding:5px;">Limited Stocks</span>';
                    }elseif($value->ItemQty > '5'){
                      echo '<span style="color:white;background:green; padding:5px;">Healthy Stock</span>';
                    }
                    ?>    
                  </td>
                  <td>
                    <?php echo $value->ItemPrice?><br><br>
                      
                  </td>
                  <td><?php echo $value->ItemQty?></td>
                  
                  <td><?php echo $value->DateCreated?></td>
                  <td><?php if($value->ItemFeature == '0'): echo "No"; else: echo "Yes"; endif;?></td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="add-item.php?ItemID=<?php echo $value->ItemID?>"><i class="fa fa-pencil"></i> Update</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'item-list.php?delete='.$value->ItemID.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Delete</a>
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
            <!-- /.box-body -->
          </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
