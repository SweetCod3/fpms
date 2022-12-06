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
                /*
            $checkName = $dbcon->query("SELECT * FROM user_account WHERE user_name = '$emapData[0]'") or die(mysqli_error());
            $countName = mysqli_num_rows($checkName);
            $kweri = $dbcon->query("SELECT * FROM user_account WHERE lname = '$emapData[3]' AND fname = '$emapData[1]' AND mname = '$emapData[2]'") or die(mysqli_error());
            $exist = mysqli_num_rows($kweri);
            if($countName > 0){
                echo '<script type="text/javascript">alert("Please check your CSV file. There is a Student ID that was duplicated.");location.href = "upload-student.php";</script>';
    
                
            }elseif($exist > 0 ){
                echo '<script type="text/javascript">alert("Please check your CSV file. There is a Student Name that was duplicated.");location.href = "upload-student.php";</script>';
                //$msg= "";
            }else{
              */
              $student = array(
                'user_name'        => $emapData[0],
                'pass'             => hash('sha256',$emapData[0]),
                'fname'            => $emapData[2],
                'mname'            => $emapData[3],
                'lname'            => $emapData[4],
                'user_contact'     => $emapData[5],
                'user_address'     => $emapData[6],
                'user_email'       => $emapData[7],
                'section_name'     => $_POST['section_name'],
                'user_role'        => "2",
              );
              $success = insertdata("user_account",$student);               
              header('location: student.php');
            //}
          }
        }
        fclose($file);
        
    }
    else{
        echo 'Invalid File:Please Upload CSV File';
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
              <h3 class="box-title"><i class="fa fa-upload"></i> Upload </h3>
              <hr>
<p>Upload student account. Click here to download the csv file <a href="convertcsv (5).csv">Download</a></p>
       <form method="post" enctype="multipart/form-data">
        <strong>Upload file:</strong>
         <input type="file" name="file"  id="file" size="150" accept=".csv" placeholder="">
         <br>
         <strong>Section:</strong>
         <select class="form-control" name="section_name">
          <?php $f = getdata("*","course_list");?>
          <?php foreach ($f as $key => $value):?>
           <option value="<?php echo $value->section_id?>"><?php echo $value->section_name?></option>
          <?php endforeach;?>
         </select>
         <br>
          <button class="btn btn-primary" name="btn_submit_csv"><i class="fa fa-save"></i> Upload</button>
       </form>
            </div>
      </div>
    </section>



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include'../assets/admin_footer.php';?>
</body>
</html>
