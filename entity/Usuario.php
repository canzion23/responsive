<?php

class Usuario
{
	private $userCod;
	private $userPass;
	private $userName;
	private $status;
	private $idDepto;
	private $userType;

	public function getUserCod(){
		return $this->userCod;
	}

	public function setUserCod($userCod){
		$this->userCod = $userCod;
	}

	public function getUserPass(){
		return $this->userPass;
	}

	public function setUserPass($userPass){
		$this->userPass = $userPass;
	}

	public function getUserName(){
		return $this->userName;
	}

	public function setUserName($userName){
		$this->userName = $userName;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getIdDepto(){
		return $this->idDepto;
	}

	public function setIdDepto($idDepto){
		$this->idDepto = $idDepto;
	}

	public function getUserType(){
		return $this->userType;
	}

	public function setUserType($userType){
		$this->userType = $userType;
	}

	/*
	private $id;
	private $nombre;
	private $usuario;
	private $email;
	private $password;
	private $privilegio;
	private $fecha_registro;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getPrivilegio(){
		return $this->privilegio;
	}

	public function setPrivilegio($privilegio){
		$this->privilegio = $privilegio;
	}

	public function getFecha_registro(){
		return $this->fecha_registro;
	}

	public function setFecha_registro($fecha_registro){
		$this->fecha_registro = $fecha_registro;
	}
	*/
}
?>