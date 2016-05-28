<?php

	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");

	$dt = date("Y-m-d");
	$dt = "'".$dt."'";	

	$sql= "(select marcas.nombre as marca, categorias.nombre as categoria, porcentaje, 
				   id_producto, cantidad, date_format(desde,'%Y-%m-%d') as desde, date_format(hasta,'%Y-%m-%d') as hasta 
				   from descuentos
				   left join marcas on descuentos.id_marca = marcas.id 
				   left join categorias on descuentos.id_categoria = categorias.id 
				   where descuentos.desde <= $dt and descuentos.hasta >= $dt
				   order by descuentos.cantidad desc
			)";
		

	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	

	echo json_encode($datos);
?>
