<?php

	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");

	mysql_select_db("orderTracker");
		
		
	$txt= file_get_contents('php://input');
	
	$result = json_decode($txt);
	var_dump($result);
	
	$productos = $result->pedidos;
	$vendedor = $result->id_usuario;
	$cliente  = $result->id_cliente;
	
	$dt = new DateTime();
	$fecha = $dt->format('Y-m-d H:i:s');
//	$fecha.= " 00:00:00";
	
	$sql0 = "Insert into compras (id_cliente, id_usuario, fecha) values ($cliente, $vendedor, '$fecha');";
	$rs = mysql_query($sql0,$con);
	$id_compra = mysql_insert_id();
	
		
	foreach($productos as $producto){
		
		$id_producto = $producto->id;
		$cantidad = $producto->cantidad;
		$precio = $producto->precio;
		$precio_final = $producto->precio_final;
		
		$sql1= "Insert into pedidos (id_producto, cantidad,precio, precio_final, id_compra) 
							 values ($id_producto,$cantidad,$precio,$precio_final,$id_compra);";

		$rs = mysql_query($sql1,$con);

		$sql2= "Update productos set stock = (stock - $cantidad)  where id = $id_producto";

		$rs = mysql_query($sql2,$con);
	}
	
?>
