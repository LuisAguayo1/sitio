<?php

	if(!session_id()){
		session_start();
	}
	
	include_once('core/database.php');
	$database=new Database;
	$database->conectar();
	$database->query("SET NAMES utf8");

	include_once('core/sesion.php');
	$sesion=new Sesion;
	$permiso=$sesion->validar($database);

	include_once('core/content.php');
	$content=new ContentManager;
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1">
		
		<title>SISTEMA</title>
		
		<link rel="canonical" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>" />
		<link rel="stylesheet" type="text/css" href="estilo.css" />
		<link rel="stylesheet" type="text/css" href="jquery_ui.css" />
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery_ui.js"></script>
		<script type="text/javascript" src="js/sistema.js"></script>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	</head>
	
	<body>
		<div id="sitio">
			<div id="header">
				<img src="../imagenes/logo.png" width="200px" alt="" />
			</div>
			<?php echo $content->mostrar($permiso,$database); ?>
		</div>
	</body>
</html>