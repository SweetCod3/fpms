<?php 
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';

if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileErr = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',  $fileName);
    $fileActualExt = strtolower(end($fileExt));  

    $allowed = array('jpg','jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
       if ($fileErr === 0 ) {
        if ($fileSize < 20000) {
            $fileNameNew = uniqid('',true).".".$fileActualExt;
            $fileDestination = '../uploads/'.$fileNameNew; 
            move_uploaded_file($fileTmpName,$fileDestination);
            header("Location:deliverables.php?upload=succs");
        }else {
            echo "Your file is too big!";
        }
       }
       else {
        echo "There was an error in uploading your file!";
       }
    }else {
        echo "You cannot upload files of this type!";
    }
}

?>