<?php
    require_once 'application/MyHeartMySQL.php';
    require_once 'application/indexController.php';
    require_once 'application/BureauPost.php';
    require_once 'application/agent.php';
    require_once 'application/materiel.php';
    require_once 'application/intervention.php';
    
    $action = new indexController();
    $action->initProject();

?>
<!DOCTYPE html>
<html>
    <head>
            <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="application/js/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="application/js/icon.css">
	<link rel="stylesheet" type="text/css" href="application/js/demo.css">
        <link rel="stylesheet" type="text/css" href="application/js/style.css">
            <script type="text/javascript" src="application/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="application/js/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="application/js/jqueryui.js"></script>
        
    </head>
    
    <body>
        
           <div class="entete">
             <?php include 'application/vues/template4/entete.php';  ?>
        </div>
        
        <a href=""></a>
        <div class="menu_index">
            <?php// include 'application/vues/template4/menu.php';  ?>
        </div>
        
        <div class="corps">
            <?php $action->renderAction(); ?>
        </div>
        
        
        <div class="pieds">
            <?php include 'application/vues/template4/pieds.php'; ?>
        </div>
    </body>
</html>

