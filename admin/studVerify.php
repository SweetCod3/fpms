<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';
if(empty($_SESSION['login_admin'])){ //This function is to check weather the account has been login or not
  header("Location: ../index.php");
  exit;
}
if(isset($_GET['user_id'])){
    $id =$_GET['user_id'];
    $sql =
        "UPDATE user_account SET `user_role` = 2 WHERE user_id= '$id'";
    $dbcon->query($sql) or die($dbcon->error);
	mysqli_close($dbcon);
}
header("Location: unvStudent.php")
?>