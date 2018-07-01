<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission { 

	public static function defaultPermissions(){

	    $result = array();
		$route = [
			"sells",
			"dashboards",
			"roles",
			"users",
			"brands",
			"carriers",
			"colors",
			"sizes",
			"conditions",
			"gadgets",
			"devices",
			"parts",
			"models",
			"invoices",
		];

		foreach($route as $row){
			$action = ["view","add","edit","delete"];
			foreach($action as $ac){
				$result[] = $ac . '_' . $row;
			}
		}

		return $result;

	}

	public static function findBy($field, $value) {
	   return self::where($field, '=' ,$value)->get()->first();
	}

}