@extends("layouts.base")

@section("head")

  <script type="text/javascript">
    $(document).ready(function(data) {
      $("a[id^=pregunta], a[id^=respuesta]").click(function() {
        var question = $(this).attr('id');
        var numberOfQuestion = question.substr(question.length - 1);
        var realIndex;
        $("a[id^=pregunta]").each(function(index) {
          realIndex = index + 1;
          if (realIndex != numberOfQuestion) {
            $("#pregunta" + realIndex).removeClass("active");
            $("#respuesta" + realIndex).removeClass("active");
          }
          else {
            $("#pregunta" + realIndex).addClass("active");
            $("#respuesta" + realIndex).addClass("active");
          }
        });
      });
    });
  </script>
@endsection

@section("content")

<div class="container">
<div class="row row-head">
  <div class="col-md-12">
    <h2><strong>Ayuda</strong></h2>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Topicos
      </div>
      <div class="panel-body" style="padding: 0px;">
        <div class="list-group">
          <a id="pregunta1" href="#respuesta1" class="list-group-item active">
            <h4 class="list-group-item-heading">1. Agregar clientes</h4>
          </a>
          <a id="pregunta2" href="#respuesta2" class="list-group-item">
            <h4 class="list-group-item-heading">2. Agregar productos</h4>
          </a>
          <a id="pregunta3" href="#respuesta3" class="list-group-item">
            <h4 class="list-group-item-heading">3. Modificar agendas</h4>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="list-group">
          <a id="respuesta1" href="#respuesta1" class="list-group-item active">
            <h4 class="list-group-item-heading">1. Agregar clientes</h4>
            <p class="list-group-item-text"></p>
          </a>
          <a id="respuesta2" href="#respuesta2" class="list-group-item">
            <h4 class="list-group-item-heading">2. Agregar productos</h4>
            <p class="list-group-item-text">
          
          </p>
          </a>
          <a id="respuesta3" href="#respuesta3" class="list-group-item">
            <h4 class="list-group-item-heading">3. Modificar agendas</h4>
            <p class="list-group-item-text"></p>
          </a>
        </div>
  </div>
</div>
</div>
@endsection