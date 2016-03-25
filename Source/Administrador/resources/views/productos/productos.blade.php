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
					<a href="" class="btn btn-primary">Agregar</a>            
                @foreach($productos as $producto)
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre: {{$producto->nombre}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Codigo: {{$producto->codigo}}</span>
                                </div>
											<a href="{{app()->make('urls')->getUrlEditarProducto($producto->id)}}" class="btn btn-primary">Editar</a>                                
                                
                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

