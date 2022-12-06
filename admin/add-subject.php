<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_POST['save_button'])){
  $sub_code = filter($_POST['sub_code']);
  //$sub_name = filter($_POST['sub_name']);
  $sub_from = filter($_POST['sub_from']);
  $sub_until = filter($_POST['sub_until']);
  $user_id = filter($_POST['user_id']);
  /*
  $sub_day = filter($_POST['sub_day']);
  $sub_year = filter($_POST['sub_year']);
  $room_id = filter($_POST['room_id']);
  */
  $course_id = filter($_POST['course_id']);

  $sub_name = single_get("*","course_code","subject_list",$sub_code);

  $conflict1 = $dbcon->query("SELECT * FROM subject_schedule WHERE sub_from = '$sub_from'
  AND user_id='$user_id'") or die(mysqli_error());
  
  $conflict2 = $dbcon->query("SELECT * FROM subject_schedule WHERE sub_from = '$sub_from'
  AND user_id = '$user_id'") or die(mysqli_error());
  
  /*
  $conflict3 = $dbcon->query("SELECT * FROM subject_schedule WHERE sub_from = '$sub_from' AND sub_day = '$sub_day' AND room_id = '$room_id'") or die(mysqli_error());
  
  $conflict4 = $dbcon->query("SELECT * FROM subject_schedule WHERE sub_from = '$sub_from' AND sub_day = '$sub_day' AND room_id = '$room_id'") or die(mysqli_error());
  */

  if(mysqli_num_rows($conflict1) > 0){
    $msg = 'Subject is conflict. Please select other time slots or  teacher';
  }elseif(mysqli_num_rows($conflict2) > 0){
   $msg = 'The room you have entered has already occupied';
  }
  /*
  elseif(mysqli_num_rows($conflict3) > 0){
      $msg = 'The room you have entered has already occupied';
  }elseif(mysqli_num_rows($conflict4) > 0){
      $msg = 'The room you have entered has already occupied';
  }
  */
  elseif($sub_from == $sub_until){
      $msg = 'You cannot add schedule with the same time from start to end.';
  }elseif($sub_until == $sub_from){
      $msg = 'You cannot add schedule with the same time from start to end.';
  }else{
    $insertSQL = array(
          "sub_code"        =>$sub_code,
          "sub_name"        =>$_POST['sub_name'],
          "sub_from"        =>$sub_from,
          "sub_until"       =>$sub_until,
          "user_id"         =>$user_id,
          /*
          "sub_day"         =>$sub_day,
          "sub_year"        =>$sub_year,
          "room_id"         =>$room_id,
          */
          "course_id"       =>$course_id
    );
    insertdata("subject_schedule",$insertSQL);
    header("location: subjects.php");
  }
}
if(isset($_GET['sched_id']) AND isset($_POST['update_button'])){
  $sub_code = filter($_POST['sub_code']);
  //$sub_name = filter($_POST['sub_name']);
  $sub_from = filter($_POST['sub_from']);
  $sub_until = filter($_POST['sub_until']);
  $user_id = filter($_POST['user_id']);
  /*
  $sub_day = filter($_POST['sub_day']);
  $sub_year = filter($_POST['sub_year']);
  $room_id = filter($_POST['room_id']);
  */
  $course_id = filter($_POST['course_id']);

  $sub_name = single_get("*","course_code","subject_list",$sub_code);

  $arr_where = array("sched_id"=>filter($_GET['sched_id']));//update where
  $arr_set = array(
     "sub_code"        =>$sub_code,
     "sub_name"        =>$_POST['sub_name'],
     "sub_from"        =>$sub_from,
     "sub_until"        =>$sub_until,
     "user_id"         =>$user_id,
     /*
     "sub_day"         =>$sub_day,
     "sub_year"        =>$sub_year,
     "room_id"         =>$room_id,
     */
     "course_id"       =>$course_id
  );//set update
  $tbl_name = "subject_schedule";
  $update = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
  header("location: subjects.php");
}
if(isset($_GET['sched_id'])){
  $row = single_get("*","sched_id","subject_schedule",$_GET['sched_id']);
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
              <h3 class="box-title"><i class="fa fa-book"></i> Course Information </h3>
              <hr>
    <form method="post">
     <?php if(isset($msg)):?><div class="alert alert-danger"><?php  echo $msg;?></div> <?php endif;?>

<table class="table">
    <tr>
        <td>Course Code:</td>
        <td>
          <!--
          <select class="form-control" name="sub_code">
                  <?php $list = getdata("*","subject_list");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->course_code?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['sub_code']== $value->course_code){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['sub_code'];
                      }
                ?>><?php echo $value->course_code?> / <?php echo $value->course_name?> </option>
                <?php endforeach;?>
              </select>
            -->
       
            <input type="text" name="sub_code" class="form-control" placeholder="Subject Code" value="<?php if(isset($_GET['sched_id'])): echo $row['sub_code']; elseif(isset($_POST['save_button'])): echo $_POST['sub_code']; endif; ?>">
         
        </td>    
    </tr>
  
     <tr>
        <td>Course Name:</td>
        <td>
            <input type="text" name="sub_name" class="form-control" placeholder="Subject Name" value="<?php if(isset($_GET['sched_id'])): echo $row['sub_name']; elseif(isset($_POST['save_button'])): echo $_POST['sub_name']; endif; ?>">
        </td>    
    </tr>
  
    <tr>
        <td>Class Start:</td>
        <td>
          <!--
           <select class="form-control" name="sub_from">
                  <?php $list = getdata("*","time_sched");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->time_name?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['sub_from']== $value->time_name){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['sub_from'];
                      }
                ?>><?php echo date("h:i A",strtotime($value->time_name));?></option>
                <?php endforeach;?>
              </select>
            -->
            <input type="time" name="sub_from" class="form-control" value="<?php if(isset($_POST['save_button'])): echo $_POST['sub_from']; elseif(isset($_GET['sched_id'])):  echo $row['sub_from']; endif;?>">
        </td>    
    </tr>
    
    <tr>
        <td>Class End:</td>
        <td>
          <input type="time" name="sub_until" class="form-control" value="<?php if(isset($_POST['save_button'])): echo $_POST['sub_until']; elseif(isset($_GET['sched_id'])):  echo $row['sub_until']; endif;?>">
          <!--
           <select class="form-control" name="sub_until">
                  <?php $list = getdata("*","time_sched");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->time_name?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['sub_from']== $value->time_name){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['sub_from'];
                      }
                ?>><?php echo date("h:i A",strtotime($value->time_name));?></option>
                <?php endforeach;?>
              </select>
            -->
        </td>    
    </tr>
    <!--
    <tr>
        <td>Schedule Date:</td>
        <td>
            <select class="form-control" name="sub_day">
                  <?php $list = getdata("*","days");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->day_name?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['sub_day']== $value->day_name){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['sub_day'];
                      }
                ?>><?php echo $value->day_name?></option>
                <?php endforeach;?>
              </select>
        </td>    
    </tr>
  -->
    <tr>
        <td>Assign Professor:</td>
        <td>
            <select class="form-control" name="user_id">
                  <?php $list = getdata_where("*","user_role","user_account","1");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->user_id?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['user_id']== $value->user_id){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['user_id'];
                      }
                ?>><?php echo $value->fname?> <?php echo $value->mname?> <?php echo $value->lname?></option>
                <?php endforeach;?>
              </select>
        </td>    
    </tr>
    <!--
     <tr>
        <td>School Year:</td>
        <td>
            <select class="form-control" name="sub_year">
                  <?php $list = getdata("*","school_year");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->year?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['sub_year']== $value->year){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['sub_year'];
                      }
                ?>><?php echo $value->year?></option>
                <?php endforeach;?>
              </select>
        </td>    
    </tr>
  -->
    <tr>
        <td>Block:</td>
        <td>
            <select class="form-control" name="course_id">
                  <?php $list = getdata("*","course_list");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->section_id?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['course_id']== $value->section_id){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['course_id'];
                      }
                ?>><?php echo $value->section_name?></option>
                <?php endforeach;?>
              </select>
        </td>    
    </tr>
    <!--
     <tr>
        <td>Room:</td>
        <td>
              <select class="form-control" name="room_id">
                  <?php $list = getdata("*","rooms");?>
                    <?php foreach ($list as $key => $value):?>
                      <option value="<?php echo $value->room_id?>"
                      <?php if(isset($_GET['sched_id'])){
                      if($row['room_id']== $value->room_id){
                        echo 'selected';
                      }
                        }
                        elseif(isset($_POST['save_button'])){
                          echo $_POST['room_id'];
                      }
                ?>><?php echo $value->room_name?></option>
                <?php endforeach;?>
              </select>
        </td>    
    </tr>
    -->
    </table>
    <center>
      <a href="subjects.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        <button class="btn btn-primary" name="<?php if(isset($_GET['sched_id'])):?>update_button<?php else:?>save_button<?php endif;?>"><i class="fa fa-save"></i> Save Data</button>
        
    </center>
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
