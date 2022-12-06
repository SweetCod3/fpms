<?php
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';

$e_code = filter($_GET['e_code']);
//formula total number of student * Average rating per question( 4 * 10)

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'MASTERY OF THE SUBJECT' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'TEACHING SKILLS AND MANAGEMENT' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'PERSONAL TRAITS' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);

$kweri1 = "SELECT * FROM questions WHERE question_cat = 'OTHER FACTORS *for dean and department head only*' ORDER BY q_id ASC";
$others = getdata_inner_join($kweri1);


foreach ($mastery as $key => $value){

	$answer = "answers".$value->q_id."";
	$d = substr($answer, 7,9);
	 
	$data = array(
		"e_code"	=> $e_code,
		"user_id"	=> $_SESSION['user_id'],
		"r_question"=> $d,
		"r_result"	=> $_GET["".$answer.""]
	);
	insertdata("result",$data);
}

foreach ($teaching as $key => $value){

	$answer = "answers2".$value->q_id."";
	$d = substr($answer, 8,9);
	 
	$data = array(
		"e_code"	=> $e_code,
		"user_id"	=> $_SESSION['user_id'],
		"r_question"=> $d,
		"r_result"	=> $_GET["".$answer.""]
	);
	insertdata("result",$data);
}

foreach ($personal as $key => $value){

	$answer = "answers3".$value->q_id."";
	$d = substr($answer, 8,9);

	 
	$data = array(
		"e_code"	=> $e_code,
		"user_id"	=> $_SESSION['user_id'],
		"r_question"=> $d,
		"r_result"	=> $_GET["".$answer.""]
	);
	insertdata("result",$data);
}

foreach ($others as $key => $value){

	$answer = "answers".$value->q_id."";
	$d = substr($answer, 7,9);
	 
	$data = array(
		"e_code"	=> $e_code,
		"user_id"	=> $_SESSION['user_id'],
		"r_question"=> $d,
		"r_result"	=> $_GET["".$answer.""]
	);
	insertdata("result",$data);
}
echo '<script>alert("You have successfully taken the survey."); window.location = "index.php";</script>';

?>