<?php

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "admin";  // MySQL password
   $namedb = "db_empleados";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }

   sleep(2);

   $strQuery = "SELECT userName, userType FROM tb_usuario
                 WHERE userCod = '".$_POST['username']."'
                   AND userPass = '".$_POST['password']."'
                   AND status = 1";

    $result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

    if ($result->num_rows == 1) {
    $datos = $result->fetch_assoc();
    echo json_encode(array('error' => false, 'tipo'=> $datos['userType']));
  } else {
    echo json_encode(array('error' => true));
  }
  
  $dbhandle->close();

?>
