<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id_usuario'];

	$sql= "select distinct * from notificaciones
			where id_usuario = $vendedor";


	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	$sql = "delete from notificaciones
			where id_usuario = $vendedor"; 
	
	mysql_query($sql, $con);

	echo json_encode($datos);
?>
