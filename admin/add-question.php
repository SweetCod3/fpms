<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
switch (true) {
  case isset($_POST['save_button']):
    $question_name = filter($_POST['question_name']);
    $question_cat = filter($_POST['question_cat']);
    /*
    $avg_rate = filter($_POST['avg_rate']);
    $rate_dean = filter($_POST['rate_dean']);
    */

    $kweri = $dbcon->query("SELECT * FROM questions WHERE question_name='$question_name'") or die(mysqli_error());
    $checkName = mysqli_num_rows($kweri);
    //$checkID = single_get("*","user_name","user_account",$user_name);

      if(isset($_GET['q_id'])){
        $arr_where = array("q_id"  => $_GET['q_id']);//update where
        $arr_set   = array(
        "question_name"     => $question_name,
        "question_cat"      => $question_cat
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean*/
        ,
        "date_created"      => date("Y-m-d h:i a")
        );//set update
        $tbl_name  = "questions";
        $update    = update($dbcon,$tbl_name,$arr_set,$arr_where);// UPDATE SQL
        header("location: questions.php");
      }else{
      if($checkName > 0){
        $msg = 'Question: '.$question_name.' already exist.';
    
      }else{
        $data = array(
        "question_name"     => $question_name,
        "question_cat"      => $question_cat
        /*,
        "avg_rate"          => $avg_rate,
        "rate_dean"         => $rate_dean
        */,
        "date_created"      => date("Y-m-d h:i a")
        );
        insertdata("questions",$data);
        header("location: questions.php");
      }
        
      }
      
  break;  
}
if(isset($_GET['q_id'])):
    $info = getdata_where("*","q_id","questions",filter($_GET['q_id']));
    if(!empty($info)){
       foreach ($info as $key => $value) {
         $question_name = $value->question_name;
         $question_cat  = $value->question_cat;
         /*
         $avg_rate      = $value->avg_rate;
         $rate_dean     = $value->rate_dean;
         */
      }
    }else{
      header("location: error.php");
    }
endif;
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
              <h3 class="box-title"><i class="fa fa-plus"></i> Add Question </h3>
              <hr>
        <?php if(isset($msg)):?><div class="alert alert-danger"><?php echo $msg; ?></div><?php endif;?>
        <form method="post">
            <div class="row">
                <div class="col-md-2">Question:</div>
                <div class="col-md-8">
                    <textarea class="form-control" name="question_name" placeholder="Please add Question"><?php if(isset($_GET['q_id'])): echo $question_name; elseif(isset($_POST['save_button'])): echo $_POST['question_name']; endif;?>
                    </textarea>
                </div>
            </div>
             <p></p>
             <div class="row">
                <div class="col-md-2">Category:</div>
                <div class="col-md-8">
                    <select class="form-control" name="question_cat">
                        <option>A. Commitment</option>
                        <option>B. Knowledge of the subject</option>
                        <option selected>C. Teaching for independent learning</option>
                        <option>D. Management of learning</option>
                    </select>
                </div>
            </div>
            <p></p>
            <!--
             <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="avg_rate" class="form-control" value="<?php if(isset($_GET['q_id'])): echo $avg_rate; elseif(isset($_POST['save_button'])): echo $_POST['avg_rate']; endif;?>">
                </div>
            </div>
                        <p></p>
            <div class="row">
                <div class="col-md-2">Average rate:</div>
                <div class="col-md-8">
                    <input type="text" name="rate_dean" class="form-control" value="<?php if(isset($_GET['q_id'])): echo $rate_dean; elseif(isset($_POST['save_button'])): echo $_POST['rate_dean']; endif;?>">
                </div>
            </div>
          -->
            <br>
             <center>
            <a href="questions.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
             <button class="btn btn-primary" name="save_button">
                  <i class="fa fa-save"></i> Save
                </button>
                
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
