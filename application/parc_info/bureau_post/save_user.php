<?php

$code_bp = $_REQUEST['code_bp'];
$libele = $_REQUEST['libele'];
$phone = $_REQUEST['phone'];
$lieu = $_REQUEST['lieu'];


$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "insert into buro_post(code_bp,libele,lieu,phone) values('$code_bp','$libele','$lieu','$phone')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>