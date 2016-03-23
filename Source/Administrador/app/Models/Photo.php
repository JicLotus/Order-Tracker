<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Photo extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'photos';

  /**
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * @var boolean
   */
  public $timestamps = true;

  public function property()
  {
      return $this->belongsTo('App\Models\Property', 'property_id');
  }


}

