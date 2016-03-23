<?php

namespace App\Definitions;

/**
 * Clase base que encapsula la logica de las definiciones de los valores de la base de datos
 * @abstract
 */
abstract class Definition{
  protected static $instances;

  /**
   * Devuelve el valor numerico bajo la clave 'id' de la definicion
   * @param string $const Nombre de la constante
   */
  public static function constant($const){
    $tmp = self::instance()->getMap();
    return $tmp[$const]['id'];
  }

  /**
   * Retorna el mapa con la definición
   * @return Array
   */
  public static function map(){
    return self::instance()->getMap();
  }

  /**
   * Magic method para obtener los valores de las definiciones para un id dado
   * @param $name string clave del valor que se quiere obtener
   * @param $arg array Parametros de la funcion, como primer parametro se recibe el id de la definición
   * @return string
   */
  public static function __callStatic($name, $arg){
    return self::findValue($name, $arg);
  }

  protected static function findValue($name, $arg){
    if (substr($name, 0, 3) == "get"){
      $key = lcfirst(substr($name, 3));
      foreach (self::instance()->getMap() as $const => $definition){
        if ($definition['id'] == $arg[0] && array_key_exists($key, $definition)){
          return $definition[$key];
        }
      }

      return isset($arg[1]) ? $arg[1]: "";
    }else{
      // chequeo si la clase que se llamo tiene definido un metodo con ese nombre?
      // hasta ahora nunca tuve que agrupar definiciones o cosas asi
    }
  }

  /**
   * Retorna el mapa de la definicion
   * @abstract
   */
  abstract protected function getMap();

  /**
   * Retorna una instancia de la clase hija con la que se invocó el metodo
   * @return mixed
   */
  protected static function instance(){
    $className = get_called_class();
    if (is_null(self::$instances) || !array_key_exists($className, self::$instances)){
      self::$instances[$className] = new $className;
    }

    return self::$instances[$className];
  }

  /**
   * Retorna el mapa de la definición pero sin las keys
   * @return array
   */
  public static function mapWithoutKeys(){
    $map = array();
    foreach(self::instance()->getMap() as $const => $definition){
      $map[$definition['id']] = $definition['name'];
    }
    return $map;
  }
}

?>