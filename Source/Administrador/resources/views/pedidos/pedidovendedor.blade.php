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
		
		<a  href="{{app()->make('urls')->getUrlPedidos()}}" class="btn btn-primary btn-block"><h4><b>PEDIDOS</b></h4></a>

		
<h4><form action="{{app()->make('urls')->getUrlPedidoVendedor()}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<h4><label class="control-label col-sm-2" for="ListaClientes">Lista de clientes:</label></h4>
			  <div class="col-sm-8">
				<select id="idCliente" name="idCliente" onchange= "this.form.submit()" >
					@foreach($clientes as $cliente)
					<option value= {{$cliente->id}} > {{$cliente->nombre}}</option>  
					@endforeach
					 <option selected = "selected" value = {{$nombre[0]->id}} >{{$nombre[0]->nombre}}   </option>                   
				</select>
			  </div> 
		</div>	
</form></h4>

<hr width=75%"/>

	<div class="form-group">

	</div>	
              
	@foreach($bultos as $bulto)
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#{{$bulto->id_compra}}"> <b> Número	 de identifición: {{$bulto->id_compra}}</b> </a>
				</h4>
			</div>
		<div id="{{$bulto->id_compra}}" class="panel-collapse collapse">
			<ul class="list-group">
				<li class="list-group-item"> 
				<div>
					
					<form action="{{app()->make('urls')->getUrlEditarPedido($bulto->id_compra)}}" method="GET" class="form-horizontal"   enctype="multipart/form-data">
								{{ csrf_field() }}
									<div class="form-group">
										<label class="control-label" for="Estado">Estado del pedido:</label>
											<select id="estado" name="estado" onchange= "this.form.submit()" >
												
												<option value="en_proceso" <?php If ($bulto->estado == "pendiente"){?> selected = 'selected'<?php } ?>>Pendiente</option>
												<option value="en_proceso" <?php If ($bulto->estado == "en_proceso"){?> selected = 'selected'<?php } ?>>En Proceso de Armado</option>
												<option value="en_proceso" <?php If ($bulto->estado == "empaquetado"){?> selected = 'selected'<?php } ?>>Empaquetado</option>												
												<option value="entregado"  <?php If ($bulto->estado == "entregado"){?> selected = 'selected'<?php } ?> >Entregado</option>
												<option value="cancelado" <?php If ($bulto->estado == "cancelado"){?> selected = 'selected'<?php } ?>>Cancelado</option>
            
											</select>
									</div>	
									<input type="hidden" name="idCliente" value={{$nombre[0]->id}}>
									
					</form>
					
				 <?php
				$cantidadfinal = 0;
                foreach($pedidos as $pedido){
                If ($pedido->id_compra == $bulto->id_compra){?>   
                        <p>
							 <div class="well">
								
							    <div class="control-group">
                                    <span class="control-label dimgray">Producto: {{$pedido->nombreProducto}}</span>
                                </div>
                                
								<div class="control-group">
                                    <span class="control-label dimgray">Código: {{$pedido->codigo}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Cantidad: {{$pedido->cantidad}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Precio: ${{$pedido->precio}}</span>
                                </div>
                                                  
                            </div>
                        </p>
                 <?php			
                                $cantidadfinal +=  $pedido->cantidad * $pedido->precio;     
					} 
                }
                
				?>
				
				<label class="control-label" for="Estado">Importe Total: ${{$cantidadfinal}}</label>
               </div>
               </li>
			</ul>
		</div>
	</div>	
    @endforeach
    
     <?php If (count($bultos) == 0){?>   
		<div class="alert alert-danger">
			<strong>No existen compras! </strong>Revise el nombre del cliente seleccionado.
		</div>
	  <?php } ?>
    </section>

@endsection

