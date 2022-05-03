<?php

class Users_DTO {
	private $id;
	private $firstname;
	private $lastname;
	private $password;
	private $email;
	private $accLevel;

	public function __construct($i, $fn, $ln, $p ,$em, $acc) {
		$this->id = $i;
		$this->firstname = $fn;
		$this->lastname = $ln;
		$this->password = $p;
		$this->email = $em;
		$this->accLevel = $acc;
	}

	public function getId(){
		return $this->id;
	}

	public function getFirstname(){
		return $this->firstname;
	}
	
	public function getLastname(){
		return $this->lastname;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}
	
	public function getAccLevel(){
		return $this->accLevel;
	}

	public function setId($att){
		$this->id=$att;
	}

	public function setFirstname($att){
		$this->firstname=$att;
	}

	public function setLastname($att){
		$this->lastname=$att;
	}
	
	public function setPassword($att){
		$this->password=$att;
	}	
	
	public function setEmail($att){
		$this->email=$att;
	}
	
	public function setAccLevel($att){
		$this->accLevel=$att;
	}
	
	
}


