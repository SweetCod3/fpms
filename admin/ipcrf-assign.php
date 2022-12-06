<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

$query = "SELECT ipcrf_ansf.*, user_account.user_id,user_account.fname,user_account.mname,user_account.lname, user_account.suffix FROM (ipcrf_ansf INNER JOIN user_account ON ipcrf_ansf.fans_fid = user_account.user_id) WHERE fans_appr = 0";
$ipcPROF = getdata_inner_join($query);
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);
  $ar = array("user_id"=>$delete); //WHERE statement
  $tbl_name = "user_account"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: professor.php");
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
              <h3 class="box-title"><i class="fa fa-users"></i> <i class="fa fa-file"></i> Professor's IPCRFs </h3>
              <hr>
        <?php  if(!empty($ipcPROF)):?>
               <table id="example1" class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                <tr>
                  <th>Submission ID</th>
                  <th>Respondent User ID</th>
                  <th>Full Name</th>
                  <th>Submitted On:</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
              <?php foreach ($ipcPROF as $key => $value):?>
                <tr>
                  <td>
                   <?php echo $value->fans_id;?>
                  </td>
                  <td>
                   <?php echo $value->user_id;?>
                  </td>
                  <td>
                    <?php echo $value->fname?> <?php echo $value->mname?>
 <?php echo $value->lname?> <?php echo $value->suffix?>                  </td>
                  
                
                  <td>
                    <?php echo $value->fans_date?>
                  </td>
                  <td>

                  <div class="btn-group">
                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="add-ipcrf-rev.php?prof_id=<?php echo $value->user_id."&appr=".$value->fans_appr ?>"><i class="fa fa-pencil"></i>Review Submission</a></li>
                    <li>
                      <a href="#" <?php echo 'onclick=" confirm(\'Are you sure you want to Delete?\') 
      ?window.location = \'professor.php?delete='.$value->user_id.'\' : \'\';"'; ?>><i class="fa fa-remove"></i> Deny Submission</a>
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
