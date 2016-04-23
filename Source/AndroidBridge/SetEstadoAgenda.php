<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");

	mysql_query("SET NAMES 'utf8'");

	mysql_select_db("orderTracker");

	$id = $_REQUEST['id'];
	$cliente = 	$_REQUEST['id_cliente'];
	$dia = $_REQUEST['dia'];
	$estado  = $_REQUEST['estado'];
	
	$sql = "update agendas set estado_visita="."'".$estado."'"." where id_usuario ="."'". $id."'"." and id_cliente="."'".$cliente."'"." and dia ="."'".$dia."'".";";
	echo $sql;
	$rs = mysql_query($sql,$con);

	
?>
