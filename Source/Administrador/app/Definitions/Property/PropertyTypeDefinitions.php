<?php 

namespace App\Definitions\Property;
use App\Definitions\Definition as Definition;

class PropertyTypeDefinitions extends Definition {

	protected function getMap() {
		return [
			"HOUSE" => ["id" => 1, "name" => "Casa"],
			"APARTMENT" => ["id" => 2, "name" => "Departamento"],
		];
	}
}

 ?>