<?php
    /*
        Include the `fusioncharts.php` file that contains functions to embed the charts.
    */
    include("includes/fusioncharts.php");
    
    $hostdb = "localhost";  // MySQl host
    $userdb = "root";  // MySQL username
    $passdb = "admin";  // MySQL password
    $namedb = "world";  // MySQL database name

    // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);
   
      /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
      if ($dbhandle->connect_error) {
         exit("There was an error with your connection: ".$dbhandle->connect_error);
      }

?>