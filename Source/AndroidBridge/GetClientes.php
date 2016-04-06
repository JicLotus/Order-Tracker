<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id'];

	$fecha  = $_REQUEST['fecha'];
	
	$sql= "Select * from clientes where id in (Select id_cliente from agendas where id_usuario=$vendedor";
	
	if ($fecha){
		 $y= date("Y", strtotime($fecha));
		 $d= date("d", strtotime($fecha));
		 $m= date("m", strtotime($fecha));
		 //Lo hago asi, porq mysql responde mas rapido a este tipo de consulta, la alternativa es mandar DATE(fecha) asi de una 
		 $sql.= " and YEAR(fecha)=" . $y . " AND MONTH(fecha)=" . $m .  " AND DAY(fecha)=" . $d;
	}		
		
	$sql.= " )";

	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	echo json_encode($datos);
?>
