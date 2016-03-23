<?php

namespace App\Services;

class HtmlHelper {

  /**
   * @param array $options
   * @param mixed $idKey
   * @param mixed $valueKey
   * @param mixed $selectedValue
   * @param array $attrs
   * @param boolean $emptyValue
   * @return string
   */
  public static function selectFromDicc($options, $idKey, $valueKey, $selectedValue, $attrs = array(), $emptyValue = true) {
    $html = "<select " . self::attrs2str($attrs) . ">";

    if ($emptyValue) {
       $html .= "<option value=''>-</option>";
    }

    foreach ($options as $value) {
       if ($value[$idKey] == $selectedValue) {
           $html .= "<option value='" . $value[$idKey] . "' selected>" . $value[$valueKey] . "</option>";
       } else {
           $html .= "<option value='" . $value[$idKey] . "'>" . $value[$valueKey] . "</option>";
       }
    }
    $html .= "</select>";

    return $html;
  }

  /**
   * @param integer $selectedValue
   * @param array $attrs 
   * @return array
   */
  public static function selectYesNoNull($selectedValue, $attrs = array()) {

    $html = "<select " . self::attrs2str($attrs) . ">";
    $html .= "<option value=''>-</option>";

    if($selectedValue === "1"){
      $html .= "<option value='1' selected>Yes</option>";
    }
    else{
      $html .= "<option value='1'>Yes</option>";
    }

    if($selectedValue === "0"){
      $html .= "<option value='0' selected>No</option>";
    }
    else{
      $html .= "<option value='0'>No</option>";
    }

    $html .= "</select>";

    return $html;
  }

  /**
   * @param integer $selectedValue
   * @param array $attrs
   * @param integer $condition
   * @return string
   */
  public static function selectYesNo($selectedValue, $attrs = array(), $condition) {
    $html = "<select " . self::attrs2str($attrs) . ">";
    switch ($condition) {
      case 1:
        $html .= ($selectedValue == 1) ? "<option value='1' selected>Yes</option>" : "<option value='1'>Yes</option>";
      break;
      case 2:
        $html .= ($selectedValue > 0) ? "<option value='1' selected>Yes</option>" : "<option value='1'>Yes</option>";
      break;
    }
    $html .= (!$selectedValue) ? "<option value='0' selected>No</option>" : "<option value='0'>No</option>";
    $html .= "</select>";

    return $html;
  }

  /**
   * @param array $attrs
   * @return string
   */
  private static function attrs2str($attrs) {
    $str = "";
    foreach ($attrs as $attrName => $value) {
      $str .= "$attrName='$value'";
    }
    return $str;
  }

}