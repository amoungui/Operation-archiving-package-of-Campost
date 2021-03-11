<?php

$date = $_REQUEST['date'];
$nature_pb = $_REQUEST['nature_pb'];
$diagnostic = $_REQUEST['diagnostic'];
$nom_buro_post = $_REQUEST['nom_buro_post'];
$nom_expediteur = $_REQUEST['nom_expediteur'];
$code_mat = $_REQUEST['code_mat'];
$designation = $_REQUEST['designation'];
$numero_serie = $_REQUEST['numero_serie'];
$marque = $_REQUEST['marque'];
$nom = $_REQUEST['nom'];

$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "insert into entrer,materiel,agent(date,nature_pb,diagnostic,nom_buro_post,nom_expediteur,code_mat,designation,numero_serie,marque,nom)
values('$date','$nature_pb','$diagnostic','$nom_buro_post','$nom_expediteur','$code_mat','$designation','$numero_serie','$marque','$nom')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>