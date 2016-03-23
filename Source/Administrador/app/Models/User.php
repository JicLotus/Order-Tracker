<?php

namespace App\Models;

use App\User as LaravelUser;
use App\Models\Category;

class User extends LaravelUser {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];


  public function property()
  {
      return $this->hasMany('App\Models\Property', 'property_id');
  }

  /**
   * @return string
   */
  public function getRole() {
      return \UserRoleDefinitions::getName($this->role, "-");
  }

  /**
   * @return boolean
   */
  public function isAdmin() {
      return $this->role == \UserRoleDefinitions::constant("ADMIN");
  }

  /**
   * @return boolean
   */
  public function isIndividualUser() {
      return $this->role == \UserRoleDefinitions::constant("INDIVIDUAL_USER");
  }


}