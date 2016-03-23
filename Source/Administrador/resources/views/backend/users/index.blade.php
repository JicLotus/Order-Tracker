@extends("backend.layouts.base")

@section("content")
<div class="container">
<div class="row">
  <div class="col-md-6">
    <form class="navbar-default navbar-form" action="" method="GET">
      <table>
        <tbody>
          <tr>
            <td>Name:</td>
            <td>
              <input class="form-control small" name="name" value="{{Input::get('name')}}"></input>
            </td>
            <td>Email:</td>
            <td>
              <input class="form-control small" name="email" value="{{Input::get('email')}}"></input>
            </td>
            <td>
              <button type="submit" class="btn btn-primary">Search</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
  <div class="col-md-6">
    <a href="{{app()->make('urls')->getUrlUsersCreate()}}" class="btn btn-default">Add User</a>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <strong>Total: </strong>{{$presenter->countUsers()}}
    {!! $presenter->getUsersPagination() !!}
    <table class="table table-condensed table-bordered table-striped">
      <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th></th>
      </thead>
      <tbody>
        @foreach($presenter->getUsers() as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->getRole()}}</td>
          <td class="adjust-to-content">
            <a href="{{app()->make('urls')->getUrlUsersEdit($user->id)}}" class="btn btn-info btn-xs">Edit</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection