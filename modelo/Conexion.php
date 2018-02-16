<?php

class Conexion
{

/**
 * Realiza la conexión a la base de datos MySQL devolviendo un objeto de tipo conexión.
 * @return $cn
 */
	public static function conectar() {

		try {
			$cn = new PDO("mysql:host=localhost;dbname=db_empleados;","root","admin");

			//echo "Conectado";
			return $cn;

		} catch(PDOException $ex) {
			die($ex->getMessage());			
		}
	}
}
//Conexion::conectar();
?>