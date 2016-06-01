
<?php

	
	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");

	//Selecciona todos los productos

			
	$sql= "	select marcas.nombre as marca, categorias.nombre as categoria, 
				   productos.id, productos.nombre, productos.codigo, productos.imagen, productos.caracteristicas,
				   productos.stock, productos.estado, productos.precio, productos.precio as precio_final 
				   from productos
				   left join marcas on productos.marca = marcas.id 
				   left join categorias on productos.categoria = categorias.id 
				   where stock>0
				   and eliminado=0";

		
	$rs = mysql_query($sql,$con);
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	echo json_encode($datos);
	
?>
