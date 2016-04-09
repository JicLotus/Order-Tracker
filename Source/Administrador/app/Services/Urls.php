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

  public function getUrlImagen($inputData = []) {
    return url("img/prueba.jpg" . $this->appendQuery($inputData));
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
  
  public function getUrlAgregarCliente($inputData = []) {
    return url("agregarcliente" . $this->appendQuery($inputData));
  }
  
  public function getUrlEditarCliente($id,$inputData = []) {
    return url("editarcliente/" . $id . $this->appendQuery($inputData));
  }
  
  public function getUrlGuardarCliente($id,$inputData = []) {
    return url("guardarcliente/". $id . $this->appendQuery($inputData));
  }
  
    /**
   * @param array $inputData
   *
   * @return string
   */
  public function getUrlAgendas($inputData = []) {
    return url("agendas" . $this->appendQuery($inputData));
  }

  public function getUrlAgregarAgenda($inputData = []) {
    return url("agregaragenda" . $this->appendQuery($inputData));
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

