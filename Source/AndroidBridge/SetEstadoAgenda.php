<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");

	mysql_query("SET NAMES 'utf8'");

	mysql_select_db("orderTracker");

	$id = $_REQUEST['id_agenda'];
	$estado  = $_REQUEST['estado'];
	
	$sql = "update agendas set estado_visita="."'".$estado."'"." where agendas.id ="."'". $id."'";

	echo $sql;

	$rs = mysql_query($sql,$con);

	
?>
