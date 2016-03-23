<?php

use App\Services\Urls;
use App\Models\User;
use \Session as Session;
use \Auth as Auth;

app()->singleton('urls', function() {
  return new Urls();
});

app()->bind('loggedUser', function() {
  return Auth::user();
});

app()->bind("currentUser", function() {
  if (Session::has("loginAs")) {
    $loginAs = Session::get("loginAs");
    if(is_numeric($loginAs)) {
      return User::find($loginAs);
    }
  }
  return app()->make('loggedUser');
});

app()->bind("usersWithoutLoggedUser", function() {
  return User::where("id", "!=", app()->make("loggedUser")->id)
            ->get();
});