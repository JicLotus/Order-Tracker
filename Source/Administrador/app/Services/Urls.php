<?php

namespace App\Services;

class Urls {

  /**
   * @param array $inputData
   *
   * @return string
   */
  private function appendQuery($inputData = []) {
    $query = "";
    if(count($inputData) > 0) {
      $query = "?" . http_build_query($inputData);
    }
    return $query;
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlImg($img, $inputData = []) {
    return url("img/" . $img . $this->appendQuery($inputData));
  }


  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlHome($inputData = []) {
    return url("" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlLogin($inputData = []) {
    return url("auth/login" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlHelp($inputData = []) {
    return url("help" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlProperties($inputData = []) {
    return url("properties" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlMyAccount($inputData = []) {
    return url("profile" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlPublish($inputData = []) {
    return url("publish" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlLogout($inputData = []) {
    return url("auth/logout" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlLoginAs($inputData = []) {
    return url("login-as" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsers($inputData = []) {
    return url("users" . $this->appendQuery($inputData));
  }

  /**
   * @param integer $id
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsersShow($id, $inputData = []) {
    return url("users/show/" . $id . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsersCreate($inputData = []) {
    return url("users/create" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsersStore($inputData = []) {
    return url("users" . $this->appendQuery($inputData));
  }

  /**
   * @param integer $id
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsersEdit($id, $inputData = []) {
    return url("users/" . $id . "/edit" . $this->appendQuery($inputData));
  }

  /**
   * @param integer $id
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlUsersUpdate($id, $inputData = []) {
    return url("users/" . $id . $this->appendQuery($inputData));
  }

}