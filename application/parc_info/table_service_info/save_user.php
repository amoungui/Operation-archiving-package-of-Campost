
<?php

$id_si= $_REQUEST['id_si'];
$nature_pb= $_REQUEST['nature_pb'];
$code_bp = $_REQUEST['code_bp'];
$diagnotics = $_REQUEST['diagnotics'];
$travail_fait = $_REQUEST['travail_fait'];
$resultat = $_REQUEST['resultat'];
$observation= $_REQUEST['observation'];
$technicien= $_REQUEST['technicien'];
$date_arr= $_REQUEST['date_arr'];
$date_sortie= $_REQUEST['date_sortie'];
$id=$_REQUEST['id'];


$conn = @mysql_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('campost', $conn);
if(!$db){
    echo 'erreur base de données';
}

$sql = "insert into servic_info(id_si,nature_pb,diagnostics,travail_fait,resultat,observation,technicien,date_arr,date_sortie,code_bp,id) values('','$nature_pb','$diagnotics','$travail_fait','$resultat','$observation','$technicien','$date_arr','$date_sortie','$code_bp','$id')";
$result = @mysql_query($sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
}
?>