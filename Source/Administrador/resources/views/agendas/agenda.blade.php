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
		
<form action="agenda" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="control-label col-sm-2" for="ListaVendedores">Lista de vendedores:</label>
			  <div class="col-sm-8">
				<select id="idVende" name="idVendedor" selected = "selected" >
					@foreach($vendedores as $vendedor)
					<option>{{$vendedor->id}}</option>  
					@endforeach
					                          
					<input type="submit" value= "Ver" />
				</select>
			  </div> 
		</div>	
</form>

<hr width=75%"/>
	
	<div class="form-group">
		<label class="control-label col-sm-2" for="VendedorSeleccionado">Vendedor Seleccionado:</label>
        <div class="control-group">
              <span class="control-label dimgray">{{$nombre[0]->nombre}}</span>
         </div>
		  
    </div>	
	
					        
                @foreach($agendas as $agenda)
                        <p>
                            <div class="well2">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: 	{{$agenda->nombreCliente}}</span>
                                </div>

                                <div class="control-group">
                                    <span class="control-label dimgray">Fecha/Hora: {{$agenda->fecha}}</span>
                                </div>

                            </div>
                        </p>
                @endforeach
        <a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar Nueva Agenda</a>     
    
    </section>

@endsection

