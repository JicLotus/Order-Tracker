@extends("layouts.base")

@section("head")



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

<hr width=75%"/>
	
	<div class="form-group">

	<a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar Nueva Agenda</a> 
    <a href="{{app()->make('urls')->getUrlAsignarHorarios($nombre[0]->id)}}" class="btn btn-primary">Reasignar Recorrido</a>     
	</div>	
		<div>
			<label class="control-label col-sm-2" for="VendedorSeleccionado">Vendedor Seleccionado:</label>
			<div class="control-group">
			
              <span class="control-label dimgray">{{$nombre[0]->nombre}}</span>
			</div>
		</div>
                @foreach($agendas as $agenda)
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

                                <div class="control-group">
                                    <span class="control-label dimgray">Día: {{$agenda->dia}}</span>
                                </div>
                              
                              
								<a href="{{app()->make('urls')->getUrlEliminarAgenda($agenda->agendaId, $nombre[0]->id)}}" class="btn btn-primary">Eliminar</a>  

                            </div>
                        </p>
                @endforeach
            </section>

@endsection

