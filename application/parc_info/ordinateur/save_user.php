<?php

$code_mat = $_REQUEST['code_mat'];
$code_bp = $_REQUEST['code_bp'];
$designation = $_REQUEST['designation'];
$marque = $_REQUEST['marque'];
$numero_serie = $_REQUEST['numero_serie'];
$taille_ecran = $_REQUEST['taille_ecran'];
$type_clavier = $_REQUEST['type_clavier'];
$type_souris = $_REQUEST['type_souris'];
$taille_disk = $_REQUEST['taille_disk'];
$taille_ram = $_REQUEST['taille_ram'];
$type_cable = $_REQUEST['type_cable'];

$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "insert into materiel(code_mat,code_bp,designation,marque,numero_serie,taille_ecran,type_clavier,type_souris,taille_disk,taille_ram,type_cable)
values('$code_mat','$code_bp','$designation','$marque','$numero_serie','$taille_ecran','$type_clavier','$type_souris','$taille_disk','$taille_ram','$type_cable')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}

?>