<html>
    <head>
        <title>Order Tracker</title>
        <link rel="stylesheet" type="text/css" href="/css/inmuebles360.css">
        



        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r69/three.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    	<!--JS FileInput plugin	-->
    	<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    	<script src="js/jquery-2.1.4.min.js"></script>
    	<script src="js/fileInput/fileinput.min.js" type="text/javascript"></script>
    	<!--JS FileInput plugin	-->
        <script type="text/javascript">
            $(document).ready(function(data) {
                $("#registerButton").click(function(event) {
                    $("#login").modal("hide");
                });

                $("#loginButton").click(function(event) {
                    $("#register").modal("hide");
                });
                $("#registerRole").change(function(event) {
                    var role = $(this).val();
                    if(role != <?php echo UserRoleDefinitions::constant("INDIVIDUAL_USER"); ?>) {
                        $("#registerPhone").show();
                        $("#registerCuit").show();
                    }
                    else {
                        $("#registerPhone").hide();
                        $("#registerCuit").hide();
                    }
                });
            });
        </script>
        @yield("head")
    </head>
    <body id="{{$page}}">
        <header id="header">
            <div class="container">
			<div class="btn-group btn-group-justified">

                    
                    <a href="{{app()->make('urls')->getUrlProductos()}}" class="btn btn-primary">Productos</a>
                    <a href="{{app()->make('urls')->getUrlClientes()}}" class="btn btn-primary">Clientes</a>
                    <a href="{{app()->make('urls')->getUrlUsuarios()}}" class="btn btn-primary">Usuarios</a>
                    <a href="{{app()->make('urls')->getUrlPedidos()}}" class="btn btn-primary">Pedidos</a>
                    <a href="{{app()->make('urls')->getUrlAgendas()}}" class="btn btn-primary">Agendas</a>
                    <a href="{{app()->make('urls')->getUrlDescuentos()}}" class="btn btn-primary">Descuentos</a>
                                        
                    
                </div>
            </div>
        </header>
        @yield("content")
        
    </body>
</html>
