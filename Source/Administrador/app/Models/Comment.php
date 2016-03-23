<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'comments';

  /**
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * @var boolean
   */
  public $timestamps = false;


  public function property()
  {
      return $this->belongsTo('App\Models\Property', 'property_id');
  }


}
