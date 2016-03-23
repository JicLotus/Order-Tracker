<?php

namespace App\Http\Presenters\Backend\Users;

use App\Models\User;

class UsersIndexPresenter {

  /**
   * @var
   */
  private $usersQuery;

  /**
   * @var integer
   */
  private $itemsPerPage;

  public function __construct() {
    $this->itemsPerPage = 30;
  }

  /**
   * @return
   */
  private function getUsersQuery() {
    if(!$this->usersQuery) {
      $this->usersQuery = User::orderBy("id", "ASC");
      foreach(\Input::only("name", "email") as $field => $value) {
        if($value) {
          $this->usersQuery->where($field, "LIKE", "%" . $value . "%");
        }
      }
    }
    return $this->usersQuery;
  }

  /**
   * @return
   */
  public function getUsers() {
    return $this->getUsersQuery()->paginate($this->itemsPerPage);
  }

  /**
   * @return
   */
  public function getUsersPagination() {
    $dataToAppend = ["name" => \Input::get("name"),
                        "email" => \Input::get("email")];
    return $this->getUsers()->appends($dataToAppend)->render();
  }

  /**
   * @return integer
   */
  public function countUsers() {
    return $this->getUsersQuery()->count();
  }

} ?>