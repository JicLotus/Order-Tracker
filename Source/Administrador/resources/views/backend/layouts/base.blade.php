<html>
  <head>
    <title>Inmuebles360 - {!! $title !!}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://twitter.github.com/bootstrap/assets/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/backend.css">
    <link rel="shortcut icon" href="/img/logo.png" type="image/png" />
    <script type="text/javascript">
      $(document).ready(function(){
        $("#loginAs select").change(function(){
          $('#loginAs').submit();
        });
      });
    </script>
    @yield("head")
  </head>
  <body>
    <div class="navbar nav-static-top navbar-inverse navbar-fixed-top">
      <div class="container" id="base-header">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{app()->make("urls")->getUrlHome()}}">
            <img class="logo" src="/img/logo.png" alt="">
          </a>
        </div>
        <div class="navbar-collapse">
          @if(App()->make("currentUser")->isAdmin())
            <ul class="nav navbar-nav">
              <li>
                <a href="{{app()->make("urls")->getUrlUsers()}}"><i class="fa fa-users"></i> Users</a>
              </li>
            </ul>
          @endif
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user show-ipad" title="user" style="display:none"></i><span class="hide-ipad">{{app()->make("currentUser")->name}}</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if(app()->make("loggedUser")->isAdmin())
                  <li>
                      <a href="#">Login as:<br>
                          <form id="loginAs" action="{{app()->make("urls")->getUrlLoginAs()}}" method="post">
                              <select class="form-control" name="id">
                                <option value="{{app()->make("loggedUser")->id}}" {{(app()->make("loggedUser")->id == app()->make("currentUser")->id) ? "selected" : ""}}>{{"<< me >>"}}</option>
                                @foreach(app()->make("usersWithoutLoggedUser") as $user)
                                  <option value="{{$user->id}}" {{($user->id == app()->make("currentUser")->id) ? "selected" : ""}}>{{$user->name}}</option>
                                @endforeach
                              </select>
                              <input type="hidden" name="back" value="{{Request::url()}}">
                              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                          </form>
                      </a>
                  </li>
                  <li class="divider" style="height:1px; margin:9px 0"></li>
                @endif
                <li>
                  <a href="{{app()->make("urls")->getUrlLogout()}}"><i class="fa fa-power-off"></i> Logout</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container container-responsive">
      <div class="page-header">
        <h4>{{$title}}</h4>
      </div>
      @yield("content")
    </div>
    <footer>
      <script src="/js/date_picker.js" type="text/javascript" charset="utf-8"></script>
      @yield("footer")
    </footer>
  </body>
</html>