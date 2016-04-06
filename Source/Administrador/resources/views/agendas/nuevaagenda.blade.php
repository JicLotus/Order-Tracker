@extends("layouts.base") 

@section("content")




<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Nuevo Agenda</strong></h2>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

  </div>
</div>

<div class="row">
  <div class="col-md-12">
    

    	

<form action="guardarnuevaagenda" method="POST" class="form-horizontal"   enctype="multipart/form-data">
	{{ csrf_field() }}
	
  <select multiple id="selectVendedor">
@foreach($vendedores as $vendedor)
   <option>{{$vendedor->id}}){{$vendedor->nombre}}</option>  
 @endforeach 
  </select>
  
  
  <input type="hidden" id="idVendedorr" name="idVendedor" >
  
  
    <select multiple id="selectCliente">
	@foreach($clientes as $cliente)   
   <option>{{$cliente->id}}){{$cliente->nombre}}</option>
   @endforeach
  </select>  

<input type="hidden" id="idclientee" name="idCliente" >  
  
  
<script type="text/javascript">
	var e = document.getElementById("selectVendedor");
	var idvendedor = e.options[e.selectedIndex].value.split(")")[0];
	document.getElementById('idVendedorr').value = idvendedor;
	
	var ee = document.getElementById("selectCliente");
	var idcliente = ee.options[ee.selectedIndex].value.split(")")[0];
	document.getElementById('idclientee').value = idcliente;
</script>     

    	
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>
                <button type="submit" class="col-sm-offset-1 btn btn-default">Publicar</button>
            </div>
        </div>
	
</form>
       
       
    
        
                              
  </div>
</div>
</div>

@endsection
