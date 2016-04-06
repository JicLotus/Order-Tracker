<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");
	
	$vendedor = $_REQUEST['id_vendedor'];
	$cliente  = $_REQUEST['id_cliente'];
	
	$sql= "Select * from pedidos where id_usuario=$vendedor and id_cliente=$cliente";
	
	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	echo json_encode($datos);
?>