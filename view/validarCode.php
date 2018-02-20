<?php

include '../controller/UsuarioControlador.php';

$user = $_POST['username'];
$pass = $_POST['password'];

echo UsuarioControlador::login($user,$pass);

?>