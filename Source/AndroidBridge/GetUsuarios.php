<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");

	$arg_list = func_get_args();
	$nombre = $_REQUEST['nombre'];
	$contrasenia = $_REQUEST['pass'];
		echo $arg_list;
		
	//Privilegio = 2 es un vendedor
	
	$sql= "Select * from usuarios where nombre='$nombre' and password='$contrasenia' and privilegio=2 limit 1";

		
	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}
	
	echo json_encode($datos);
?>