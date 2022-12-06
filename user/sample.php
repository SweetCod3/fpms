<?php
if(isset($_POST['submit'])){
  echo $_POST['answer'];
  echo $_POST['answer2'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form method="post">
  1. My name?<br>
  <input type="radio" name="answer" value="Patrick"> Patrick<br>
  <input type="radio" name="answer" value="mark"> Mark<br>
  <p></p>
  2. My Age?<br>
  <input type="radio" name="answer2" value="26"> 26<br>
  <input type="radio" name="answer2" value="27"> 27<br>
  <input type="submit" name="submit">
</form>
</body>
</html>