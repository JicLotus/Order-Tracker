<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");
	
	
	$dt = "'".date('Y-m-d') ."'";
	
	$sql= "(select * from descuentos where date_format(descuentos.desde, '%Y-%m-%d') <= $dt and date_format(descuentos.hasta, '%Y-%m-%d') >= $dt )";
	
	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	echo json_encode($datos);
?>
