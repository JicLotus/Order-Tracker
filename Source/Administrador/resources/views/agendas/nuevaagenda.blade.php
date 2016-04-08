@extends("layouts.base") 

@section("content")

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $("#timePicker").timePicker();
  });
  </script>
</head>
<body>
 
 
<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Nuevo Agenda</strong></h2>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

  </div>
</div>

<div  class="row">
  <div class="col-md-12">
    
<form action="guardarnuevaagenda" method="POST" class="form-horizontal"   enctype="multipart/form-data">
	{{ csrf_field() }}

	<select onclick="reload();" multiple id="selectVendedor">
	@foreach($vendedores as $vendedor)
		<option>{{$vendedor->id}}){{$vendedor->nombre}}</option>  
	@endforeach 
	</select>
	<input type="hidden" id="idVendedorr" name="idVendedor" >
  
  
    <select onclick="reload();" multiple id="selectCliente">
	@foreach($clientes as $cliente)   
		<option>{{$cliente->id}}){{$cliente->nombre}}</option>
	@endforeach
	</select> 
	<input type="hidden" id="idclientee" name="idCliente" >  


	<div class="form-group">
		<label class="control-label col-sm-2" for="Día">Día</label>
          <div class="col-sm-8">
			<input type="text" id="datepicker" name = "datepicker">
		</div>
	</div>	

	<div class="form-group">
		<label class="control-label col-sm-2" for="Hora">Hora</label>
          <div class="col-sm-8">
			<input type="text" name="hora" value="07:00" />
		  </div>
		  
    </div>	

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="col-sm-offset-1 btn btn-default">Publicar</button>
            </div>
        </div>
       
	
</form>
           
  </div>
</div>

 
 
</body>
</html>

<script type="text/javascript">
function reload() {
	var e = document.getElementById("selectVendedor");
	var idvendedor = e.options[e.selectedIndex].value.split(")")[0];
	document.getElementById('idVendedorr').value = idvendedor;
	
	var ee = document.getElementById("selectCliente");
	var idcliente = ee.options[ee.selectedIndex].value.split(")")[0];
	var elemento= document.getElementById('idclientee');
	elemento.value = idcliente;
}
</script>

</div>

@endsection
