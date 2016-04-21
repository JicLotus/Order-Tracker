@extends("layouts.base")

@section("head")

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
 <a  href="{{app()->make('urls')->getUrlAgendas()}}" class="btn btn-primary btn-block">AGENDAS</a>
		
<h4><div class= "form">		
<form action="{{app()->make('urls')->getUrlAgenda()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
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
</form>
</div></h4>
<hr width=75%"/>
	
	<div class="form-group">

	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse1"><b> Lunes</b> </a>
				</h4>
			</div>
		<div id="collapse1" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == "Lunes"){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden De Visita: {{$agenda->orden}}</span>
                                </div>                              
                              
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse2"><b> Martes</b> </a>
				</h4>
			</div>
		<div id="collapse2" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == "Martes"){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden De Visita: {{$agenda->orden}}</span>
                                </div>                              
                              
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	
	
	
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse3"><b> Miércoles</b> </a>
				</h4>
			</div>
		<div id="collapse3" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == "Miercoles"){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden De Visita: {{$agenda->orden}}</span>
                                </div>
                             
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	
	
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse4"><b> Jueves</b></a>
				</h4>
			</div>
		<div id="collapse4" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == "Jueves"){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden De Visita: {{$agenda->orden}}</span>
                                </div>
                             
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	
	
	
		
	
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse5"><b> Viernes</b></a>
				</h4>
			</div>
		<div id="collapse5" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
					<div>
			
	                @foreach($agendas as $agenda)
					<?php If ($agenda->dia == "Viernes"){?> 
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Dirección: {{$agenda->direccion}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Orden De Visita: {{$agenda->orden}}</span>
                                </div>
                             
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                <?php } ?>
                @endforeach
               </div>
               </li>
			</ul>
		</div>
	</div>	
	
	<hr width=75%"/>
	
	<a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar Nueva Agenda</a> 
    <a href="{{app()->make('urls')->getUrlAsignarHorarios($nombre[0]->id)}}" class="btn btn-primary">Reasignar Recorrido</a>     
	</div>	
	
	
	
    </section>

@endsection

