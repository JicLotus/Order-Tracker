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
    <section id="search-section">
 <a  href="{{app()->make('urls')->getUrlAgendas()}}" class="btn btn-primary btn-block"><h4><b>AGENDAS</b></h4></a>

		
<form action="{{app()->make('urls')->getUrlAgenda()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
		<h4>
			
			<div class="form-group">
				<label class="control-label col-sm-2" for="ListaVendedores">Lista de vendedores:</label>
				  <div class="col-sm-8">
					<select id="idVende" name="idVendedor">
						@foreach($vendedores as $vendedor)
						<option value= {{$vendedor->id}} > {{$vendedor->nombre}}</option>  
						@endforeach
												  
					</select>
				  </div>
			  </div>
			
			<div class="form-group">
			
				<label class="control-label col-sm-2" for="Día">Fecha:</label>
					<div class="col-sm-1">
						<input type="text" id="datepicker" name = "datepicker" value= "{{$hoy}}">
					</div>
			</div>
			
		<div class="form-group">	
			
			<button type="submit" class="col-sm-2 col-sm-offset-3 btn btn-primary">Buscar</button>
		</div>	
	 
		<h4>
</form>

<hr width=75%"/>


	
	<a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar Nueva Agenda</a>     
       
    </section>

@endsection

