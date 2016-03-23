<?php 

namespace App\Definitions\Property;
use App\Definitions\Definition as Definition;

class PropertyModalityDefinitions extends Definition {

	protected function getMap() {
		return [
			"BUY" => ["id" => 1, "name" => "Compra"],
			"RENTAL" => ["id" => 2, "name" => "Alquiler"],
			"ENTERPRISE" => ["id" => 3, "name" => "Emprendimiento"],
		];
	}
}

 ?>