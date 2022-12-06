<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}

if(isset($_POST["btn_submit_csv"]))
{

  
    $filename=$_FILES["file"]["tmp_name"];
    $_FILES["file"]["type"] = "csv";
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        $ctr = 0;
        $TotalOfNewFoundPrograms = 0;
        while (($emapData = fgetcsv($file, 1000, ",")) !== FALSE)
        {

            $ctr++; // => Skips the first row.  
            if($ctr > 1){

                //$db -> where('Program', $emapData[6]);
                //$db -> get('program');
                //$CountNewProgram = '0';

                if($CountNewProgram == '0'){
                    $TotalOfNewFoundPrograms++;
                }
            //check Name
            $checkName = $dbcon->query("SELECT * FROM student_list WHERE user_id = '$emapData[0]' AND sched_id = '".$_GET['sched_id']."'") or die(mysqli_error());
            $countName = mysqli_num_rows($checkName);
            
            if($countName > 0){
                echo '<script type="text/javascript">alert("Please check your CSV file. There is a Student ID that was duplicated.");location.href = "view-student.php?sched_id='.$_GET['sched_id'].'";</script>';
    
                //$msg= "Please check your CSV file. There is a Student ID that was duplicated.";
            }else{
              $student = array(
                'user_id'        => $emapData[0],
                'sched_id'         => $_GET['sched_id']
              );
              $success = insertdata("student_list",$student);               
              header('location: view-student.php?sched_id='.$_GET['sched_id'].'');
            }
          }
        }
        fclose($file);
        
    }
    else{
        echo 'Invalid File:Please Upload CSV File';
    }
}

if(isset($_POST['save_button'])){
  $student_no = filter($_POST['student_no']);
  $sched_id = filter($_GET['sched_id']);

  $g = $dbcon->query("SELECT * FROM student_list WHERE user_id = '$student_no' AND sched_id='$sched_id'") or die(mysqli_error());
  $checkStudent = single_get("*","user_name","user_account",$student_no);
  $checkSched = single_get("*","sched_id","subject_schedule",$_GET['sched_id']);
  $user = single_get("*","user_name","user_account",$student_no);

  if(mysqli_num_rows($g) > 0){
    echo '<script>alert("Student no: '.$student_no.' already exist in this subject.");</script>';
  }elseif(empty($checkStudent)){
    echo '<script>alert("No student no: '.$student_no.' in the database.");</script>';
  }elseif($user['section_name'] != $checkSched['course_id']){
    echo '<script>alert("You are not allowed to add students to other course.");</script>';
  }else{
    $data = array("user_id" => $student_no, "sched_id"  => $sched_id);
    insertdata("student_list",$data);
    header("location: view-student.php?sched_id=$sched_id");
  }
}
if(isset($_GET['delete'])){ // Deleting records on the database.
  $delete = filter($_GET['delete']);

  //$del = $dbcon->query("SELECT * FROM student_list WHERE ") or die(mysqli_error());
  $ar = array("user_id"=>$delete, "sched_id"=>$_GET['sched_id']); //WHERE statement
  $tbl_name = "student_list"; 
  $del = Delete($dbcon,$tbl_name,$ar);
  if($del){
    header("location: view-student.php?sched_id='".$_GET['sched_id']."'");
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
      <!-- Small boxes (Stat box) -->
        <div class="col-md-12">
      <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-users"></i> My Students - <a href="#" data-toggle="modal" data-target="#add-student" class="btn btn-info"><i class="fa fa-plus"></i> Add Data</a> <a href="#" data-toggle="modal" data-target="#upload-data" class="btn btn-danger"><i class="fa fa-upload"></i> Upload Data</a> </h3>

            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
     <table width="100%" class="table table-striped table-bordered table-hover" id="example1" style="font-size:14px;">
        <thead>
            <tr>
                <th>Student #</th>
                <th>Name</th>
                <th>Email</th>
                <th>Cotact Number</th>
                <th>Option</th>
            </tr>
        </thead>
<tbody>
<?php 
$student = $dbcon->query("SELECT * FROM student_list INNER JOIN user_account on user_account.user_name = student_list.user_id WHERE sched_id = '".$_GET['sched_id']."'
") or die(mysqli_error());
while($row = $student->fetch_assoc()):
?>

            <tr>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['fname']?> <?php echo $row['mname']?> <?php echo $row['lname']?></td>
                <td><?php echo $row['user_email']?></td>
                <td><?php echo $row['user_contact']?></td>
                <td class="center">
                     <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="view-student.php?sched_id=<?php echo $_GET['sched_id']?>&delete=<?php echo $row['user_name']?>">Delete</a></li>
                      
                    </ul>
                  </div>
                </td>
            </tr>
                                    

<?php endwhile;?>
</tbody>
    </table>             
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- modal -->
     <div class="modal fade" id="add-student" style="width:100%;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <strong><i class="fa fa-plus"></i> Add Student</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button></span>
              </div>
              <div class="modal-body">
                <form method="post">
                  <input type="text" name="student_no" class="form-control" placeholder="Student ID number"><br>
                  <button class="btn btn-info" name="save_button"><i class="fa fa-save"></i> Save</button>
                </form>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
    <!-- end modal -->

<!-- modal -->
     <div class="modal fade" id="upload-data" style="width:100%;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <strong><i class="fa fa-plus"></i> Upload Bulk Student ID number</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button></span>
              </div>
              <div class="modal-body">
                <p>Please download the CSV file to upload bulk Users. <a href="convertcsv (3).csv">Download</a></p>
                <form method="post" enctype="multipart/form-data">
                  <input type="file" name="file" class="form-control" id="file" size="150" accept=".csv"><br>
                  <button class="btn btn-info" name="btn_submit_csv"><i class="fa fa-upload"></i> Upload CSV</button>
                </form>
              
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 
    <!-- end modal -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
