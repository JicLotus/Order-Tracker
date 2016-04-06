<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");

	$id_producto = $_REQUEST['id_producto'];

	$sql= "select id_mapeo from imagenes where id_producto='$id_producto'";

		
	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}
	
	echo json_encode($datos);
?>
