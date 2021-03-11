<?php

$code_bp = $_REQUEST['code_bp'];
$libele = $_REQUEST['libele'];
$lieu = $_REQUEST['lieu'];
$phone = $_REQUEST['phone'];



$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "update buro_post set code_bp ='$code_bp',libele ='$libele',lieu ='$lieu' ,phone ='$phone' where code_bp='$code_bp' ";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>