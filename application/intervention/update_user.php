<?php

$id_entre = intval($_REQUEST['id_entre']);
$nature_pb = $_REQUEST['nature_pb'];
$diagnostic = $_REQUEST['diagnostic'];
$nom_buro_post = $_REQUEST['nom_buro_post'];
//$nom_expediteur = $_REQUEST['nom_expediteur'];


$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

   $sql = "update entrer set nature_pb='$nature_pb',diagnostic= '$diagnostic',nom_buro_post='$nom_buro_post',nom_expediteur='$nom_expediteur' where id_entre=$id_entre";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>