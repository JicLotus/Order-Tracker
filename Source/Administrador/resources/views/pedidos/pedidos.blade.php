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
    
                @foreach($pedidos as $pedido)
                        <p>
                            <div class="well">

                                <div class="control-group">
                                    <span class="control-label dimgray">Producto: {{$pedido->nombreProducto}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cantidad: {{$pedido->id}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Precio: {{$pedido->precio}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Usuario: {{$pedido->nombreUsuario}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cliente: {{$pedido->id_cliente}}</span>
                                </div>
                                
                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

