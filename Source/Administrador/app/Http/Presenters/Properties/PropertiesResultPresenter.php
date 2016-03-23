<?php 

namespace App\Http\Presenters\Properties;

use App\Models\Property as Property;
use \Input as Input;

class PropertiesResultPresenter {

	/**
	 * @var Eloquent\QueryBuilder
	 */
	private $propertiesQuery;

	/**
	 * @var integer
	 */
	private $itemsPerPage = 10;

	public function __construct() {

	}

	/**
	 * @return 
	 */
	private function getPropertiesQuery() {
		if (!$this->propertiesQuery) {
			$this->propertiesQuery = Property::orderBy('title');
			foreach (Input::only('locality',
								'type',
								'modality',
								'natural_gas',
								'plain_water',
								'light',
								'pavement',
								'kitchen',
								'living_room',
								'playground',
								'country',
								'administrative_area_level_1',
								'administrative_area_level_2',
								'administrative_area_level_3',
								'sublocality_level_1',
								'sublocality_level_2',
								'sublocality_level_3',
								'locality') as $key => $value) {
	            if ($value) {
	                $this->propertiesQuery->where($key, $value);
	            }
	        }
	        if (Input::get('min_price')) {
	        	$this->propertiesQuery->where('price', '>=', Input::get('min_price'));
	        }
	        if (Input::get('max_price')) {
	        	$this->propertiesQuery->where('price', '<=', Input::get('max_price'));
	        }
		}
		return $this->propertiesQuery;
	}

	/**
	 * @return 
	 */
	public function getProperties() {
		return $this->getPropertiesQuery()->paginate($this->itemsPerPage);
	}

	/**
	 * @return integer
	 */
	public function countProperties() {
		return $this->getPropertiesQuery()->count();
	}

	/**
	 * @return 
	 */
	public function getPropertiesPagination() {
		return $this->getProperties()->appends(Input::all())->render();
	}
}

 ?>