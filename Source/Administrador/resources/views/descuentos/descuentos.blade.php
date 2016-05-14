@extends("layouts.base")

@section("head")
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $("#datepicker").datepicker({ 
		minDate: -20,
		maxDate: "+1M +10D",
		dateFormat: "dd-mm-yy",
		altFormat: "ddmmyy",
		altField: "#alt-date"
	});
  });
  </script>
  
  
</head>


  <script type="text/javascript">
    $(document).ready(function(){
      $(document).keypress(
          function(event){
            if (event.which == '13') {
              event.preventDefault();
            }
      });
    });
  </script>

@endsection

@section("content")

    
@section("content")
 
    <section id="search-section">
			<a  href="{{app()->make('urls')->getUrlDescuentos()}}" class="btn btn-primary btn-block"><h4><b>DESCUENTOS</b></h4></a>

		
<h4><form action="{{app()->make('urls')->getUrlFiltroDescuento()}}" method="POST" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group">
					<div class="row">	

						<label class="col-sm-1" ></label>
						<label class="control-label col-sm-1" >Categoría</label>
							<select class = "col-sm-1" id="categoria" name="categoria">
								<option value =  0>Todas las Categorias</option>
								@foreach($categorias as $categoria)
									<option value = {{$categoria->id}}>{{$categoria->nombre}}</option>  
								@endforeach 
							</select>

						<label class="control-label col-sm-1" >Marca</label>
							<select class="col-sm-1" name="idMarca" >
								<option value = 0>Todas las Marcas</option>
								@foreach($marcas as $marca)   
								<option value = {{$marca->id}}>{{$marca->nombre}}</option>
								@endforeach
							</select> 

						<label class="control-label col-sm-1" >Cantidad</label>

						<select class="col-sm-1" id="cantidad" name="cantidad" >
							<option value = 0 >Todas</option>
							 
							<option value = 10 > Más de 10 iguales</option>
							
							<option value = 20 > Más de 20 iguales</option>
							
							<option value = 30 > Más de 30 iguales</option>

						</select> 

						<label class="control-label col-sm-1" >Fecha</label>
						
						<input class="col-sm-1" type="text" id="datepicker" name = "datepicker" value= "Todas"> 
						
					</div>

					
					<div class="row">	
						
						<button type="submit" class="col-sm-offset-8 btn btn-primary">Buscar</button>
						<a href="{{app()->make('urls')->getUrlNuevoDescuento()}}" class="btn btn-primary">Agregar Nuevo Descuento</a> 
						
					</div>
		</div>	

</form></h4>


<hr width=75%"/>

<div class="container">
  <h2>Descuentos</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descripción</th>
        <th>Descuento</th>
        <th>Desde</th>
        <th>Hasta</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
		
	@foreach($descuentos as $descuento)  
	<tr>
	<td>{{$descuento->id}}</td>
	
	<td>

		<script language="JavaScript">
		function ponerTexto(idMarca,idCategoria,cantidad)	{
			if (idMarca != 0)
				document.write("Descuento de marca para ");
			else if (idCategoria != 0)
				document.write("Descuento de categoria para ");
			else if (cantidad != 0)
				document.write("Descuento de cantidad para " + cantidad);
				
		}
		
		ponerTexto({{$descuento->id_marca}},{{$descuento->id_categoria}},{{$descuento->cantidad}});
		
		
		</script>
		{{$descuento->categoria}}
		{{$descuento->marca}}
	</td>
	
	<td>{{$descuento->porcentaje*100}}%</td>
	<td><time datetime="d">{{$descuento->desde}}</time></td>
	<td>{{$descuento->hasta}}</td>
	</tr>
	@endforeach
	
    </tbody>
  </table>
</div>

    
     <?php If (count($descuentos) == 0){?>   
		<div class="alert alert-danger">
			<strong>No existen descuentos! </strong>Revise los filtros seleccionados.
		</div>
	  <?php } ?>
    </section>
	
      </section>
@endsection

