<?php

include ('Conexion.php');
include ('entity/Usuario.php');

class UsuarioDao extends Conexion 
{
	protected static $cnx;

	private static function getConexion() 
	{
		self::$cnx = Conexion::conectar();
	}

	private static function desconectar() 
	{
		self::$cnx = null;
	}
	
	/**
	 * @param		object	$usuario
	 * @return		boolean
	 */
	public static function login($usuario) 
	{
		$query = 'SELECT * FROM tb_usuario WHERE userCod = :usuario AND userPass = :password';

		self::getConexion();

		$result = self::$cnx->prepare($query);

		$user = $usuario->getUserCod();
		$pass = $usuario->getUserPass();

		//echo $user;
		//echo $pass;
		
		$result->bindParam(':usuario', $user, PDO::PARAM_STR, 15);
		$result->bindParam(':password', $pass, PDO::PARAM_STR, 15);		

		
		
		$result->execute();

		if($result->rowCount() > 0 ) 
		{
			$filas = $result->fetch();
			if ($filas["userCod"] == $user && $filas["userPass"] == $pass) 
			{
				return "Existe 1 Usuario";
			}
			
		}

		return "Falso";
	}

}

?>