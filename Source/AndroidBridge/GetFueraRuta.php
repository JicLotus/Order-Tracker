<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id'];

	$fecha  = $_REQUEST['fecha'];

	$dt = new DateTime();
		
	// set object to Monday
	$dt->setISODate($dt->format('o'), $dt->format('W'));

	// get all 1day periods from Monday to Friday
	$periods = new DatePeriod($dt, new DateInterval('P1D'), 4);
		
	$days = iterator_to_array($periods);
	// convert DatePeriod object to array
	$lunes = "'".$days[0]->format ('Y-m-d')."'";
	$viernes = "'".$days[4]->format ('Y-m-d')."'";	
	
	$sql= "select distinct(id_cliente), nombre, direccion from agendas, clientes where agendas.id_usuario = $vendedor and agendas.id_cliente=clientes.id
		order by agendas.orden asc";
	
	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	

	echo json_encode($datos);
?>
