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
    $( "#datepicker" ).datepicker();
    $("#timePicker").timePicker();
  });
  </script>
</head>

<script type="text/javascript">
	function nombre_funcion(elDIV){
		var obj = document.getElementById(elDIV);
			if (obj.style.display == "none")  obj.style.display= "block";
			else obj.style.display= "none";
		}
</script>
  
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
		

<h4><form action="{{app()->make('urls')->getUrlAgenda()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label col-sm-2" for="ListaVendedores">Lista de vendedores:</label>
			  <div class="col-sm-8">
				<select id="idVende" name="idVendedor" onchange= "this.form.submit()" >
					@foreach($vendedores as $vendedor)
					<option value= {{$vendedor->id}} > {{$vendedor->nombre}}</option>  
					@endforeach
					 <option selected = "selected" value= {{$nombre[0]->id}} > {{$nombre[0]->nombre}}   </option>                   
				</select>
			  </div> 
		</div>	
		
		<div class="form-group">
			
			<label class="control-label col-sm-2" for="Día">Fecha:</label>
				<div class="col-sm-1">
					<input type="text" id="datepicker" name = "datepicker" value= "{{$hoy}}"  onchange= "this.form.submit()" >
				</div>
		</div>
</form></h4>

<hr width=75%"/>
	
	<div class="form-group">
	<?PHP
	// Inicializacion del Vector
	
	$dias[0] = "Lunes";
	$dias[1] = "Martes";
	$dias[2] = "Miercoles";
	$dias[3] = "Jueves";
	$dias[4] = "Viernes";

	?>

	@foreach($dias as $dia)
	
	<div class="panel-group">
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse{{$dia}}"><b> {{$dia}}</b> </a>
				</h4>
			</div>
		<div id="collapse{{$dia}}" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == $dia){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                    
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Estado: {{$agenda->estado_visita}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden de visita: {{$agenda->orden +1}}</span>
                                </div>              
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary btn-xs col-sm-offset-11">Eliminar</a>  
                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	@endforeach
	
	
	<hr width=75%"/>
	
	<a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar Nueva Agenda</a> 
    <a href="{{app()->make('urls')->getUrlAsignarHorarios($nombre[0]->id)}}" class="btn btn-primary">Reasignar Recorrido</a>     
	</div>	
	
	
	
    </section>

@endsection

