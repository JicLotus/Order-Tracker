@extends("layouts.base") 

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Editar Producto</strong></h2>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
      
        <div class="form-group">
          <label class="control-label col-sm-2" for="nombre">Nombre</label>
          <div class="col-sm-8">
            <input type="nombre" class="form-control" name="name" value="">
          </div>
        </div>
        
    </form>
  </div>
</div>
</div>

@endsection