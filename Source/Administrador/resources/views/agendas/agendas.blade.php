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
					
					<a href="{{app()->make('urls')->getUrlAgregarAgenda()}}" class="btn btn-primary">Agregar agenda</a>
					        
                @foreach($agendas as $agenda)
                        <p>
                            <div class="well">
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre vendedor: {{$agenda->nombreVendedor}}</span>
                                </div>
                                
                                <div class="control-group">
                                    <span class="control-label dimgray">Nombre cliente: {{$agenda->nombreCliente}}</span>
                                </div>

                                <div class="control-group">
                                    <span class="control-label dimgray">Fecha/Hora: {{$agenda->fecha}}</span>
                                </div>

                            </div>
                        </p>
                @endforeach
        
    </section>

@endsection

