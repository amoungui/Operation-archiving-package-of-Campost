<?php

        
	//include 'conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
//	$designation = isset($_POST['designation']) ? mysql_real_escape_string($_POST['designation']) : '';
//	$numero_serie = isset($_POST['numero_serie']) ? mysql_real_escape_string($_POST['numero_serie']) : '';
         if (!empty ($_POST['designation']) && !empty ($_POST['numero_serie'])) {
            $designation = $_POST['designation'];
            $numero_serie = $_POST['numero_serie'];
        } else {
            $designation = isset($_POST['designation']);
            $numero_serie = isset($_POST['numero_serie']);
        }	
	$offset = ($page-1)*$rows;
	
	$result = array();
        
        $conn = @mysql_connect('127.0.0.1','root','');
        if (!$conn) {
	die('Could not connect: ' . mysql_error());
                     }
        mysql_select_db('campost', $conn);
	
	$where = " numero_serie like '$numero_serie%' ";
	$rs = mysql_query("select count(*) from materiel where ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select*from  materiel where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>
