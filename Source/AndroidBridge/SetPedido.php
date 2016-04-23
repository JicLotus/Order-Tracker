<?php
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_select_db("orderTracker");
	
	$stringproductos = $_REQUEST['productos'];
	
	$vendedor = $_REQUEST['id_usuario'];
	$cliente  = $_REQUEST['id_cliente'];
	$dt = new DateTime();
	$fecha = $dt->format('Y-m-d');
	$fecha.= " 00:00:00";

	
	$sql0 = "Insert into compras (id_cliente, id_usuario, fecha) values ($cliente, $vendedor, '$fecha')";
	$rs = mysql_query($sql0,$con);
	$id_compra = mysql_insert_id();
	
	$productos = json_decode($stringproductos);
	
	foreach($productos as $producto){
		
		$id_producto = $producto['id'];
		$cantidad = $producto['cantidad'];
		$precio = $producto['precio'];
		
		$sql1= "Insert into pedidos (id_producto, cantidad,precio,id_compra) values ($id_producto,$cantidad,$precio,$id_compra)";

		$rs = mysql_query($sql1,$con);

		$sql2= "Update productos set stock = (stock - $cantidad)  where id = $id_producto";

		$rs = mysql_query($sql2,$con);
	}
	
?>
