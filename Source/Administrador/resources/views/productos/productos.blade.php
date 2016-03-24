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

        <div id="search-section-footer">
            
        </div>
        
    </section>

@endsection

