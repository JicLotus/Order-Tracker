<?php 

namespace App\Definitions\User;
use App\Definitions\Definition as Definition;

class UserRoleDefinitions extends Definition {

	protected function getMap() {
		return [
			"INDIVIDUAL_USER" => ["id" => 1, "name" => "Usuario Particular"],
			"INMOBILIARIA"	  => ["id" => 2, "name" => "Inmobiliaria"],
			"CONSTRUCTORA"    => ["id" => 3, "name" => "Constructora"],
			"CORREDOR"       => ["id" => 4, "name" => "Corredor"],
		];
	}
}

 ?>