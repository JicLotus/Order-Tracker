<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Property extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'properties';

  /**
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * @var boolean
   */
  public $timestamps = true;

  /**
   * @return App\Models\User
   */
  public function photos() {
    return $this->hasMany("App\Models\Photo", "property_id");
  }

  /**
   * @return App\Models\User
   */
  public function user() {
    return $this->belongsTo("App\Models\User", "user_id");
  }

  public function comments()
  {
      return $this->hasMany('App\Models\Comment', 'property_id');
  }

  public function getFirstPhoto() {
    $photo = "1";
    foreach($this->photos as $photo) {
      $photo = $photo->id;
      break;
    } 
    return $photo;
  }

}

