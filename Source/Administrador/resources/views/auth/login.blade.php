<html id="login">
  <head>
    <title>Inmuebles360 Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://twitter.github.com/bootstrap/assets/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/backend.css">
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="login-form">
            <img src="/img/logo.png" class="logo">
            <h2 class="login-info">Inmuebles360 Login </h2>
            <form class="form-signin" method="POST" action="/auth/login">
              {!! csrf_field() !!}
              <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
              <input class="form-control" type="password" name="password" id="password" placeholder="Password">
              <input type="checkbox" name="remember"> Remember Me
              <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
              <input type="hidden" name="uri" value="{{Input::get("uri")}}">
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>