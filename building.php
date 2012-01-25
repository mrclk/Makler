<?php

class Building {
	
	public $id;
	public $rooms;
	public $floors;
	public $price;
	public $min_price;

	public $address;
	
	public $forename;
	public $lastname;
	public $owner;
	
	function __construct($rooms, $floors, $price, $min_price) {
		$this->rooms = $rooms;
		$this->floors = $floors;
		$this->price = $price;
		$this->min_price = $min_price;
	}
	
	function setAddress($address) {
		$this->address = $address;
	}
	
	function function_name() {
		;
	}
}
?>