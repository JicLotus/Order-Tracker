@extends("backend.layouts.base")

@section("content")
<div class="container">
<div class="row">
  <div class="col-md-5">
    <form action="{{app()->make('urls')->getUrlUsersUpdate($user->id)}}" method="POST">
      <div class="row">
        <div class="col-md-7">
          <table>
            <tbody>
              <tr>
                <td>Name</td>
                <td>
                  <input class="form-control medium" name="name" value="{{Input::get("name", $user->name)}}"></input>
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td>
                  <input class="form-control medium" name="email" value="{{Input::get("email", $user->email)}}"></input>
                </td>
              </tr>
              <tr>
                <td>Password</td>
                <td>
                  <input class="form-control medium" type="password" name="password" value="{{Input::get("password", $user->password)}}"></input>
                </td>
              </tr>
              <tr>
                <td>Role</td>
                <td>
                  {!! HtmlHelper::selectFromDicc($roles, 'id', 'name', Input::get("role", $user->role), array("name" => "role", "class" => "form-control medium")) !!}
                </td>
              </tr>
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <input type="hidden" name="_method" value="PUT" />
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{app()->make('urls')->getUrlUsers()}}" class="btn btn-default">Cancel</a>
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection