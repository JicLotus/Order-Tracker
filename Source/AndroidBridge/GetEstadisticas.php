<?php


	$con = mysql_connect("localhost", "root","123456") or die("Sin conexion");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("orderTracker");

	$vendedor = $_REQUEST['id_usuario'];

	$fecha_hoy = date("Y-m-d");
	$fecha_hoy = "'".$fecha_hoy."'";
//	$fecha_hoy = "'2016-05-09'";

	//obtengo cantidad de visitados hoy
	$rs = mysql_query("Select count(*) as cantidad from agendas where id_usuario = $vendedor
						and date_format(agendas.fecha, '%Y-%m-%d') = $fecha_hoy
						and agendas.estado_visita = 'Visitado'");
	$row = mysql_fetch_assoc($rs);
	$cantidadVisitadosHoy = $row['cantidad'];

   //obtengo cantidad de visitados fuera de ruta, es decir, los que no estaban programados para ese dia pero fueron
   //visitados en la semana
   

						
	$rs = mysql_query("Select count(*) as cantidad from agendas where date_format(agendas.fecha, '%Y-%m-%d') <> $fecha_hoy
						and agendas.estado_visita = 'Visitado'
						and agendas.id_usuario = $vendedor
						and date_format(agendas.fecha_visitado, '%Y-%m-%d') = $fecha_hoy");
	$row = mysql_fetch_assoc($rs);

	$cantidadVisitadosFueraDeRuta = $row['cantidad'];


	//ahora obtengo la cantidad de clientes que tengo que visitar hoy
	
	$rs = mysql_query("Select count(*) as cantidad from agendas where 
						id_usuario = $vendedor and
						date_format(agendas.fecha, '%Y-%m-%d') = $fecha_hoy");
	$row = mysql_fetch_assoc($rs);

	$cantidadAVisitarHoy = $row['cantidad'];
   

    //ahora obtengo la cantidad total vendida HOY
    $rs = mysql_query("select IFNULL(sum(precio_final*cantidad), 0) as vendido from compras, pedidos 
						where compras.id_usuario = $vendedor 
						and pedidos.id_compra = compras.id_compra 
						and date_format(compras.fecha, '%Y-%m-%d') = $fecha_hoy
						and compras.id_cliente in(
								select id_cliente from agendas
								where estado_visita = 'Visitado'
								and date_format(agendas.fecha_visitado, '%Y-%m-%d') = $fecha_hoy
								and agendas.id_usuario = $vendedor
								and date_format(agendas.fecha, '%Y-%m-%d') = date_format(agendas.fecha_visitado, '%Y-%m-%d')						
						)");
						

	$row = mysql_fetch_assoc($rs);
	$cantidadVendidaHoy = $row['vendido'];


    //ahora obtengo la cantidad total vendida fuera de ruta
    $rs = mysql_query("select IFNULL(sum(precio_final*cantidad), 0) as vendido from compras, pedidos 
						where compras.id_usuario = $vendedor 
						and pedidos.id_compra = compras.id_compra 
						and date_format(compras.fecha, '%Y-%m-%d') = $fecha_hoy
						and compras.id_cliente in (select id_cliente from agendas
							where estado_visita = 'Visitado'
							and date_format(agendas.fecha_visitado, '%Y-%m-%d') = $fecha_hoy
							and agendas.id_usuario = $vendedor
							and date_format(agendas.fecha, '%Y-%m-%d') <> $fecha_hoy
							)");
							
	$row = mysql_fetch_assoc($rs);
	$cantidadFueraDeRuta = $row['vendido'];



    $sql = "INSERT INTO estadisticas (id_usuario, visitados_hoy, a_visitar, fuera_ruta, vendido_fuera_ruta, vendido_clientes) 
			VALUES($vendedor, $cantidadVisitadosHoy, $cantidadAVisitarHoy, $cantidadVisitadosFueraDeRuta,
			$cantidadFueraDeRuta, $cantidadVendidaHoy ) ON DUPLICATE KEY UPDATE   
			visitados_hoy = $cantidadVisitadosHoy,
			a_visitar = $cantidadAVisitarHoy,
			fuera_ruta= $cantidadVisitadosFueraDeRuta,
			vendido_fuera_ruta = $cantidadFueraDeRuta,
			vendido_clientes = $cantidadVendidaHoy";

	mysql_query($sql);


	$sql = "Select * from estadisticas where id_usuario = $vendedor";

	$rs = mysql_query($sql,$con);
	
	while($row=mysql_fetch_object($rs)){
		$datos[] = $row;
	}

	

	echo json_encode($datos);

		
?>
