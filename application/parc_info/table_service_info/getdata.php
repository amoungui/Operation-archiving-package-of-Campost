<?php     
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        
	//$firstname = isset($_POST['firstname']);    // ? mysql_real_escape_string($_POST['firstname']) : '';
	//$lastname = isset($_POST['lastname']);      // ? mysql_real_escape_string($_POST['lastname']) : '';
	
        if (!empty ($_POST['technicien']) ) {
           // $code_bp = isset($_POST['code_bp']);
            $technicien = isset($_POST['technicien']);
        } else {
           // $code_bp = isset($_POST['code_bp']);
            $technicien = isset($_POST['technicien']);
        }
            
	$offset = ($page-1)*$rows;
	
	$result = array();
        
        $conn = @mysql_connect('127.0.0.1','root','');
        if (!$conn) {
	die('Could not connect: ' . mysql_error());
                     }
        mysql_select_db('campost', $conn);
	
	$where = "technicien like '$technicien%'";
	$rs = mysql_query("select count(*) from servic_info where ".$where);
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select * from servic_info where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>