<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");
	$vendedor = $_REQUEST['id'];

	//El JOSE:
	//Ya fue, no creo que nos hagan cargar DBS con muchos registros
	//de ultima optimizamos un poco esto y listo.
	$sql= "Select * from clientes where id in (Select id_cliente from agendas where id_usuario=$vendedor)";

	$rs = mysql_query($sql,$con);
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	echo json_encode($datos);
	
?>
