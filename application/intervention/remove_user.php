<?php

$id_entre = intval($_REQUEST['id_entre']);
$id_mat = intval($_REQUEST['id_mat']);
$id_agent = intval($_REQUEST['id_agent']);
$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "delete from entrer,materiel,agent where id_entre=$id_entre";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>