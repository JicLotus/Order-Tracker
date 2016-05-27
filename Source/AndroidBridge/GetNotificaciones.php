<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id_usuario'];
	
	$fecha_hoy = date("Y-m-d");
	$fecha_hoy = "'".$fecha_hoy."'";

	$sql= "(select distinct * from notificaciones
			where id_usuario = $vendedor
			and date_format(desde, '%Y-%m-%d') <= $fecha_hoy
			and date_format(hasta, '%Y-%m-%d') >= $fecha_hoy)
			union
			(select distinct * from notificaciones
			where id_usuario = $vendedor
			and tipo_notificacion = 'AGENDA')";


	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	$sql = "delete from notificaciones
			where id_usuario = $vendedor
			and date_format(desde, '%Y-%m-%d') <= $fecha_hoy
			and date_format(hasta, '%Y-%m-%d') >= $fecha_hoy"; 	
	mysql_query($sql, $con);


	$sql = "delete from notificaciones
			where id_usuario = $vendedor
			and tipo_notificacion = 'AGENDA'"; 	
	mysql_query($sql, $con);

	echo json_encode($datos);
?>
