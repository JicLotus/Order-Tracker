<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id'];

	$fecha  = $_REQUEST['fecha'];
	
	$sql= "(select clientes.id, clientes.nombre, clientes.direccion, clientes.razon_social, clientes.telefono_movil, clientes.telefono_laboral, clientes.email, agendas.fecha from clientes, agendas where clientes.id = agendas.id_cliente and agendas.id_usuario = $vendedor";
	
	if ($fecha){
		
		 //Lo hago asi, porq mysql responde mas rapido a este tipo de consulta, la alternativa es mandar DATE(fecha) asi de una 
		 $sql.= " and agendas.dia="."'".$fecha."'"." order by agendas.orden asc";
	}		
		
	$sql.= ")";

	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	

	echo json_encode($datos);
?>
