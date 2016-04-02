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
					<a href="{{app()->make('urls')->getUrlAgregarProducto()}}" class="btn btn-primary">Agregar</a>            
                @foreach($productos as $producto)
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre: {{$producto->nombre}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Codigo: {{$producto->codigo}}</span>
                                </div>

                                <div class="control-group">
									 	<img src="data:image/png;base64, {{$producto->imagen_base64}}" alt="Pulpit Rock" style="width:150px;height:150px">
										
                                </div>

								<a href="{{app()->make('urls')->getUrlEditarProducto($producto->id)}}" class="btn btn-primary">Editar</a>                                


                                
                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

