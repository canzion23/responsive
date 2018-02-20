<?php

require 'model/UsuarioDao.php';

class UsuarioControlador 
{
	
	public static function login($usuario, $password) 
	{		
		$obj_usuario = new Usuario();
		$obj_usuario->setUserCod($usuario);
		$obj_usuario->setUserPass($password);

		return UsuarioDao::login($obj_usuario);
	}

}

?>