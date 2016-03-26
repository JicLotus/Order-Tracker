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
  public function getUrlHome($inputData = []) {
    return url("" . $this->appendQuery($inputData));
  }


  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlHelp($inputData = []) {
    return url("help" . $this->appendQuery($inputData));
  }


  public function getUrlAgregarProducto($inputData = []) {
    return url("agregarproducto" . $this->appendQuery($inputData));
  }
  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlProductos($inputData = []) {
    return url("productos" . $this->appendQuery($inputData));
  }
  
  public function getUrlEditarProducto($id,$inputData = []) {
    return url("editarproducto/". $id . $this->appendQuery($inputData));
  }
  
  public function getUrlGuardarProducto($id,$inputData = []) {
    return url("guardarproducto/". $id . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlClientes($inputData = []) {
    return url("clientes" . $this->appendQuery($inputData));
  }
  
    /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlAgendas($inputData = []) {
    return url("agendas" . $this->appendQuery($inputData));
  }

  /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlPedidos($inputData = []) {
    return url("pedidos" . $this->appendQuery($inputData));
  }

  public function getUrlUsuarios($inputData = []) {
    return url("usuarios" . $this->appendQuery($inputData));
  }

}

