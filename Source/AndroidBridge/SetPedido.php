<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");
	
	$vendedor = $_REQUEST['id_usuario'];
	$cliente  = $_REQUEST['id_cliente'];
	$producto  = $_REQUEST['id_producto'];
	$cantidad  = $_REQUEST['cant'];
	$precio  = $_REQUEST['precio'];	
	
	$sql= "Insert into pedidos (id_usuario,id_cliente,id_producto,cantidad,precio,estado) values ($vendedor,$cliente,$producto,$cantidad,$precio,'en_proceso')";

	$rs = mysql_query($sql,$con);

	$sql2= "Update productos set stock= (stock - $cantidad)  where id = $producto";

	$rs = mysql_query($sql2,$con);
	
?>
