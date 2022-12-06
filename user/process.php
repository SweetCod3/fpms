<?php
include'../config/db.php';
include'../config/functions.php';
include'../config/main_function.php';

$e_code = filter($_GET['e_code']);
//formula total number of student * Average rating per question( 4 * 10)
$kweri1 = "SELECT * FROM questions WHERE question_cat = 'A. Commitment' ORDER BY q_id ASC";
$mastery = getdata_inner_join($kweri1);

$kweri2 = "SELECT * FROM questions WHERE question_cat = 'B. Knowledge of the subject' ORDER BY q_id ASC";
$teaching = getdata_inner_join($kweri2);

$kweri3 = "SELECT * FROM questions WHERE question_cat = 'C. Teaching for independent learning' ORDER BY q_id ASC";
$personal = getdata_inner_join($kweri3);

$kweri4 = "SELECT * FROM questions WHERE question_cat = 'D. Management of learning' ORDER BY q_id ASC";
$last = getdata_inner_join($kweri4);

if(!empty($mastery)):
foreach ($mastery as $key => $value){

	$answer = "answers".$value->q_id."";
	$d = substr($answer, 7,9);
	 
	$data = array(
		"e_code"				=> $e_code,
		"user_id"				=> $_SESSION['user_id'],
		"r_question"			=> $d,
		"r_result"				=> $_GET["".$answer.""],
		"question_cat"			=> "A. Commitment"
	);
	insertdata("result",$data);
}
else:
endif;
if(!empty($teaching)):
foreach ($teaching as $key => $value){

	$answer = "answers2".$value->q_id."";
	$d = substr($answer, 8,9);
	 
	$data = array(
		"e_code"			=> $e_code,
		"user_id"			=> $_SESSION['user_id'],
		"r_question"		=> $d,
		"r_result"			=> $_GET["".$answer.""],
		"question_cat"		=> "B. Knowledge of the subject"
	);
	insertdata("result",$data);
}
else:
endif;

if(!empty($personal)):
foreach ($personal as $key => $value){

	$answer = "answers3".$value->q_id."";
	$d = substr($answer, 8,9);

	 
	$data = array(
		"e_code"			=> $e_code,
		"user_id"			=> $_SESSION['user_id'],
		"r_question"		=> $d,
		"r_result"			=> $_GET["".$answer.""],
		"question_cat"		=> "C. Teaching for independent learning"
	);
	insertdata("result",$data);
}
else:
endif;

if(!empty($last)):
foreach ($last as $key => $value){

	$answer = "answers4".$value->q_id."";
	$d = substr($answer, 8,9);

	 
	$data = array(
		"e_code"		=> $e_code,
		"user_id"		=> $_SESSION['user_id'],
		"r_question"	=> $d,
		"r_result"		=> $_GET["".$answer.""],
		"question_cat"	=> "D. Management of learning"
	);
	insertdata("result",$data);
}
else:
endif;

insertdata("comment_type",array(
	"e_code"			=>$e_code,
	"comment_feedback"	=>$_GET['comment_feedback']
)
);
echo '<script>alert("You have successfully taken the evaluation."); window.location = "index.php";</script>';

?>