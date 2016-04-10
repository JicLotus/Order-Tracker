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
					<a href="{{app()->make('urls')->getUrlAgregarUsuario()}}" class="btn btn-primary">Agregar</a>            
                @foreach($usuarios as $usuario)
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre: {{$usuario->nombre}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Email: {{$usuario->email}}</span>
                                </div>
                                
                                <div class="control-group">
									<span class="control-label dimgray">Privilegio: {{$usuario->privilegio}}</span>
                                </div>
									 	
								

								<a href="{{app()->make('urls')->getUrlEditarUsuario($usuario->id)}}" class="btn btn-primary">Editar</a>                                


                                
                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

