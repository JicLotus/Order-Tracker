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
                <div class="row">
                    
                    <div class="col-md-3 col-sm-3">
                        
                        @if(app()->make("currentUser") != null)
                            <a href="{{app()->make('urls')->getUrlMyAccount()}}" class="btn btn-primary">Mi cuenta</a>
                            <a href="{{app()->make("urls")->getUrlLogout()}}" class="btn btn-default">Cerrar sesión</a>
                        @else
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#login">
                              Ingresar
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">
                              Registrarme
                            </button>
                        @endif
                        
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu">
                            @if(app()->make("currentUser") != null)
                                <li>
                                    <a href="{{app()->make('urls')->getUrlPublish()}}">Publicar</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{app()->make('urls')->getUrlHelp()}}">Ayuda</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        @yield("content")
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #f2f2f2;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="loginModal">Ingresar a mi cuenta</h4>
              </div>
              <div class="modal-body">
                <form method="post" action="/auth/login">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="E-mail"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="contraseña"></input>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-warning" type="submit">Iniciar sesión</button>
                        </div>
                    </div>
                    <input type="hidden" name="uri" value="{{Request::path()}}">
                </form>
              </div>
              <div class="modal-footer" style="text-align: center; background-color: rgb(192, 190, 190);">
                <h5 class="modal-title" id="loginModal">No estoy registrado</h5>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#register" id="registerButton">Registrarme</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #f2f2f2;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="registerModal">Nuevo usuario</h4>
              </div>
              <div class="modal-body">
                <form method="post" action="/auth/register">
                    {{csrf_field()}}
                    <div class="form-group">
                        {!! HtmlHelper::selectFromDicc(UserRoleDefinitions::map(), "id", "name", UserRoleDefinitions::constant('INDIVIDUAL_USER'), ["class" => "form-control", "name" => "role", "id" => "registerRole"], false) !!}
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Nombre"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="E-mail"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Contraseña"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="registerCuit" type="text" name="cuit" placeholder="CUIT" style="display: none;"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="registerPhone" type="text" name="phone" placeholder="Teléfono" style="display: none;"></input>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="mobile_phone" placeholder="Teléfono móvil"></input>
                    </div>
                    <input type="hidden" name="uri" value="{{Request::path()}}">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-warning">Registrarme</button>
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer" style="text-align: center; background-color: rgb(192, 190, 190);">
                <h5 class="modal-title" id="loginModal">Ya tengo una cuenta</h5>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#login" id="loginButton">
                          Iniciar sesión
                        </button>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(data) {    
                var loginError = "<?php echo $errors->first('email') ?>";
                if (loginError != "") {
                    alert("error de login");
                }
            });
        </script>
        <footer>
            <div class="container">
                @yield("footer")
                <span class="pull-right">© Order Tracker 2016</span>
            </div>
        </footer>
    </body>
</html>
